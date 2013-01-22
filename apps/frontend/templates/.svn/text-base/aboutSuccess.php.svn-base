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
    <body onload="load();">
        <div id="wrapper">
            <div class="red_header"></div>
            <div class="red_banner">
                <?php $menuColor = "red";
                include_partial('global/horizontalMenu',
                        array('menuColor'=> $menuColor));?>
            </div>

            <table border="0" cellspacing="0" class="table_frame_red">
                <tr>
                    <td style="width: 240px; height: 550px;" valign="top" class="menu_col_red">
                        <div id="menu_left">
                            <div id="menu_red">
                                <div class="menu_item1_red">
                                    <a href="<?php echo url_for('about/developments')?>">
                                        Latest Developments
                                    </a>
                                </div>
                                <div class="menu_item2_red">
                                    <a href="<?php echo url_for('about/partners')?>">
                                        Partners
                                    </a>
                                </div>
                                <div class="menu_item1_red">
                                    <a href="<?php echo url_for('about/notes')?>">
                                        Technical notes
                                    </a>
                                </div>
                                <div class="menu_item2_red">
                                    <a href="<?php echo url_for('about/contents')?>">
                                        Contents
                                    </a>
                                </div>
                                <div class="menu_item1_red">
                                    <a href="<?php echo url_for('about/funding')?>">
                                        Funding
                                    </a>
                                </div>
                                <div class="menu_item2_red">
                                    <a href="<?php echo url_for('about/contact')?>">
                                        Contact Us
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td style="width: 725px;" valign="top" align="left">
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