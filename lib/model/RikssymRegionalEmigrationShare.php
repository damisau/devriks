<?php
/**
 * Description of RikssymRegionalEmigrationShare
 *
 * This class is responsible for calculating the share of intra-regional
 * emigration in total emigration of a specified regional arrangement or
 * group of countries. It is constructed with the necessary details to
 * calculate the indicator (the arrangement or group of countries and the
 * number of years). The constructor then calls prepareQuery which then fetches
 * the data and calculates the values for each year. *
 * The calculated indicator values are stored in the values array with the
 * corresponding years as keys of the array. Values are rounded to two decimals.
 *
 * @author bfuhne
 * @version 0.1
 * @see RikssymIndicator
 *
 */
class RikssymRegionalEmigrationShare extends RikssymIndicator {

    public $intraregionalMigrants;
    public $totalEmigrants;
    public $unitSymbol = "%";
    public $decimals = 2;

    public function __construct() {

    }

    public function prepareQuery() {
        $countryIds = $this->entity->getCountryIds();
          //totalsId is the id of the entity TOTALS in the database, storing
        //total values for individual countries for immigration.
        $totalsId = null;
        $criteria = new Criteria();
        $criteria->add(RikssymCountryPeer::NAME, "TOTAL", Criteria::EQUAL);
        $stmt = RikssymCountryPeer::doSelectStmt($criteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $totalsId = $row['ID'];
        }
        //calculating internal migration
        $irEmigrants = new Criteria();
        $irEmigrants->addAsColumn("intraregionalEmigrants", "SUM(".RikssymDataPeer::VALUE.")");
        $irEmigrants->addAsColumn("year", RikssymDataPeer::PERIOD);
        $irEmigrants->add(RikssymDataPeer::TYPE_ID,"21",Criteria::EQUAL);
        $irEmigrants->add(RikssymDataPeer::REPORTER_ID,$countryIds,Criteria::IN);
        $irEmigrants->add(RikssymDataPeer::PARTNER_ID,$countryIds,Criteria::IN);
        $irEmigrants->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $irEmigrants->add(RikssymDataPeer::VALUE,"999999999",Criteria::NOT_EQUAL);
        $irEmigrants->addGroupByColumn(RikssymDataPeer::PERIOD);
        $irEmigrants->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);

        $stmt = RikssymDataPeer::doSelectStmt($irEmigrants);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->intraregionalMigrants[$row['year']] = $row['intraregionalEmigrants'];
        }

        //now, fetch all emigrants from the region
        $totalEmigrantsFromRegion = new Criteria();
        $totalEmigrantsFromRegion->addAsColumn("totalEmigrants","SUM(".RikssymDataPeer::VALUE.")");
        $totalEmigrantsFromRegion->addAsColumn("year", RikssymDataPeer::PERIOD);
        $totalEmigrantsFromRegion->add(RikssymDataPeer::TYPE_ID,"21",Criteria::EQUAL);
        $totalEmigrantsFromRegion->add(RikssymDataPeer::REPORTER_ID,$countryIds,Criteria::IN);
        //$totalEmigrantsFromRegion->add(RikssymDataPeer::PARTNER_ID,$countryIds,Criteria::IN);
        $totalEmigrantsFromRegion->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $totalEmigrantsFromRegion->add(RikssymDataPeer::VALUE,"999999999",Criteria::NOT_EQUAL);
        $totalEmigrantsFromRegion->addGroupByColumn(RikssymDataPeer::PERIOD);
        $totalEmigrantsFromRegion->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);

        $stmt = RikssymDataPeer::doSelectStmt($totalEmigrantsFromRegion);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->totalEmigrants[$row['year']] = $row['totalEmigrants'];
        }

        //calculate the % of intraregional immigrants in total immigrants
        foreach($this->years as $year) {
            $this->values[$year] = $share = number_format(($this->intraregionalMigrants[$year]
                            / $this->totalEmigrants[$year]) * 100, 2, ".",",");
        }
    }
}
?>
