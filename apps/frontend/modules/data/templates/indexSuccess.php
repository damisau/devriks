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
        if(!(arrangements.length > 0)){
            errorMessage += '<font color=\"red\">Please select at least one arrangement from the menu</font><br>';
        }
        if(!(tradeIndicators.length > 0) && !(nationalIndicators.length > 0)){
            errorMessage += '<font color=\"red\">Please select at least one indicator from the menu</font><br>';
        }

        if(errorMessage.length > 0){
            $('errors').update(errorMessage);
            return false;
        }
        else {
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
            //removeBefore(1980);
            $('errors').update('<b>Please note: Regional HDI is only available after 1979.</B>');
        }
        else if(stack.exists("RikssymRegionalImmigrationShare") || stack.exists("RikssymRegionalMigrantsPopulationShare")
                    || stack.exists("RikssymRegionalEmigrationShare")
                    || stack.exists("RikssymTotalImmigrantsInPopulationShare")){
            modified = true;
            removeExcept(1970);
            addYear(1980);
            addYear(1990);
            addYear(2000);
            $('errors').update('<b>Please note: Migration data is only available for 2005.</B>');
        }
        if(modified == false && removed == true){
            addAllYears();
        }
    }

    function removeBefore(year){
        console.log('removeBefore: ' + year)
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
        console.log('removeExcept' + year);
        var options = document.getElementById('yearmenu').getElementsByTagName('option');
        var max = options.length -1;
        for(i=max;i > -1; i--){
            if(parseInt(options[i].value) != year){
                document.getElementById('yearmenu').removeChild(options[i]);
            }
        }
        removed = true;
    }

    function addYear(year){
        console.log('addYear: ' + year);
        var options = document.getElementById('yearmenu').getElementsByTagName('option');
        var newOption = document.createElement("option");
        newOption.setAttribute("value", year);
        newOption.innerHTML = year;
        document.getElementById('yearmenu').appendChild(newOption);
    }

    function addAllYears(){
        console.log('addAllYears');
        var options = document.getElementById('yearmenu').getElementsByTagName('option');
        var max = options.length -1;
        for(i=max;i > -1; i--){
            if(parseInt(options[i].value) <= 2011){
                document.getElementById('yearmenu').removeChild(options[i]);
            }
        }
        for(j=<?php echo sfConfig::get('app_minyear') ?>;j<= <?php echo sfConfig::get('app_maxyear') ?>; j++){
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
<h1>Regional Indicators</h1>
<p>
    This section provides statistical information of selected regional arrangements.
    The selected data can be viewed as table and exported as a graph or spreadsheet.
    Please note that a graph can only be rendered when the selection is limited to
    eight regional arrangements and one indicator.</p>
<p>The presented regional arrangements do not express any acknowledgement or disproval
    of regional arrangements, but is rather an open list presented for your convenience.
    In case you think an important arrangement should be added
    to our list of arrangements, please <a href="mailto:bfuhne@cris.unu.edu">notify us via e-mail</a>.
</p>
<p>
    Meanwhile <b>create your own <a href="<?php echo url_for('data/customIndex')?>">custom region
    </a></b> to find the data you need.
</p>
<p>
    For further information about the presented data and indicators, please consult the <a href="http://www.cris.unu.edu/riks/web/about/notes">technicals notes
    </a> or the specific information presented with the data of your selection.</p>
<p>
    Make your selection below. To select multiple items, press and hold the CTRL key while selecting
    items with your mouse.
</p>
<div id="errors"></div>
<div id="indicatorMenu">
    <?php echo form_tag('data/show', 'method=POST') ?>
    <FORM NAME="getStatistics" ACTION="<?php echo url_for('data/show')?>" METHOD="GET" id="getStats">
        <div id="arrangementList">
            <B>Arrangements</B>(select one or more organizations, click
            <?php
            if($abbrev == 1) {
                echo link_to('here', 'data/index')." to order by name)";
            } else {
                echo link_to('here', 'data/index?abbrev=1')." to order by acronyms)";
            }
            ?>
            <br>
            <SELECT MULTIPLE NAME="omenu[]" SIZE="10" id="countrymenu">
                <?php echo options_for_select($options) ?>
            </SELECT>
        </div>
        <div id="years">
            <B>Years:</B><br>

            <SELECT MULTIPLE NAME="years[]" SIZE="10" id="yearmenu">
                <?php
                $minyear = sfConfig::get('app_minyear');
                $maxyear = sfConfig::get('app_maxyear');
                while($minyear <= $maxyear) {
                    ?>
                <option value="<?php echo $minyear ?>"><?php echo $minyear ?></option>
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
                <SELECT MULTIPLE NAME="data[]" SIZE="10" id="tradeIndicator">
                    <?php echo objects_for_select($rikssym_tradeIndicator_list,'getClassName','getName') ?>
                </SELECT>
            </div>
            <div id="nationalAccounts">
                <b>Human development and population:</b><br>
                <SELECT MULTIPLE NAME="data[]" SIZE="10" id="nationalIndicator" onchange="checkForValidRange();">
                    <?php echo objects_for_select($rikssym_nationalIndicator_list,'getClassName','getName') ?>
                </SELECT>
            </div>
            <br><input type="button" onclick="validate();" value="View data">
        </div>
    </FORM>
</div>
