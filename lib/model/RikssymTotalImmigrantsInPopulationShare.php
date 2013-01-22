<?php
/**
 * Description of RikssymRegionalMigrantsPopulationShare
 *
 * This class is responsible for calculating the share of migrants
 * in the population of a specified regional arrangement or
 * group of countries. It is constructed with the necessary details to
 * calculate the indicator (the arrangement or group of countrie and the
 * number of years). The constructor then calls prepareQuery which then fetches
 * the data and calculates the values for each year.
 * The calculated indicator values are stored in the values array with the
 * corresponding years as keys of the array. Values are rounded to two decimals.
 *
 * @author bfuhne
 * @version 0.1
 * @see RikssymIndicator
 *
 */

class RikssymTotalImmigrantsInPopulationShare extends RikssymIndicator {
    public $totalMigrants;
    public $regionalPopulation;
    public $unitSymbol = "%";
    public $decimals = 2;
    

    public function __construct() {

    }

    public function prepareQuery() {
        $countryIds = $this->entity->getCountryIds();
        $this->calculateTotalImmigrants($countryIds);
        $this->calculateTotalPopulation($countryIds);
        $this->calculateIndicator();
        $this->checkMissingValues($countryIds);
    }

    public function calculateIndicator(){
        //migrant and population data fetched, now calculate the share
        //of migrants in population of the region
        foreach ($this->years as $year) {
            $this->values[$year] = ($this->totalMigrants[$year] /
                            $this->regionalPopulation[$year]) * 100;
        }
    }

    public function calculateTotalPopulation($countryIds) {
        $popCriteria = new Criteria();
        $popCriteria->addAsColumn("population", "SUM(".RikssymDataPeer::VALUE.")");
        $popCriteria->addAsColumn("year", RikssymDataPeer::PERIOD);
        $popCriteria->add(RikssymDataPeer::TYPE_ID,"19",Criteria::EQUAL);
        $popCriteria->add(RikssymDataPeer::REPORTER_ID,$countryIds,Criteria::IN);
        $popCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
        $popCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);

        $stmt = RikssymDataPeer::doSelectStmt($popCriteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->regionalPopulation[$row['year']] =  $row['population'];
        }
    }

    public function calculateTotalImmigrants($countryIds) {
        //totalsId is the id of the entity TOTALS in the database, storing
        //total values for individual countries for immigration.
        $totalsId = null;
        $criteria = new Criteria();
        $criteria->add(RikssymCountryPeer::NAME, "TOTAL", Criteria::EQUAL);
        $stmt = RikssymCountryPeer::doSelectStmt($criteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $totalsId = $row['ID'];
        }
        //fetching total immigrants of region
        $iremigrantsCriteria = new Criteria();
        $iremigrantsCriteria->clearSelectColumns();
        $iremigrantsCriteria->addAsColumn("totalImmigrants", "SUM(".RikssymDataPeer::VALUE.")");
        $iremigrantsCriteria->addAsColumn("year", RikssymDataPeer::PERIOD);
        $iremigrantsCriteria->add(RikssymDataPeer::TYPE_ID,"12",Criteria::EQUAL);
        $iremigrantsCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $iremigrantsCriteria->add(RikssymDataPeer::REPORTER_ID, $countryIds, CRITERIA::IN);
        //$iremigrantsCriteria->add(RikssymDataPeer::PARTNER_ID, $totalsId, CRITERIA::IN);
        $iremigrantsCriteria->add(RikssymDataPeer::VALUE,"999999999",Criteria::NOT_EQUAL);
        $iremigrantsCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
        $iremigrantsCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);

        $stmt = RikssymDataPeer::doSelectStmt($iremigrantsCriteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->totalMigrants[$row['year']] = $row['totalImmigrants'];
        }
    }

    public function getValueOfYear($year, $format) {
        if($format == true) {
            $value = number_format($this->values[$year], $this->decimals).
                    $this->unitSymbol;
            return $value;
        }
        else {
            $value = number_format($this->values[$year], $this->decimals);
            return $value;
        }
    }

    public function checkMissingValues($countryIds) {
        $noMissing = true;
        $totalsId = null;
        $criteria = new Criteria();
        $criteria->add(RikssymCountryPeer::NAME, "TOTAL", Criteria::EQUAL);
        $stmt = RikssymCountryPeer::doSelectStmt($criteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $totalsId = $row['ID'];
        }
        
        $conn = Propel::getConnection();
        foreach($this->years as $year) {
            foreach($countryIds as $countryId) {
                $sql = "SELECT value FROM rikssym_data WHERE
                        reporter_id = ".$countryId." AND type_id = 12 ".
                        " AND partner_id = ".$totalsId.
                        " AND period = ".$year;
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch();
                if($result == false) {
                    $country = RikssymCountryPeer::retrieveByPK($countryId);
                    $this->frontendMessage[] = $this->missingStatement.$country->getName().
                            ", ".$year;
                    $noMissing = false;
                }
            }
        }
        if($noMissing == true) {
            $this->frontendMessage[] = "No missing data reported.";
        }
    }

}