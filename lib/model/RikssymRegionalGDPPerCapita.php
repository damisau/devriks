<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class RikssymRegionalGDPPerCapita extends RikssymIndicator{
    public $gdpValues;
    public $populationValues;
    public $unitSymbol = "";
    public $decimals = 0;

    public function __construct() {

    }

    public function prepareQuery() {
        $countryIds = $this->entity->getCountryIds();
        $gdp = RikssymIndicatorFactory::createIndicator("RikssymRegionalGDP", $this->entity, $this->years, $custom = false);
        $this->gdpValues = $gdp->getValues();

        $population = RikssymIndicatorFactory::createIndicator("RikssymRegionalPopulation", $this->entity, $this->years, $custom = false);
        $this->populationValues = $population->getValues();
        foreach($this->years as $year) {
            $this->values[$year] = $this->gdpValues[$year] / $this->populationValues[$year];
        }
//        $gdpCriteria = new Criteria();
//        $gdpCriteria->clearSelectColumns();
//        $gdpCriteria->addSelectColumn(RikssymDataPeer::PERIOD);
//        $gdpCriteria->addAsColumn("value", "SUM(".RikssymDataPeer::VALUE.")");
//        $gdpCriteria->add(RikssymDataPeer::TYPE_ID, "18", CRITERIA::EQUAL);
//        $gdpCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
//        $gdpCriteria->addJoin(RikssymDataPeer::REPORTER_ID,
//                RikssymArrangementCountryPeer::COUNTRY_ID,
//                CRITERIA::LEFT_JOIN);
//
//        $gdpCriteria->add(RikssymArrangementCountryPeer::ARRANGEMENT_ID,
//                $this->entity->getId(), CRITERIA::EQUAL);
//
//        $gdpCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
//        $gdpCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);
//        $stmt = RikssymDataPeer::doSelectStmt($gdpCriteria);
//        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            $this->gdp[$row['PERIOD']] =  $row['value'];
//        }
//
//        $populationIndicator = RikssymIndicatorFactory::createIndicator("RikssymRegionalPopulation",
//                                                                $this->entity->getId(),
//                                                                $this->years,
//                                                                false);
//        $this->population = $populationIndicator->getValues();
//        foreach($this->years as $year) {
//            $this->values[$year] = $this->gdp[$year] / $this->population[$year];
//        }
    }

    public function prepareCustomQuery() {
        $countryIds = $this->entity->getCountryIds();
        $gdpCriteria = new Criteria();
        $gdpCriteria->clearSelectColumns();
        $gdpCriteria->addSelectColumn(RikssymDataPeer::PERIOD);
        $gdpCriteria->addAsColumn("value", "SUM(".RikssymDataPeer::VALUE.")");
        $gdpCriteria->add(RikssymDataPeer::TYPE_ID, "18", CRITERIA::EQUAL);
        $gdpCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $gdpCriteria->add(RikssymDataPeer::REPORTER_ID, $countryIds, CRITERIA::IN);

        $gdpCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
        $gdpCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);
        $stmt = RikssymDataPeer::doSelectStmt($gdpCriteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->gdpValues[$row['PERIOD']] =  $row['value'];
        }


        $population = new RikssymRegionalPopulation("Population",
                "Population",
                $this->years,
                $this->entity,1);
        $this->populationValues = $population->getValues();
        foreach($this->years as $year) {
            $this->values[$year] = $this->gdpValues[$year] / $this->populationValues[$year];
        }
    }

    public function getValueOfYear($year, $format){
        return number_format($this->values[$year], $this->decimals);
    }

    public function __toString() {
        $dump = implode(":",$this->values);
        return $dump;
    }
}
?>
