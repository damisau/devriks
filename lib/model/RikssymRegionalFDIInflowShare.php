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
class RikssymRegionalFDIInflowShare extends RikssymIndicator {
    public $unitSymbol = "%";
    public $roundToDecimals = 2;
    public $totalFDIInflow;
    public $regionalGDP;
    public $countryIds;

    public function construct() {

    }

    public function prepareQuery() {
        $this->countryIds = $this->entity->getCountryIds();
        $this->calculateRegionalFDIInflow($this->countryIds);
        $this->calculateRegionalGDP($this->countryIds);
        $this->calculateIndicator();
        //$this->checkMissingValues($countryIds);
    }

    public function calculateRegionalFDIInflow($countryIds) {
        $fdiCriteria = new Criteria();
        $fdiCriteria->addAsColumn("totalFDIInflow", "SUM(".RikssymDataPeer::VALUE.")");
        $fdiCriteria->addAsColumn("year", RikssymDataPeer::PERIOD);
        $fdiCriteria->add(RikssymDataPeer::TYPE_ID,"8",Criteria::EQUAL);
        $fdiCriteria->add(RikssymDataPeer::REPORTER_ID,$countryIds,Criteria::IN);
        $fdiCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $fdiCriteria->add(RikssymDataPeer::VALUE,"999999999",Criteria::NOT_EQUAL);
        $fdiCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
        $fdiCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);

        $stmt = RikssymDataPeer::doSelectStmt($fdiCriteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->totalFDIInflow[$row['year']] = ($row['totalFDIInflow'] * 1000);
        }        
    }

    public function checkMissingValues($countryIds){
        $conn = Propel::getConnection();
        foreach($this->years as $year){
            foreach($countryIds as $countryId){
                $query = "SELECT value FROM rikssym_data ".
                            "WHERE reporter_id = ? ".
                            "AND type_id = 8 ".
                            "AND period = ?";
                $stmt = $conn->prepare($query);
                $stmt->bindValue(1, $countryId);
                $stmt->bindValue(2, $year);
                $rs = $stmt->execute();
            }
        }
    }

    public function calculateRegionalGDP($countryIds){
        $pop = RikssymIndicatorFactory::createIndicator("RikssymRegionalGDP",
                $this->entity, $this->years, false);
        $this->regionalGDP = $pop->getValues();
    }

    public function calculateIndicator(){
        foreach($this->years as $year){
            $this->values[$year] = number_format(($this->totalFDIInflow[$year] /
                                $this->regionalGDP[$year]) * 100, $this->roundToDecimals);
        }
    }
}
?>
