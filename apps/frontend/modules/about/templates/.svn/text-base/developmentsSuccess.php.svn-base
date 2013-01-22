<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="breadcrumb_red"><?php echo $breadcrumb;?></div>
<H1>Latest Developments</H1>
<?php
    foreach($developmentsList as $newsItem){
        echo "<p><b>";
        echo $newsItem->getDatePublished()." ";
        echo $newsItem->getTitle();
        echo "</b><p>";
        echo $newsItem->getText();
        echo "</p>";
    }
?>