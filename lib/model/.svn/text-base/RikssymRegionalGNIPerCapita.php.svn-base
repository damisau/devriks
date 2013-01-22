<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class RikssymRegionalGNIPerCapita extends RikssymIndicator{
    public $name;
    public $description;
    public $entity;
    public $years;
    public $ispublic;
    public $gniValues;
    public $populationValues;
    public $unitSymbol = "";
    public $values;

    public function __construct($name = "Regional GDP per capita",
                                $description = "Regional GDP per capita, based oncurrent prices",
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
            $this->gniValues[$row['PERIOD']] =  $row['value'];
        }

        $population = new RikssymRegionalPopulation("Population",
                                                    "Population",
                                                    $this->years,
                                                    $this->entity,1);
        $this->populationValues = $population->getValues();
        foreach($this->years as $year){
            $this->values[$year] = $this->gniValues[$year] / $this->populationValues[$year];
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
            $this->gniValues[$row['PERIOD']] =  $row['value'];
        }


        $population = new RikssymRegionalPopulation("Population",
                                                    "Population",
                                                    $this->years,
                                                    $this->entity,1);
        $this->populationValues = $population->getValues();
        foreach($this->years as $year){
            $this->values[$year] = $this->gniValues[$year] / $this->populationValues[$year];
        }
    }

    public function __toString(){
        $dump = implode(":",$this->values);
        return $dump;
    }
}
?>