<?php use_helper('Object'); ?>
<h1>Regional Indicators</h1>
<div id="indicatorMenu">
    <?php echo form_tag('data/show', 'method=POST') ?>
    <FORM NAME="getStatistics" ACTION="<?php echo url_for('data/show')?>" METHOD="GET">
        <div id="arrangementList">
            Arrangements(select one or more organizations, click
            <a href="Regional-Indicators.148.0.html?&no_cache=1&order=name">here</a>
            to order by acronyms)<br>
            <SELECT MULTIPLE NAME="omenu[]" SIZE="10">
                <?php echo objects_for_select(
                    $rikssym_arrangement_list,'getId','getName') ?>
            </SELECT>
        </div>
        <div id="years">
            Years:(select one or more years)<br>

            <SELECT MULTIPLE NAME="years[]" SIZE="10">
                <?php
                $minyear = sfConfig::get('app_minyear');
                $maxyear = sfConfig::get('app_maxyear');
                while($minyear <= $maxyear){
                    ?>      <option value="<?php echo $minyear ?>"><?php echo $minyear ?></option>
                    <?
                    $minyear++;
                }
                ?>
            </SELECT>

        </div>
        <div id="indicators">
            Indicators:(select one or more indicators)<br>
            <SELECT MULTIPLE NAME="data[]" SIZE="9">
                <?php echo objects_for_select($rikssym_indicator_list,'getId','getName', 2) ?>
            </SELECT>
           <br><?php echo submit_tag('Show Data') ?>
        </div>
    </FORM>
</div>