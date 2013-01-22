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

            <div class="pink_header"></div>
            <div class="pink_banner">
                <?php $menuColor = "pink"; include_partial('global/horizontalMenu',
                    array('menuColor'=> $menuColor));?>

            </div>
            <table border="0" cellspacing="0" border="0" class="table_frame_pink">
                <tr>
                    <td width="240" valign="top" class="menu_col_pink" height="550px;">
                    <span id="menu_left">
                        <div id="menu_pink" >
                            <div class="menu_item1_pink">
                                <a href="<?php echo url_for('news/google')?>">
                                    google news
                                </a>
                            </div>
                            <div class="menu_item2_pink">
                                <a href="<?php echo url_for('news/providers')?>">
                                    news providers
                                </a>
                            </div>
                            <div class="menu_item1_pink">
                                <a href="<?php echo url_for('news/zei')?>">
                                    ZEI observer
                                </a>
                            </div>
                            <div class="menu_item2_pink">
                                <a href="<?php echo url_for('news/latn')?>">
                                    LATN newsletter
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