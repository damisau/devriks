<?php use_helper('Object'); ?>
<div class="breadcrumb_green"><?php echo $breadcrumb ?></div>
<h1>Legal Texts Archive</h1>

<?php
require("/var/www/htphp/configuration.php");


$htdig=new HTDig();

    /*
     * Where are the executables of htsearch, htdig, htmerge, htfuzzy
     * located? They should be in the same directory. It does not need
     * to be in the original instalation directory.
     */
$htdig->htdig_path=$htdig_path;

    /*
     * If the htsearch program is locate a different directory from htdig,
     * specify it here.
     */
$htdig->htsearch_path=$htsearch_path;

    /*
     * Where this search engine configuration file should be stored? It
     * does not need to be in the original htdig instalation directory.
     * If you need to index more than one site in your server run this
     * script as many times as need specifying different configuration file
     * names.
     */
$htdig->configuration=$htdig_configuration_file;

    /*
     * Where this search engine database files hould be stored? It
     * does not need to be in the original htdig instalation directory.
     * If you need to index more than one site in your server run this
     * script as many times as need specifying different database
     * directories.
     */
$htdig->database_directory=$htdig_database_directory;

    /*
     * Set the secure search option to let the latest Ht:/Dig versions
     * (3.1.6 or later) use configuration files stored in paths different
     * from the default.
     */
$htdig->secure_search=1;


if(IsSet($_REQUEST["words"]))
$words=$_REQUEST["words"];
if(IsSet($_REQUEST["method"]))
$method=$_REQUEST["method"];
if(IsSet($_REQUEST["go_search"]))
$go_search=$_REQUEST["go_search"];
if(IsSet($_REQUEST["page"]))
$page=$_REQUEST["page"];
?>
<?php
if(!isset($go_search)){
    ?>
    
<p>
    In this section you can explore our archive of documents (e.g. treaty texts).<br>
    You can view texts related to regional arrangements or countries or use the
    search form to query all texts for keywords. You can also to find what you are looking for by
    <a href="<?php echo url_for('document/browse'); ?>">browsing the full archive</a>

</p>
<?php } ?>

<FORM METHOD="GET" ACTION="" NAME="search_form">
    <TABLE BORDER="0">
        <TR>
            <TD>
                <CENTER><TABLE>
                        <TR>
                            <TH ALIGN=right>Search for:</TH>
                            <TD><INPUT TYPE="text" NAME="words" VALUE="<?php
                                           if(IsSet($words)){
                                               echo HtmlEntities($words);
                                           }

                                           ?>"></TD>
                            <TD><CENTER><INPUT TYPE="submit" VALUE="Go"</CENTER></TD>
                        </TR>
                        <TR>
                            <TH ALIGN=right>Match</TH>
                            <TD><SELECT NAME="method">
                                    <OPTION VALUE="or"<?php
                                            if(IsSet($method)
                                                && $method=="or")
                                            echo " SELECTED";
                                            ?>>Any word</OPTION>
                                    <OPTION VALUE="and"<?
                                            if(IsSet($method)
                                                && $method=="and")
                                            echo " SELECTED";
                                            ?>>All words</OPTION>
                                </SELECT>
                        </TD></TR>
                </TABLE></CENTER>
        </TD></TR>
    </TABLE>
    <INPUT TYPE="hidden" NAME="go_search" VALUE="1" ID="go_search">
</FORM>
<?php
if(IsSet($go_search))
{
    if(IsSet($page)
        && intval($page)>0)
    $page=intval($page);
    else
    $page=1;

        /* How many matches per page? */
    $matchesperpage=10;

        /* What is the limit of Next and Previous result page links ? */
    $listpages=4;

    $options=array(
            "matchesperpage"=>$matchesperpage,
            "page"=>$page,
            "method"=>$method
    );
    $words=ereg_replace("[ ]+","|",$words);
    if(!strcmp($error=$htdig->Search($words,$options,$results),""))
    {
        $maximum_page=intval(($results["MatchCount"]+$matchesperpage-1)/$matchesperpage);
        if($results["MatchCount"])
        {
            if($page>$maximum_page)
            {
                $options["page"]=$page=$maximum_page;
                $error=$htdig->search($words,$options,$results);
            }
        }
        if(!strcmp($error,""))
        {
            if($results["MatchCount"]>0)
            {
                ?>
<TABLE WIDTH="90%">
    <TR>
        <TD ALIGN=right WIDTH="5%"> </TD>
        <TD><B>Pages found:</B> <?php
            echo $results["MatchCount"];
            ?></TD>
    </TR>
</TABLE>
<?php
if($results["MatchCount"]>$matchesperpage)
{
    ?>
<TABLE WIDTH="90%">
    <TR>
        <TD WIDTH="5%"> </TD>
        <TD><TABLE>
                <TR>
                    <?php
                    $link_values="words=".UrlEncode($words)."&method=$method&go_search=1";
                    if($page>1)
                    {
                        if(($link_page=$page-$listpages)<1)
                        $link_page=1;
                        for(;$link_page<$page;$link_page++)
                        {
                            $page_range=(($link_page-1)*$matchesperpage+1)."-".min($link_page*$matchesperpage,$results["MatchCount"]);
                            $url="?page=$link_page&$link_values";
                            echo "<TD><A HREF=\"$url\">$page_range</A></TD>\n";
                        }
                        echo "<TD><A HREF=\"$url\">&lt;&lt; Previous</A></TD>\n";
                    }
                    $page_range=(($page-1)*$matchesperpage+1)."-".min($page*$matchesperpage,$results["MatchCount"]);
                    echo "<TD><B>$page_range</B></TD>\n";
                    if($page<$maximum_page)
                    {
                        $link_page=$page+1;
                        $url="?page=$link_page&$link_values";
                        echo "<TD><A HREF=\"$url\">Next &gt;&gt;</TD>\n";
                        if(($last_page=$page+$listpages)>$maximum_page)
                        $last_page=$maximum_page;
                        for(;$link_page<=$last_page;$link_page++)
                        {
                            $page_range=(($link_page-1)*$matchesperpage+1)."-".min($link_page*$matchesperpage,$results["MatchCount"]);
                            $url="?page=$link_page&$link_values";
                            echo "<TD><A HREF=\"$url\">$page_range</A></TD>\n";
                        }
                    }
                    ?>
                </TR>
            </TABLE>
        </TD>
    </TR>
</TABLE>
<?php
}

$first=$results["FirstMatch"];
$last=$results["LastMatch"];
for($match=$first;$match<=$last;$match++)
{
?>
<BR>
<TABLE WIDTH="90%">
    <TR>
        <TD ALIGN=right WIDTH="5%">
            <?php
            echo $match;
            $url = $results["Matches"][$match]["URL"];
            ?>.</TD>
        <TD><?php
            echo "<A HREF=\"".$url."\">".$results["Matches"][$match]["Title"]," (",$results["Matches"][$match]["Percent"],"%)";
            ?></TD>
    </TR>
    <TR>
        <TD> </TD>
        <TD><FONT SIZE=-1><?
                echo $results["Matches"][$match]["Excerpt"]
                ?></FONT></TD>
</TR></TABLE>
<?php
}
}
else
{
?>
<H2><CENTER>Sorry no pages were found.</CENTER></H2>
<?php
}
}
}
if(strcmp($error,""))
{
?>
<H2>Error: <?php
    echo HtmlEntities($error);
    ?>.</H2>
    <?php
}
}
?>

<?php
if(!isset($go_search)){
?>
<p>
    <form name="countryDocument" ACTION="<?php echo url_for('document/show'); ?>" method="POST">
        Select one or more countries, select all countries for a complete list of documents grouped by country.
        <select multiple size="10" name="countries[]">
            <?php echo objects_for_select(
                $members,'getId','getName') ?>
        </select><br><br>
        OR select one arrangment to view related documents of the arrangement and its members
        <select size="10" name="arrangement">
            <?php echo objects_for_select(
                $arrangements,'getId','getName') ?>
        </select>
        <p>
            <input type="submit" value="view documents" align="right" style="margin-left:400px">
        </p>
    </form>
</p>
<?php } ?>
