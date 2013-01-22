<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class RikssymRegionalGDPShare extends RikssymIndicator{
    private $regionalGDP;
    private $worldGDP;
    
    public $unitSymbol = "%";
    public $decimals = 2;
   

    public function __construct(){
    }

    public function prepareQuery(){
        $this->calculateRegionalGDP();
        $this->calculateWorldGDP();
        $this->calculateRegionalShareInWorldGDP();
    }

    public function calculateRegionalGDP(){
        $regionalGDPIndicator = RikssymIndicatorFactory::createIndicator("RikssymRegionalGDP",
                                                                        $this->entity,
                                                                        $this->years,
                                                                        false);
        $this->regionalGDP = $regionalGDPIndicator->getValues();        
    }

    public function calculateWorldGDP(){
        $gdpCriteria = new Criteria();
        $gdpCriteria->clearSelectColumns();
        $gdpCriteria->addSelectColumn(RikssymDataPeer::PERIOD);
        $gdpCriteria->addAsColumn("value", "SUM(".RikssymDataPeer::VALUE.")");
        $gdpCriteria->add(RikssymDataPeer::TYPE_ID, "18", CRITERIA::EQUAL);
        $gdpCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $gdpCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
        $gdpCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);

        $stmt = RikssymDataPeer::doSelectStmt($gdpCriteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $this->worldGDP[$row['PERIOD']] =  $row['value'];
        }
    }

    public function calculateRegionalShareInWorldGDP(){
        foreach($this->years as $year){
          $share = ($this->regionalGDP[$year] / $this->worldGDP[$year]) * 100;
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