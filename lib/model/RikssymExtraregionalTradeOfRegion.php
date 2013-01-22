<?php
/*
 * This class is a helper class for the calculation of other indicators.
 * The total of extraregional trade is _not_ available to the frontend user.
 * Extraregional trade is calculated as the trade (import and exports) of one
 * region with partners that are not part of the region.
*/
class RikssymExtraregionalTradeOfRegion extends RikssymIndicator {

    public $unitSymbol = "";


    public function __construct() {
    }

    public function prepareQuery() {
        $countryIds = $this->entity->getCountryIds();
        $conn = Propel::getConnection();
        $stmt = $conn->prepare("SELECT sum(rdta.value) AS trade, rdta.period as year ".
                "FROM rikssym_data rdta ".
                "WHERE rdta.type_id IN (15,16) ".
                "AND rdta.reporter_id IN('".implode("','", $countryIds)."') ".
                "AND rdta.partner_id NOT IN('".implode("','", $countryIds)."') ".
		"AND rdta.partner_id != 321 ".
                "AND rdta.period IN ('".implode("','", $this->years)."') ".
                "GROUP BY rdta.period ".
                "ORDER BY rdta.period ASC ");

        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->values[$row['year']] = $row['trade'];
        }
//        $tradeFlows = array(15,16);
//        $countryIds = array();
//
//        $countryIds = $this->entity->getCountryIds();
//
//
//        $c = new Criteria();
//        $c->clearSelectColumns();
//        $c->addSelectColumn(RikssymArrangementCountryPeer::ARRANGEMENT_ID);
//        $c->addSelectColumn(RikssymArrangementCountryPeer::COUNTRY_ID);
//        $c->addSelectColumn(RikssymArrangementCountryPeer::ID);
//        $c->addSelectColumn(RikssymCountryPeer::ID);
//        $c->addSelectColumn(RikssymCountryPeer::NAME);
//        $c->add(RikssymArrangementCountryPeer::ARRANGEMENT_ID, $this->entity->getId());
//        $c->addJoin(RikssymArrangementCountryPeer::COUNTRY_ID,
//                RikssymCountryPeer::ID,
//                CRITERIA::LEFT_JOIN);
//
//        $stmt = RikssymArrangementCountryPeer::doSelectStmt($c);
//
//        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            $countryIds[] = $row['COUNTRY_ID'];
//        }
//
//        $conn = Propel::getConnection();
//        $stmt = $conn->prepare("SELECT sum(rdta.value) AS trade, rdta.period as year ".
//                "FROM rikssym_data rdta ".
//                "WHERE rdta.type_id IN (15,16) ".
//                "AND rdta.reporter_id IN('".implode("','", $countryIds)."') ".
//                "AND rdta.partner_id NOT IN('".implode("','", $countryIds)."') ".
//                "AND rdta.period IN ('".implode("','", $this->years)."') ".
//                "GROUP BY rdta.period ".
//                "ORDER BY rdta.period ASC ");
//
//        $stmt->execute();
//        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            $this->values[$row['year']] = $row['trade'];
//        }
    }

    public function prepareCustomQuery() {
        $countryIds = $this->entity->getCountryIds();
        $conn = Propel::getConnection();
        $stmt = $conn->prepare("SELECT sum(rdta.value) AS trade, rdta.period as year ".
                "FROM rikssym_data rdta ".
                "WHERE rdta.type_id IN (15,16) ".
                "AND rdta.reporter_id IN('".implode("','", $countryIds)."') ".
                "AND rdta.partner_id NOT IN('".implode("','", $countryIds)."') ".
		"AND rdta.partner_id != 321 ".
                "AND rdta.period IN ('".implode("','", $this->years)."') ".
                "GROUP BY rdta.period ".
                "ORDER BY rdta.period ASC ");

        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->values[$row['year']] = $row['trade'];
        }
    }

    public function __toString() {
        $dump = implode(":",$this->values);
        return $dump;
    }
}
?>
