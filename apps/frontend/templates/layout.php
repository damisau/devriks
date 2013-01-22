<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <?php if (has_slot('gmapheader')): ?>
            <?php include_slot('gmapheader') ?>
        <?php endif; ?>
        <link rel="shortcut icon" href="/favicon.ico" />
    </head>
    <body onLoad="load();">
        <div id="wrapper">
            <div class="green_header"></div>
            <div class="green_banner">
                <?php   $menuColor = "green";
                include_partial('global/horizontalMenu',
                        array('menuColor' => $menuColor));?>

            </div>
            <table border="0" cellspacing="0" border="0" class="table_frame_green">
                <tr>
                    <td width="240" valign="top" class="menu_col_green" height="550px;">
                        <span id="menu_left">
                            <div id="menu_green">
                                <div class="menu_item1_green">
                                    <img src="/devriks/web/images/unu-small.jpg" alt="Logo of UNU" width="15"><a href="<?php echo url_for('arrangement/index')?>">
                                        &nbsp;regional arrangements
                                    </a></div>
                                <div class="menu_item2_green"><img src="/devriks/web/images/unu-small.jpg" alt="Logo of UNU" width="15"><a href="<?php echo url_for('data/index')?>">
                                        &nbsp;regional indicators
                                    </a></div>
                                <div  class="menu_item1_green"><img src="/devriks/web/images/unu-small.jpg" alt="Logo of UNU" width="15"><a href="http://www.cris.unu.edu/map">
                                        &nbsp;map application
                                    </a></div>
                                <div class="menu_item2_green"><img src="/devriks/web/images/unu-small.jpg" alt="Logo of UNU" width="15"><a href="<?php echo url_for('document/index')?>">
                                        &nbsp;legal texts
                                    </a></div>
                                <div class="menu_item1_green"><a href="<?php echo url_for('dblinks/index')?>">
                                        other databases
                                    </a></div>
                            </div>
                        </span>
                    </td>
                    </td>
                    <td width="725" valign="top" align="left">
                        <div class="frame_wrapper">
                            <div>
                                <div>
                                    <?php echo $sf_content ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

        </div>
    </body>
</html>
