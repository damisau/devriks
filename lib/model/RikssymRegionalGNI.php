<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class RikssymRegionalGNI extends RikssymIndicator{
    public $name;
    public $description;
    public $entity;
    public $years;
    public $ispublic;
    public $values;
    public $unitSymbol = "";
    public function __construct($name = "Regional GDP",
                                $description = "Regional GDP in current prices",
                                $years,
                                $entity,
                                $ispublic = 1
                                ){

        $this->name = $name;
        $this->description = $description;
        $this->years = $years;
        $this->entity = $entity;
        $this->ispublic = $ispublic;
        parent::setUnitSymbol($this->unitSymbol);
        if($this->entity instanceof RikssymCustomRegion){
            $this->prepareCustomQuery();
        }
        else{
            $this->prepareQuery();
        }
    }

    public function prepareQuery(){
        $gdpCriteria = new Criteria();
        $gdpCriteria->clearSelectColumns();
        $gdpCriteria->addSelectColumn(RikssymDataPeer::PERIOD);
        $gdpCriteria->addAsColumn("value", "SUM(".RikssymDataPeer::VALUE.")");
        $gdpCriteria->add(RikssymDataPeer::TYPE_ID, "20", CRITERIA::EQUAL);
        $gdpCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $gdpCriteria->addJoin(RikssymDataPeer::REPORTER_ID,
            RikssymArrangementCountryPeer::COUNTRY_ID,
            CRITERIA::LEFT_JOIN);

        $gdpCriteria->add(RikssymArrangementCountryPeer::ARRANGEMENT_ID,
            $this->entity->getId(), CRITERIA::EQUAL);

        $gdpCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
        $gdpCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);
        $stmt = RikssymDataPeer::doSelectStmt($gdpCriteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $this->values[$row['PERIOD']] =  $row['value'];
        }
    }

    public function prepareCustomQuery(){
        $countryIds = $this->entity->getCountryIds();
        $gdpCriteria = new Criteria();
        $gdpCriteria->clearSelectColumns();
        $gdpCriteria->addSelectColumn(RikssymDataPeer::PERIOD);
        $gdpCriteria->addAsColumn("value", "SUM(".RikssymDataPeer::VALUE.")");
        $gdpCriteria->add(RikssymDataPeer::TYPE_ID, "20", CRITERIA::EQUAL);
        $gdpCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $gdpCriteria->add(RikssymDataPeer::REPORTER_ID, $countryIds, CRITERIA::IN);

        $gdpCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
        $gdpCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);
        $stmt = RikssymDataPeer::doSelectStmt($gdpCriteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $this->values[$row['PERIOD']] =  $row['value'];
        }
    }

    public function __toString(){
        $dump = implode(":",$this->values);
        return $dump;
    }
}
?>