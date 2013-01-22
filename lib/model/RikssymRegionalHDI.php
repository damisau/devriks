<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
class RikssymRegionalHDI extends RikssymIndicator {
    public $population;
    public $hdi;
    public $unitSymbol = "";
    public $decimals = 4;

    public function __construct() {

    }

    public function prepareQuery() {
        //first, fetch the population of each country of the arrangement for
        //the requested years. Population is need to weight the HDI in regard
        //to population.

        $countryIds = $this->entity->getCountryIds();
        $conn = Propel::getConnection();

        foreach($countryIds as $countryId) {
            foreach($this->years as $year) {
                $popQuery = "SELECT reporter_id, period, value as pop
                                            FROM rikssym_data
                                            WHERE period = $year
                                            AND reporter_id = $countryId
                                            AND type_id = 19
                                            AND value != -999
                                            order by period ASC
                                            ";

                $stmt = $conn->prepare($popQuery);
                $stmt->execute();
                if(count($rows = $stmt->fetchAll(PDO::FETCH_ASSOC))){
                    foreach($rows as $row){
                        $pop = $row["pop"];
                        $this->population[$countryId][$row["period"]] = $pop;
                    }
                } else {
                    $this->population[$countryId][$row["period"]] = 0;
                    $country = RikssymCountryPeer::retrieveByPK($countryId);
                    $this->frontendMessage[] = "No population data available for ".
                                                $country->getName()." in ".$year.".
                                                Treated as 0 in the calculation.";
                }
            }
        }
        //we have population, now fetch the HDI data for the arrangements'
        //member states
         foreach($countryIds as $countryId) {
            foreach($this->years as $year) {
                $query = "SELECT reporter_id, period, value as hdi
                                                FROM rikssym_data
                                                WHERE period = $year
                                                AND reporter_id = $countryId
                                                AND type_id = 9
                                                AND value != -999
                                                order by period ASC";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                if(count($rows = $stmt->fetchAll(PDO::FETCH_ASSOC))){
                    foreach($rows as $row){
                        $hdi = $row["hdi"];
                        $this->hdi[$countryId][$row["period"]] = $hdi;
                    }
                } else {
                    $this->hdi[$countryId][$row["period"]] = 0;
                }
            }
         }

        //fetched population and hdi data, now calculating the weighted HDI
        //(on population) for the selected arrangement and years
        $nominator = null;
        $denominator = null;

        foreach($this->years as $year) {
            foreach($countryIds as $countryId){
                if($this->hdi[$countryId][$year] != -999
                    && is_numeric($this->hdi[$countryId][$year])) {
                    $valid = true;
                    $nominator += $this->population[$countryId][$year] *
                                $this->hdi[$countryId][$year];
                    $denominator += $this->population[$countryId][$year];
                }
                else {
                    $valid = false;
                    $country = RikssymCountryPeer::retrieveByPK($countryId);
                    $this->frontendMessage[] = "No hdi data available for ".
                                                $country->getName()." in ".$year.".
                                                Treated as 0 in the calculation.";

                }
                if($valid == true) {
                    $this->values[$year] = number_format((($nominator / $denominator) / 100000), $this->decimals);
                }
                else {
                    $this->values[$year] = sfConfig::get("app_missingDataCode");
                }
            }
        }
    }
}
?>
