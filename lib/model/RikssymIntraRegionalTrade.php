<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class RikssymIntraRegionalTrade extends RikssymIndicator {

    public $unitSymbol = "";
    public $values;
    public $roundToDecimals = 0;

    public function __construct() {
    }

    public function prepareQuery() {
        $countryIds = $this->entity->getCountryIds();
        $tradeFlows = array(15,16);

        $conn = Propel::getConnection();

        foreach($this->years as $year){
            $stmt = $conn->prepare("SELECT sum(rdta.value) AS intraRegionalTrade, rdta.period as year ".
                    "FROM rikssym_data rdta ".
                    "WHERE rdta.type_id IN (15,16) ".
                    "AND rdta.reporter_id IN('".implode("','", $countryIds)."') ".
                    "AND rdta.partner_id  IN('".implode("','", $countryIds)."') ".
                    "AND rdta.period  = ".$year.
                    " GROUP BY rdta.period ".
                    "ORDER BY rdta.period ASC ");

            $rs = $stmt->execute();
            
            if($rs){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if($row['intraRegionalTrade'] != null) {
                    $this->values[$year] = $row['intraRegionalTrade'];
                } else {
                    $this->values[$year] = "x";
                }                
            }
        }
//        $tradeFlows = array(15,16);
//        $tradeCriteria = new Criteria();
//        $tradeCriteria->clearSelectColumns();
//        $tradeCriteria->addSelectColumn(RikssymDataPeer::PERIOD);
//        $tradeCriteria->addAsColumn("value", "SUM(".RikssymDataPeer::VALUE.")");
//        $tradeCriteria->add(RikssymDataPeer::TYPE_ID, $tradeFlows, CRITERIA::IN);
//        $tradeCriteria->add(RikssymDataPeer::PERIOD, $this->years, CRITERIA::IN);
//        $tradeCriteria->addAlias("ce_relation", RikssymArrangementCountryPeer::TABLE_NAME);
//        $tradeCriteria->addJoin(RikssymDataPeer::REPORTER_ID,
//            RikssymArrangementCountryPeer::alias("ce_relation", RikssymArrangementCountryPeer::COUNTRY_ID),
//            CRITERIA::INNER_JOIN);
//        $tradeCriteria->addAlias("ce_relation2", RikssymArrangementCountryPeer::TABLE_NAME);
//        $tradeCriteria->addJoin(RikssymDataPeer::PARTNER_ID,
//            RikssymArrangementCountryPeer::alias("ce_relation2", RikssymArrangementCountryPeer::COUNTRY_ID),
//            CRITERIA::INNER_JOIN);
//        $tradeCriteria->add(RikssymArrangementCountryPeer::alias("ce_relation", RikssymArrangementCountryPeer::ARRANGEMENT_ID),
//            $this->entity->getId(), CRITERIA::EQUAL);
//        $tradeCriteria->add(RikssymArrangementCountryPeer::alias("ce_relation2", RikssymArrangementCountryPeer::ARRANGEMENT_ID),
//                            $this->entity->getId(), CRITERIA::EQUAL);
//        $tradeCriteria->addGroupByColumn(RikssymDataPeer::PERIOD);
//        $tradeCriteria->addAscendingOrderByColumn(RikssymDataPeer::PERIOD);
//        $stmt = RikssymDataPeer::doSelectStmt($tradeCriteria);
//        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//            $this->values[$row['PERIOD']] =  $row['value'];
//        }
    }

//    public function prepareCustomQuery() {
//        $countryIds = $this->entity->getCountryIds();
//        $tradeFlows = array(15,16);
//
//        $conn = Propel::getConnection();
//        $stmt = $conn->prepare("SELECT sum(rdta.value) AS intraRegionalTrade, rdta.period as year ".
//                "FROM rikssym_data rdta ".
//                "WHERE rdta.type_id IN (15,16) ".
//                "AND rdta.reporter_id IN('".implode("','", $countryIds)."') ".
//                "AND rdta.partner_id  IN('".implode("','", $countryIds)."') ".
//                "AND rdta.period IN ('".implode("','", $this->years)."') ".
//                "GROUP BY rdta.period ".
//                "ORDER BY rdta.period ASC ");
//
//        $stmt->execute();
//
//        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            $this->values[$row['year']] = $row['intraRegionalTrade'];
//        }
//    }

    public function __toString() {
        $dump = implode(":",$this->values);
        return $dump;
    }
}
?>
