<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class RikssymIntraRegionalTradeIntensityIndex extends RikssymIndicator{
    public $intraregionalTrade;
    public $totalTradeOfRegion;
    public $worldTrade;
    public $decimals = 2;
    public $unitSymbol = "";

    public function __construct(){
    }

    public function prepareQuery(){
        $rikssymIntraRegionalTrade = RikssymIndicatorFactory::createIndicator("RikssymIntraRegionalTrade", 
                                                                            $this->entity,
                                                                            $this->years,
                                                                            false);
        $this->intraregionalTrade = $rikssymIntraRegionalTrade->getValues();
        

        $rikssymTradeOfRegionWithWorld = RikssymIndicatorFactory::createIndicator("RikssymTradeOfRegionWithWorld",
                                                                                $this->entity,
                                                                                $this->years,
                                                                                false);
        $this->totalTradeOfRegion = $rikssymTradeOfRegionWithWorld->getValues();
        

        $rikssymWorldTrade = RikssymIndicatorFactory::createIndicator("RikssymWorldTrade",
                                                                        $this->entity,
                                                                        $this->years,
                                                                        false);
        $this->worldTrade =  $rikssymWorldTrade->getValues();        

        foreach($this->years as $year){
            if(in_array($year, array_keys($this->intraregionalTrade))
                && in_array($year, array_keys($this->totalTradeOfRegion))
                && in_array($year, array_keys($this->worldTrade)))
            {
                if($this->totalTradeOfRegion[$year] != 0 && $this->worldTrade[$year] != 0)
                {
                    $this->values[$year] = ($this->intraregionalTrade[$year] / $this->totalTradeOfRegion[$year]) /
                    ($this->totalTradeOfRegion[$year] / $this->worldTrade[$year]);
                }
            } else{
                $this->values[$year] = "*0*";
                $this->frontendMessage[] = "Data unavailable for ".$year;
            }
        }        
    }

    public function getValueOfYear($year, $format){
        $returnValue = $this->values[$year];
        if($format == true && is_numeric($returnValue)){
            return number_format($returnValue, $this->decimals);
        } else if($format == false && is_numeric($returnValue)){
            return $returnValue;
        } else if($format == true && !is_numeric($returnValue)){
            return $returnValue;
        } else if($format == false && !is_numeric($returnValue)){
            return "x";
        }        
    }
}
?>