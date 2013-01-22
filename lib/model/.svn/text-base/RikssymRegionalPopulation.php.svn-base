<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class RikssymRegionalPopulation extends RikssymIndicator {

    public $unitSymbol = "";
    public $roundToDecimals = "0";

    public function __construct() {

    }

    public function prepareQuery() {
        $countryIds = $this->entity->getCountryIds();
        $populationCriteria = new Criteria();
        $populationCriteria->clearSelectColumns();
        $populationCriteria->addSelectColumn(RikssymDataPeer::PERIOD);
        $populationCriteria->addAsColumn("value", "SUM(".RikssymDataPeer::VALUE.")");
        $populationCriteria->add(RikssymDataPeer::TYPE_ID, "19", CRITERIA::EQUAL);
        $populationCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $populationCriteria->add(RikssymDataPeer::REPORTER_ID, $countryIds, CRITERIA::IN);

        $populationCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
        $populationCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);
        $stmt = RikssymDataPeer::doSelectStmt($populationCriteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->values[$row['PERIOD']] =  $row['value'];
        }
//        $populationCriteria = new Criteria();
//        $populationCriteria->clearSelectColumns();
//        $populationCriteria->addSelectColumn(RikssymDataPeer::PERIOD);
//        $populationCriteria->addAsColumn("value", "SUM(".RikssymDataPeer::VALUE.")");
//        $populationCriteria->add(RikssymDataPeer::TYPE_ID, "19", CRITERIA::EQUAL);
//        $populationCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
//        $populationCriteria->addJoin(RikssymDataPeer::REPORTER_ID,
//                RikssymArrangementCountryPeer::COUNTRY_ID,
//                CRITERIA::LEFT_JOIN);
//
//        $populationCriteria->add(RikssymArrangementCountryPeer::ARRANGEMENT_ID,
//                $this->entity->getId(), CRITERIA::EQUAL);
//
//        $populationCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
//        $populationCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);
//        $stmt = RikssymDataPeer::doSelectStmt($populationCriteria);
//        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            $this->values[$row['PERIOD']] =  $row['value'];
//        }
    }
//
//    public function prepareCustomQuery() {
//        $countryIds = $this->entity->getCountryIds();
//        $populationCriteria = new Criteria();
//        $populationCriteria->clearSelectColumns();
//        $populationCriteria->addSelectColumn(RikssymDataPeer::PERIOD);
//        $populationCriteria->addAsColumn("value", "SUM(".RikssymDataPeer::VALUE.")");
//        $populationCriteria->add(RikssymDataPeer::TYPE_ID, "19", CRITERIA::EQUAL);
//        $populationCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
//        $populationCriteria->add(RikssymDataPeer::REPORTER_ID, $countryIds, CRITERIA::IN);
//
//        $populationCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
//        $populationCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);
//        $stmt = RikssymDataPeer::doSelectStmt($populationCriteria);
//        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            $this->values[$row['PERIOD']] =  $row['value'];
//        }
//    }

    public function getValueOfYear($year, $format) {
        if($format == true && in_array($year, $this->years)) {
            return number_format($this->values[$year],$this->roundToDecimals).$this->unitSymbol;
        }
        else if($format == false && in_array($year, $this->years)) {
            return $this->values[$year];
        }
        else {
            throw new Exception("RikssymIndicator::getValueOfYear ".$year." is not in array.");
        }
    }

    public function __toString() {
        $dump = implode(":",$this->values);
        return $dump;
    }
}
?>