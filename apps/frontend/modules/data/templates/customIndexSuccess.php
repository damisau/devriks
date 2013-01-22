<?php use_helper('Object'); ?>
<?php use_helper('Javascript') ?>

<script type="text/javascript">
    //<![CDATA[

    var removed = false;

    function validate() {
        var years = $F('yearmenu');
        var arrangements = $F('countrymenu');
        var tradeIndicators = $F('tradeIndicator');
        var nationalIndicators = $F('nationalIndicator');
        var errorMessage = '';

        if(!(years.length > 0)){
            errorMessage += '<font color=\"red\">Please select at least one year from the menu</font><br>';
        }
        if(!(arrangements.length >=3)){
            errorMessage += '<font color=\"red\">Please select at least 3 countries from the menu</font><br>';
        }
        if(!(tradeIndicators.length > 0) && !(nationalIndicators.length > 0)){
            errorMessage += '<font color=\"red\">Please select at least one indicator from the menu</font><br>';
        }

        if(errorMessage.length > 0){
            $('errors').update(errorMessage);
            return false;
        }
        else {
            $('errors').update("");
            document.forms[0].submit();
        }
    }

    Array.prototype.exists = function(search){
        for (var i=0; i<this.length; i++)
        if (this[i] == search) return true;

        return false;
    }

    function getSelects(element) {
        var element = document.getElementById('nationalIndicator');
        var options = element.getElementsByTagName('option');
        stack = [];
        for (var i=0; i<options.length; i++) {
            if (options[i].selected) { stack.push(options[i].value); }
        }
        return stack;
    }

    function checkForValidRange(){
        var stack = getSelects('n');
        var modified = false;
        if(stack.exists("RikssymRegionalHDI") && !(stack.exists("RikssymRegionalImmigrationShare"))
            && !(stack.exists("RikssymRegionalMigrantsPopulationShare"))
            && !(stack.exists("RikssymTotalImmigrantsInPopulationShare"))
            && !(stack.exists("RikssymRegionalEmigrationShare")))
        {
            modified = true;
            addAllYears();
            removeBefore(1980);
            $('errors').update('<b>Please note: Regional HDI is only available after 1979.</B>');
        }
        else if(stack.exists("RikssymRegionalImmigrationShare") || stack.exists("RikssymRegionalMigrantsPopulationShare")
                    || stack.exists("RikssymRegionalEmigrationShare")
                    || stack.exists("RikssymTotalImmigrantsInPopulationShare")){
            modified = true;
            removeExcept(2000);
            $('errors').update('<b>Please note: Migration data is only available for 2005.</B>');
        }
        if(modified == false && removed == true){
            addAllYears();
        }
    }

    function removeBefore(year){
        var options = document.getElementById('yearmenu').getElementsByTagName('option');
        var max = options.length -1;
        for(i=max;i > -1; i--){
            if(parseInt(options[i].value) < year){
                document.getElementById('yearmenu').removeChild(options[i]);
            }
        }
        removed = true;
    }

    function removeExcept(year){
        var options = document.getElementById('yearmenu').getElementsByTagName('option');
        var max = options.length -1;
        for(i=max;i > -1; i--){
            if(parseInt(options[i].value) != year){
                document.getElementById('yearmenu').removeChild(options[i]);
            }
        }
        removed = true;
    }

    function addAllYears(){
        var options = document.getElementById('yearmenu').getElementsByTagName('option');
        var max = options.length -1;
        for(i=max;i > -1; i--){
            if(parseInt(options[i].value) <= 2008){
                document.getElementById('yearmenu').removeChild(options[i]);
            }
        }
        for(j=<?php echo sfConfig::get('app_minyear') ?>;j< <?php echo sfConfig::get('app_maxyear') ?>; j++){
            var newOption = document.createElement("option");
            newOption.setAttribute("value", j);
            newOption.innerHTML = j;
            document.getElementById('yearmenu').appendChild(newOption);
        }
        $('errors').update('');
        removed = false;
    }

    //]]>
</script>
<div class="breadcrumb_green"><?php echo $breadcrumb ?></div>
<h1>Regional Indicators</h1
<p>This section provides a means to create a custom regional arrangement based on the countries listed below.
    After choosing the countries you can choose the years and indicator(s) you would like to view data for.<br>
</p>
<p>For further information about the presented data and indicators,
    please consult the <a href="http://www.cris.unu.edu/riks/web/static/notes">technicals notes</a> or the specific information
    presented with the data of your selection.</p>
<p>
    Make your selection below. To select multiple items, press and hold the CTRL key while selecting
    items with your mouse. If you would like to export dataa as a graph, please limit your selection to one indicator and select at least
    2 years and 3 countries.
</p>
<div id="errors"></div>
<div id="indicatorMenu">
    <?php echo form_tag('data/customShow', 'method=POST') ?>
    <FORM NAME="getStatistics" ACTION="<?php echo url_for('data/customShow')?>" METHOD="GET" id="getStats">
        <div id="arrangementList">
            <b>Countries</b>&nbsp;(select 3 or more countries)<br>
            <SELECT MULTIPLE NAME="omenu[]" SIZE="10" id="countrymenu">
                <?php echo objects_for_select(
                $countryList,'getId','getName') ?>
            </SELECT>
        </div>
        <div id="years">
            <b>Years:</b><br>

            <SELECT MULTIPLE NAME="years[]" SIZE="10" id="yearmenu">
                <?php
                $minyear = sfConfig::get('app_minyear');
                $maxyear = sfConfig::get('app_maxyear');
                while($minyear <= $maxyear) {
                    ?>      <option value="<?php echo $minyear ?>"><?php echo $minyear ?></option>
                    <?php
                    $minyear++;
                }
                ?>
            </SELECT>

        </div>
        <div id="indicators">
            <B>Indicators</B><br><br>
            <div id="tradeIndicators">
                <b>Economic development and trade:</b><br>
                <SELECT MULTIPLE NAME="data[]" SIZE="9" id="tradeIndicator" onchange="checkForValidRange();">
                    <?php echo objects_for_select($rikssym_tradeIndicator_list,'getClassName','getName') ?>
                </SELECT>
            </div>
            <div id="nationalAccounts">
                <b>Human development and population:</b><br>
                <SELECT MULTIPLE NAME="data[]" SIZE="9" id="nationalIndicator" onchange="checkForValidRange();">
                    <?php echo objects_for_select($rikssym_nationalIndicator_list,'getClassName','getName') ?>
                </SELECT>
            </div>
            <br><input type="button" onclick="validate();" value="View data">
        </div>
    </FORM>
</div>