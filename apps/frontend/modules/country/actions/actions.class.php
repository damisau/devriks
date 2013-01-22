<?php

/**
 * country actions.
 *
 * @package    riks_sym
 * @subpackage country
 * @author     Birger Fühne
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class countryActions extends sfActions {
    public function executeIndex(sfWebRequest $request) {
        $this->forward("arrangement", "index");
    }

    public function executeShow(sfWebRequest $request) {
        $countryId = $request->getParameter('id');
        $this->rikssym_country;

        //trying to retrieve a country by the given parameter,
        //if not possible, redirect to arrangement index page.
        if(is_numeric($countryId)) {
            $criteria = new Criteria();
            $this->rikssym_country = RikssymCountryPeer::retrieveByPK($countryId);
        }
        else { //non-numeric id, assuming country name is passed in url
            $criteria = new Criteria();
            $criteria->add(RikssymCountryPeer::NAME, $countryId);
            $this->rikssym_country = RikssymCountryPeer::doSelectOne($criteria);
        }
        if(!($this->rikssym_country)) {
            $this->forward("arrangement", "index");
        }

        $this->flag = sfConfig::get('app_flag');
        $this->baseLinkCia = sfConfig::get('ap_cia_base_link');

        //building join to get all arrangements a country is involved in
        $c = new Criteria();
        $c->clearSelectColumns();
        $c->addSelectColumn(RikssymArrangementCountryPeer::ARRANGEMENT_ID);
        $c->addSelectColumn(RikssymArrangementCountryPeer::COUNTRY_ID);
        $c->addSelectColumn(RikssymArrangementCountryPeer::ID);
        $c->addSelectColumn(RikssymArrangementPeer::ID);
        $c->addSelectColumn(RikssymArrangementPeer::NAME);
        $c->add(RikssymArrangementCountryPeer::COUNTRY_ID, $this->rikssym_country->getId());
        $c->addJoin(RikssymArrangementCountryPeer::ARRANGEMENT_ID,
            RikssymArrangementPeer::ID,
            CRITERIA::LEFT_JOIN);
        $stmt = RikssymArrangementCountryPeer::doSelectStmt($c);

        $this->members = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $member = RikssymArrangementPeer::retrieveByPk($row['ARRANGEMENT_ID']);
            $this->members[] = $member;
        }
        $this->rikssym_country = RikssymCountryPeer::retrieveByPk($this->rikssym_country->getId());
        //adding link to CIA world factbook
        $this->cia_link = $this->baseLinkCia.$this->rikssym_country->getIsoCountrycode();

        //adding links to FIRST database
        $this->firstLink = sfConfig::get('app_first_base_link');
        $this->firstLink .= $this->rikssym_country->getIso3Countrycode();
        $this->first_militarization = $this->firstLink."&".sfConfig::get('app_first_militarization');
        $this->firstIOs = $this->firstLink."&".sfConfig::get('app_first_ios');
        $this->firstPeaceMissions = $this->firstLink."&".sfConfig::get('app_first_peacemissions');

        //Retrieve related documents
        $documents = new Criteria();
        $documents->add(RikssymDocumentEntityPeer::COUNTRY_ID, $this->rikssym_country->getId());
        $this->documents_list = RikssymDocumentEntityPeer::doSelectJoinRikssymDocument($documents);
        $this->documents = array();
        foreach($this->documents_list as $documentPeer) {
            $this->documents[] = $documentPeer->getRikssymDocument();
        }

        //creating google news for infowindow tab on map
        $url = 'http://news.google.com/news?hl=en&ned=us&ie=UTF-8&q="regional+integration"+';
        $url .= urlencode($this->rikssym_country->getName());
        $url .= '&output=rss';

        $this->posts = array();
        $this->postCount = 0;
        $this->feedData = "";
        try {
            $this->feed = sfFeedPeer::createFromWeb($url);
            foreach($this->feed->getItems() as $post) {
                if($this->postCount < 2) {
                    $this->feedData .= $post->getDescription();
                    $this->postCount++;
                }
                else {
                    break;
                }
            }
        }
        catch(Exception  $e){
            $this->logMessage("error fetching feed".$url, "warning");
        }

        //fetch gdp and population data for infowindow tab on map

        //this is.. rather ugly..
        //TODO add easy data retrieval for single countries
        $this->years = range(1990, 2006);
        $this->imagePath = sfConfig::get("app_graphUrl");
        $this->indicators = RikssymIndicatorPeer::retrieveByPKs(array(0 => 1, 1 => 3));
        $this->indicatorCount = sizeof($this->indicators);
        $this->countries = RikssymCountryPeer::retrieveByPKs($this->rikssym_country->getId());
        $this->customRegion = new RikssymCustomRegion($this->countries);
        $this->customRegionArray = array();
        $this->customRegionArray[] = $this->customRegion;
        $this->gdpIndicator = RikssymIndicatorFactory::createIndicator("RikssymRegionalGDP", $this->customRegion, $this->years, true);
        $this->populationIndicator = RikssymIndicatorFactory::createIndicator("RikssymRegionalPopulation", $this->customRegion,
                $this->years, true);
        
        $this->popTable = $this->createPopTable($this->populationIndicator);
        $this->gdpTable = $this->createGDPTable($this->gdpIndicator);
    }



    public function createGDPTable($gdpIndicator) {
        $gdpTable = "";
        $gdpTable .= '<table class="tableIndicator" width ="400" border="0" cellpadding="0" cellspacing="0">';
        $gdpTable.= '<thead>';
        $gdpTable .= ' <tr>';
        $gdpTable .= '     <th class="thHeadIndicator" colspan="2">GDP of '.$this->rikssym_country->getName().', current US $ (billions)</th>';
        $gdpTable .= '   </tr>';
        $gdpTable .= '  </thead>';
        $rowSelector = 1;
        foreach($this->years as $year) {
            $style;
            if($rowSelector % 2 ==0) {
                $style = '"trIndicatorPair"';
            }
            else {
                $style ='"trIndicatorImpair"';
            }
            $gdpTable .= '<tr class="'.$style.'">';
            $gdpTable .= '<td>'.$year.'</td>';
            $value = number_format($gdpIndicator->getValueOfYear($year, false) / 1000000000, 3);
            $gdpTable .= '<td>'.$value.'</td></tr>';
            $rowSelector++;
        }
        $gdpTable .= "<tr><td>".$gdpIndicator->getDescription()."</td></tr>";
        $gdpTable .="</table>";

        return $gdpTable;
    }

    public function createPopTable($populationIndicator) {
        $popTable = "";
        $popTable .= '<table class="tableIndicator" width ="400" border="0" cellpadding="0" cellspacing="0">';
        $popTable .= '<thead>';
        $popTable .= ' <tr>';
        $popTable .= '     <th class="thHeadIndicator" colspan="2">Population of '.$this->rikssym_country->getName().', millions</th>';
        $popTable .= '   </tr>';
        $popTable .= '  </thead>';
        $rowSelector = 1;
        foreach($this->years as $year) {
            $style;
            if($rowSelector % 2 ==0) {
                $style = '"trIndicatorPair"';
            }
            else {
                $style ='"trIndicatorImpair"';
            }
            $popTable .= '<tr class="'.$style.'">';
            $popTable .= '<td>'.$year.'</td>';
            $value = number_format($populationIndicator->getValueOfYear($year, false )/1000000, 3);
            $popTable .= '<td>'.$value.'</td></tr>';
            $rowSelector++;
        }
        $popTable .="<tr><td>".$populationIndicator->getDescription()."</td></tr>";
        $popTable .="</table>";
        return $popTable;
    }
}
