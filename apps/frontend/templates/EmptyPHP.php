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
    <body onload="load()">
        <div id="wrapper">
            <div class="green_header"></div>
            <div class="green_banner">
                 <?php include_partial('global/horizontalMenu'); ?>
            </div>
            <table border="0" cellspacing="0" border="0" class="table_frame_green">
                <tr>
                    <td width="240" valign="top" class="menu_col_green">
                        <span id="menu_left">
                            <div id="menu_green">
                                <div class="menu_item1_green">
                                    <a href="<?php echo url_for('arrangement/index')?>">
                                        regional arrangements
                                    </a>
                                </div>
                                <div class="menu_item2_green">
                                    <a href="<?php echo url_for('data/index')?>">
                                        regional indicators
                                    </a>
                                </div>
                                <div class="menu_item1_green">
                                    <a href="<?php echo url_for('data/customIndex')?>">
                                        custom regions
                                    </a>
                                </div>
                                <div class="menu_item2_green">
                                    <a href="<?php echo url_for('document/index')?>">
                                        legal texts
                                    </a>
                                </div>
                                <div class="menu_item1_green">
                                    <a href="<?php echo url_for('dblinks/index')?>">
                                        links to databases
                                    </a>
                                </div>
                                <div class="menu_item2_green">
                                    <a href="<?php echo url_for('dblinks/asil')?>">
                                        ASIL reports
                                    </a>
                                </div>
                            </div>
                        </span>
                    </td>
                    <td width="650" valign="top" align="left">
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