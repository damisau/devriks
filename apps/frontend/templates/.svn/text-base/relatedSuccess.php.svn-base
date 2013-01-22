<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <body onload="load()">
        <div id="wrapper">

            <div class="purple_header"></div>
            <div class="purple_banner">

                <?php $menuColor = "purple"; include_partial('global/horizontalMenu',
                    array('menuColor'=> $menuColor));?>
            </div>
            <table border="0" cellspacing="0" border="0" class="table_frame_purple">
                <tr>
                    <td width="240" valign="top" class="menu_col_purple" height="550px;">
                    <span id="menu_left">
                        <div id="menu_purple" >
                            <div class="menu_item1_purple">
                                <a href="<?php echo url_for('related/first')?>">
                                    FIRST database
                                </a>
                            </div>
                            <div class="menu_item2_purple">
                                <a href="<?php echo url_for('related/cow')?>">
                                    Correlates of War
                                </a>
                            </div>
                            <div class="menu_item1_purple">
                                <a href="<?php echo url_for('related/aric')?>">
                                    Asia Regional Integration Centre
                                </a>
                            </div>
                            <div class="menu_item2_purple">
                                <a href="<?php echo url_for('related/risc')?>">
                                    RISC
                                </a>
                            </div>
                        </div>
                    </span>
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