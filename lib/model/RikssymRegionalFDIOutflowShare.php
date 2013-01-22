<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of RikssymRegionalFDIInflowShare
 * IMPORTANT
 * FDI data is stored multiplied by 1.000 compared to original data
 * @author BFuhne
 */
class RikssymRegionalFDIOutflowShare extends RikssymIndicator {
    public $unitSymbol = "%";
    public $roundToDecimals = 2;
    public $totalFDIOutflow;
    public $regionalGDP;

    public function construct() {

    }

    public function prepareQuery() {
        $countryIds = $this->entity->getCountryIds();
        $this->calculateRegionalFDIOutflow($countryIds);
        $this->calculateRegionalGDP($countryIds);
        $this->calculateIndicator();
        //$this->checkMissingValues();
    }

    public function calculateRegionalFDIOutflow($countryIds) {
        $fdiCriteria = new Criteria();
        $fdiCriteria->addAsColumn("totalFDIOutflow", "SUM(".RikssymDataPeer::VALUE.")");
        $fdiCriteria->addAsColumn("year", RikssymDataPeer::PERIOD);
        $fdiCriteria->add(RikssymDataPeer::TYPE_ID,"7",Criteria::EQUAL);
        $fdiCriteria->add(RikssymDataPeer::REPORTER_ID,$countryIds,Criteria::IN);
        $fdiCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $fdiCriteria->add(RikssymDataPeer::VALUE,"999999999",Criteria::NOT_EQUAL);
        $fdiCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
        $fdiCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);

        $stmt = RikssymDataPeer::doSelectStmt($fdiCriteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->totalFDIOutflow[$row['year']] = ($row['totalFDIOutflow'] * 1000);
        }
    }

    public function calculateRegionalGDP($countryIds){
        $gdp = RikssymIndicatorFactory::createIndicator("RikssymRegionalGDP",
                $this->entity, $this->years, false);
        $this->regionalGDP = $gdp->getValues();
    }

    public function calculateIndicator(){
        foreach($this->years as $year){
            $this->values[$year] = number_format(($this->totalFDIOutflow[$year] /
                                $this->regionalGDP[$year]) * 100, $this->roundToDecimals);
        }
    }
}
?>
