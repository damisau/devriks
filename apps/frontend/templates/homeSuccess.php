<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
    <body onload="initialize()">
        <div id="wrapper">
            <div style="height:85px">
                <div style="float:left"><img src="img/riks_logo.jpg" alt="Logo of UNU" /></div>
                <div style="float:right;padding-top:45px"><img src="img/riks_slogan.jpg" alt="Slogan:
                                                               Regional Integration Knowledge System" />
                </div>
            </div>
            <div id="banner_wrapper">
                <div class="banner_wrapper">
                    <div id="left_banner_content">
                        <div style="height:164px">
                            <!-- row 1-->
                            <!-- item 1 -->
                            <div class="col">
                                <div class="col_wrapper">
                                    <div class="banner_header">
                                        <a href="/devriks/web/static/about/">about riks</a></div>
                                    <br/>
                                    <div class="item1">
                                        <a href="/devriks/web/about/developments">
                                            • latest developments
                                        </a>
                                    </div>
                                    <div class="item_clean">
                                        <a href="/devriks/web/about/partners/">
                                            • partners
                                        </a>
                                    </div>
                                    <div class="item1">
                                        <a href="/devriks/web/about/notes">
                                            • technical notes
                                        </a>
                                    </div>
                                    <div class="item_clean">
                                        <a href="/devriks/web/about/contents">
                                            • contents
                                        </a>
                                    </div>
                                    <div class="item1">
                                        <a href="/devriks/web/about/funding">
                                            • funding
                                        </a>
                                    </div>                                    
                                    <div class="item_clean">
                                        <a href="/devriks/web/about/contact">
                                            • contact us
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- item 2 -->
                            <div class="col">
                                <div class="col_wrapper">
                                    <div class="banner_header">
                                        <a href="/devriks/web/static/database">databases
                                        </a>
                                    </div>

                                    <br/>
                                    <div class="item2">
                                        <a href="<?php echo url_for('arrangement/index');?>">
                                            • UNU-CRIS regional arrangements database
                                        </a>
                                    </div>
                                    <div class="item_clean">
                                        <a href="<?php echo url_for('data/index');?>">
                                            • UNU-CRIS regional indicators
                                        </a></div>
                                    <div class="item2">
                                        <a href="<?php echo url_for('document/index');?>">
                                            • UNU-CRIS legal texts
                                        </a>
                                    </div>
                                    <div class="item_clean">
                                        <a href="http://www.cris.unu.edu/map">
                                            • UNU-CRIS map application
                                        </a>
                                    </div>
                                    <div class="item2">
                                        <a href="<?php echo url_for('dblinks/index');?>">
                                            • other databases
                                        </a>
                                    </div>                                    
                                </div>
                            </div>

                            <!-- item 3 -->
                            <div class="col">
                                <div class="col_wrapper">
                                    <div class="banner_header">
                                        <a href="<?php echo url_for('news/google');?>">news
                                        </a>
                                    </div>
                                    <br/>
                                    <div class="item3">
                                        <a href="<?php echo url_for('news/google');?>">
                                            • google news
                                        </a>
                                    </div>
                                    <div class="item_clean">
                                        <a href="<?php echo url_for('news/zei');?>">
                                            • ZEI regional integration observer
                                        </a>
                                    </div>
                                    <div class="item3">
                                        <a href="<?php echo url_for('news/latn');?>">
                                            • LATN newsletter
                                        </a>
                                    </div>
                                    <div class="item_clean">
                                        <a href="<?php echo url_for('news/providers');?>">
                                            • other news providers
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- row2 -->
                        <div style="padding-top:55px">
                            <!-- item 1 -->
                            <div class="col">
                                <div class="col_wrapper">
                                    <div class="banner_header">
                                        <a href="/devriks/web/static/research">
                                            research
                                        </a>
                                    </div>

                                    <br/>
                                    <div class="item4">
                                        <a href="<?php echo url_for('journal/index');?>">
                                            • journals
                                        </a>
                                    </div>
                                    <div class="item_clean">
                                        <a href="<?php echo url_for('center/index');?>">
                                            • research centers
                                        </a>
                                    </div>
                                    <div class="item4">
                                        <a href="<?php echo url_for('papers/index');?>">
                                            • working papers
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- item 5 -->
                            <div class="col">
                                <div class="col_wrapper">
                                    <div class="banner_header">
                                        <a href="/devriks/web/static/education">
                                            education
                                        </a>
                                    </div>
                                    <br/>
                                    <div class="item5">
                                        <a href="<?php echo url_for('education/training');?>">
                                            • training programmes
                                        </a>
                                    </div>
                                    <div class="item_clean">
                                        <a href="<?php echo url_for('education/master');?>">
                                            • master programmes
                                        </a>
                                    </div>
                                    <div class="item5">
                                        <a href="<?php echo url_for('education/phd');?>">
                                            • phD programmes
                                        </a>
                                    </div>
                                    <div class="item_clean">
                                        <a href="<?php echo url_for('education/virtual');?>">
                                            • UNCTAD virtual institute
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- item 6 -->
                            <div class="col">
                                <div class="col_wrapper">
                                    <div class="banner_header">
                                        <a href="/devriks/web/static/related">
                                            related platforms
                                        </a>
                                    </div>
                                    <br/>
                                    <div class="item6">
                                        <a href="<?php echo url_for('related/first');?>">
                                            • facts on security and international relations
                                        </a>
                                    </div>
                                    <div class="item_clean">
                                        <a href="<?php echo url_for('related/cow');?>">
                                            • correlates of war project
                                        </a>
                                    </div>
                                    <div class="item6">
                                        <a href="<?php echo url_for('related/aric');?>">
                                            • Asia regional integration center
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="right_banner_content">
                        <p class="right_titel"><b>RIKS</b></p>
                        <p><b>
                                RIKS is essentially a web-based information and learning platform on regional integration processes worldwide
                            </b>
                        </p>
                        <p class="right_titel">Latest Developments</p>
                        <b>2010-12-16 New Content Partner</b><br/>
				We are happy to announce a new content partnership with the <a href="http://www.redmercosur.org">Mercosur Economic Research Network</a>

                            <p><b>2010-11-02 Data Update</b><br/>
                                    The trade data in the regional indicators section has been updated. Data is now available from 1970 until 2008 (including).
                            </p>
                    </div>
                </div>
            </div>
            <br/>
            <div id="little_banner">
                <span>hosting institute</span>   <span>partners</span>
            </div>
            <table>
                <tr>
                    <td><img src="img/logo_1.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_01.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_02.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_03.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_04.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_05.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_06.jpg" alt="Partner logo" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="img/logo_08.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_09.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_10.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_11.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_12.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_13.jpg" alt="Partner logo" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><img src="img/logo_14.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_15.jpg" alt="Partner logo" /></td>
                    <td><img src="img/logo_16.jpg" alt="Partner logo" /></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </body>
</html>
