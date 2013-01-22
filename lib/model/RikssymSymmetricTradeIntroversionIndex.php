<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class RikssymSymmetricTradeIntroversionIndex extends RikssymIndicator {
    public $unitSymbol = "";
    public $decimals = 2;
    public $values;

    public function __construct(){
    }

    public function prepareQuery() {
        $intraregionalTrade = array();
        $totalTradeOfRegion = array();
        $totalExtraregionalTradeOfRegion = array();
        $totalWorldTrade = array();

        $rikssymIntraRegionalTrade = RikssymIndicatorFactory::createIndicator("RikssymIntraRegionalTrade",
                                                                            $this->entity,
                                                                            $this->years,
                                                                            false);
                
                
        $intraregionalTrade = $rikssymIntraRegionalTrade->getValues();

        $rikssymTradeOfRegionWithWorld = RikssymIndicatorFactory::createIndicator("RikssymTradeOfRegionWithWorld",
                                                                            $this->entity,
                                                                            $this->years,
                                                                            false);

        $totalTradeOfRegion = $rikssymTradeOfRegionWithWorld->getValues();

        $rikssymExtraregionalTradeOfRegion = RikssymIndicatorFactory::createIndicator("RikssymExtraregionalTradeOfRegion",
                                                                            $this->entity,
                                                                            $this->years,
                                                                            false);
       
        $totalExtraregionalTradeOfRegion = $rikssymExtraregionalTradeOfRegion->getValues();

        $rikssymWorldTrade = RikssymIndicatorFactory::createIndicator("RikssymWorldTrade",
                                                                            $this->entity,
                                                                            $this->years,
                                                                            false);
      
        $totalWorldTrade = $rikssymWorldTrade->getValues();
        
        $stj = array();
        $hiti = array();
        $heti = array();
        $i = 0;
        foreach($this->years as $year) {
            if(
            !(($totalWorldTrade[$year] - $intraregionalTrade[$year]) == 0) &&
                    !(($totalWorldTrade[$year] - $intraregionalTrade[$year]) == 0)
                    && is_numeric($intraregionalTrade[$year])
            ) {
                $hiti[$year] = ($intraregionalTrade[$year] / $totalTradeOfRegion[$year]) /
                        ($totalExtraregionalTradeOfRegion[$year] /
                                ($totalWorldTrade[$year] - $intraregionalTrade[$year]));
                $nominator = 1 - ($intraregionalTrade[$year] /
                                $totalTradeOfRegion[$year]);
                $denominator = 1 - ($totalExtraregionalTradeOfRegion[$year] /
                                ($totalWorldTrade[$year] - $intraregionalTrade[$year]));
                $heti[$year] = $nominator / $denominator;
            }
            else {
                $hiti[$year] = array($year => "n/a");
                $heti[$year] = array($year => "n/a");
            }
            $i++;
        }
        $i=0;
        foreach($this->years as $year) {
            if( is_numeric($hiti[$year]) && is_numeric($heti[$year])){
                $nominator = bcdiv($hiti[$year],$heti[$year],10);
                $nominator = $nominator -1;
                $denominator = bcdiv($hiti[$year], $heti[$year], 10);
                $denominator = $denominator + 1;
                $this->values[$year] = bcdiv($nominator, $denominator, 10);
            } else{
                $this->values[$year] = "x";
                $this->frontendMessage[] = "Data missing for ".$year;
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
