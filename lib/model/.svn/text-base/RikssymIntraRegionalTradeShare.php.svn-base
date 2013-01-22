<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class RikssymIntraRegionalTradeShare extends RikssymIndicator {

    private $intraTrade;
    private $worldTrade;

    public $unitSymbol = "%";
    public $decimals = 2;

    public function __construct() {

    }

    public function prepareQuery() {
        $intraregionalTrade = RikssymIndicatorFactory::createIndicator("RikssymIntraRegionalTrade",$this->entity,
                $this->years, false);
        $this->intraTrade = $intraregionalTrade->getValues();
        $worldTrade = RikssymIndicatorFactory::createIndicator("RikssymTradeOfRegionWithWorld",$this->entity,
                $this->years, false);
        $this->worldTrade = $worldTrade->getValues();
        $this->calculateRegionalShareInWorldTrade();

    }

    public function calculateRegionalShareInWorldTrade() {
        foreach($this->years as $year) {
            if(in_array($year, array_keys($this->intraTrade))) {
                $share = ($this->intraTrade[$year] / $this->worldTrade[$year]) * 100;
                $this->values[$year] = number_format($share,$this->decimals);
            } else {
                $this->values[$year] = "*0*";
                $this->frontendMessage[] = "Data unavailable for ".$year;
            }

        }
    }

    public function __toString() {
        $dump = implode(":",$this->values);
        return $dump;
    }

    public function getValueOfYear($year, $format) {
        $returnValue = $this->values[$year];
        if($format == true && is_numeric($returnValue)) {
            return number_format($returnValue, $this->decimals);
        } else if($format == false && is_numeric($returnValue)) {
            return $returnValue;
        } else if($format == true && !is_numeric($returnValue)) {
            return $returnValue;
        } else if($format == false && !is_numeric($returnValue)) {
            return 0;
        }
    }
}
?>
