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
<body>
    <div id="wrapper">
        <div class="orange_header"></div>
        <div class="orange_banner">
            <?php $menuColor = "orange"; include_partial('global/horizontalMenu',
                                            array('menuColor'=> $menuColor));?>
        </div>
    
    <table border="0" cellspacing="0" border="0" class="table_frame_orange">
        <tr>
            <td width="240" valign="top" class="menu_col_orange" height="550px;">
                <span id="menu_left">
                    <div id="menu_orange" >
                        <div class="menu_item1_orange">
                            <a href="<?php echo url_for('education/training'); ?>">
                                Training Programmes
                            </a>
                        </div>
                        <div class="menu_item2_orange">
                            <a href="<?php echo url_for('education/master'); ?>">
                                Master Programmes
                            </a>
                        </div>
                        <div class="menu_item1_orange">
                            <a href="<?php echo url_for('education/phd'); ?>">
                                PhD Programmes
                            </a>
                        </div>
                        <div class="menu_item2_orange">
                            <a href="<?php echo url_for('education/virtual'); ?>">
                                UNCTAD virtual institute
                            </a>
                        </div>
                    </div>
                </span>
            </td>

            <td width="725" valign="top" align="left">
                <div class="frame_wrapper">
                    <div>
                        <p><?php echo $sf_content ?></p>
                    </div>
                </div>

            &nbsp;</td>
        </tr>
    </table>
    </div>
</body>
</html>
