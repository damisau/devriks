<?php

/**
 * Description of RikssymRegionalImmigrationShare
 *
 * This class is responsible for calculating the share of intra-regional
 * immigration in total immigration of a specified regional arrangement or
 * group of countries.
 *
 * Total stock of migrants per country is _not_ calculated by adding
 * individual cells, but by extracting the total value given by the provided
 * data sheet.
 *
 * The calculated indicator values are stored in the values array with the
 * corresponding years as keys of the array. Values are rounded to two decimals.
 *
 * @author bfuhne
 * @version 0.1
 * @see RikssymIndicator
 *
 */
class RikssymRegionalImmigrationShare extends RikssymIndicator {

    public $intraregionalImmigrants;
    public $totalImmigrants;
    public $unitSymbol = "%";
    public $decimals = 2;

    public function __construct() {
    }

    /**
     * Execute query and store data in $this->values.
     * The Regional immmigration share is calculated by
     * dividing the number of total immigrants by the number of all inter-regional
     * immigrants, multiplied by 100 for the percentage value.
     */

    public function prepareQuery() {
        $countryIds = $this->entity->getCountryIds();
        $this->calculateTotalMigrants($countryIds);
        $this->calculateIntraregionalMigrants($countryIds);
        $this->calculateShare();
        $this->checkMissingValues($countryIds);
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
                        reporter_id = ".$countryId." AND type_id = 21 ".
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

    public function calculateShare() {
        foreach($this->years as $year) {
            $this->values[$year] = $share = number_format(($this->intraregionalImmigrants[$year]
                            / $this->totalImmigrants[$year]) * 100, 2, ".",",");
        }
    }

    public function calculateTotalMigrants($countryIds) {
        //total Immigrants fetched from db. Value is not calculated but derived
        //from the combination of regional members and the "TOTALS" entity.
        $totalsId = null;
        $criteria = new Criteria();
        $criteria->add(RikssymCountryPeer::NAME, "TOTAL", Criteria::EQUAL);
        $stmt = RikssymCountryPeer::doSelectStmt($criteria);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $totalsId = $row['ID'];
        }
        $totalImmigrants = new Criteria();
        $totalImmigrants->addAsColumn("totalImmigrants", "SUM(".RikssymDataPeer::VALUE.")");
        $totalImmigrants->addAsColumn("year", RikssymDataPeer::PERIOD);
        $totalImmigrants->add(RikssymDataPeer::TYPE_ID,"21",Criteria::EQUAL);
        //$totalImmigrants->add(RikssymDataPeer::REPORTER_ID,$countryIds,Criteria::IN);
        $totalImmigrants->add(RikssymDataPeer::PARTNER_ID,$countryIds,Criteria::IN);
        $totalImmigrants->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
        $totalImmigrants->add(RikssymDataPeer::VALUE,"999999999",Criteria::NOT_EQUAL);
        $totalImmigrants->addGroupByColumn(RikssymDataPeer::PERIOD);
        $totalImmigrants->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);

        $stmt = RikssymDataPeer::doSelectStmt($totalImmigrants);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->totalImmigrants[$row['year']] = $row['totalImmigrants'];
        }
    }

    public function calculateIntraregionalMigrants($countryIds) {
        $irEmigrants = new Criteria();
        $irEmigrants->addAsColumn("intraregionalImmigrants", "SUM(".RikssymDataPeer::VALUE.")");
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
            $this->intraregionalImmigrants[$row['year']] = $row['intraregionalImmigrants'];
        }
    }
}
?>
