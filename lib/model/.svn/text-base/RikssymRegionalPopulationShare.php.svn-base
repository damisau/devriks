<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class RikssymRegionalPopulationShare extends RikssymIndicator{
    private $regionalPopulation;
    private $worldPopulation;

    public $decimals = 2;
    public $unitSymbol = "%";

    public function __construct(){
        
    }

    public function prepareQuery(){
        $this->calculateRegionalPopulation();
        $this->calculateWorldPopulation();
        $this->calculateRegionalShareInWorldPopulation();
    }

    public function calculateRegionalPopulation(){
        $regionalPopulationIndicator = RikssymIndicatorFactory::createIndicator("RikssymRegionalPopulation",$this->entity,
                                                                            $this->years, false);
        $this->regionalPopulation = $regionalPopulationIndicator->getValues();
    }

    public function calculateWorldPopulation(){
        $popCriteria = new Criteria();
        $popCriteria->clearSelectColumns();
        $popCriteria->addSelectColumn(RikssymDataPeer::PERIOD);
        $popCriteria->addSelectColumn(RikssymDataPeer::REPORTER_ID);
        $popCriteria->add(RikssymDataPeer::REPORTER_ID,"321");
        $popCriteria->addAsColumn("value", "SUM(".RikssymDataPeer::VALUE.")");
        $popCriteria->add(RikssymDataPeer::TYPE_ID, "19", CRITERIA::EQUAL);
        $popCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $popCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
        $popCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);

        $stmt = RikssymDataPeer::doSelectStmt($popCriteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $this->worldPopulation[$row['PERIOD']] =  $row['value'];
        }
    }

    public function calculateRegionalShareInWorldPopulation(){
        foreach($this->years as $year){
          $share = ($this->regionalPopulation[$year] / $this->worldPopulation[$year]) * 100;
          $share = number_format($share, 2);
          $this->values[$year] = $share;
        }
    }

    public function __toString(){
        $dump = implode(":",$this->values);
        return $dump;
    }
}
?>