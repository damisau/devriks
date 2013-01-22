<?php

/**
 * arrangement actions.
 *
 * @package    riks_sym
 * @subpackage arrangement
 * @author     Birger Fühne
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class arrangementActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_databases')." > Regional Arrangements";
        $countryOrderCriteria = new Criteria();
        $countryOrderCriteria->addAscendingOrderByColumn(RikssymCountryPeer::NAME);
        $countryOrderCriteria->add(RikssymCountryPeer::SHOW, 'true');

        $arrangementOrderCriteria = new Criteria();
        $arrangementOrderCriteria->addAscendingOrderByColumn(RikssymArrangementPeer::NAME);
        $arrangementOrderCriteria->add(RikssymArrangementPeer::SHOW, 'true');
        
        $this->rikssym_arrangement_list = RikssymArrangementPeer::doSelect($arrangementOrderCriteria);
        $this->rikssym_country_list = RikssymCountryPeer::doSelect($countryOrderCriteria);
    }

    public function executeShow(sfWebRequest $request)
    {
      /**
       * The arrangements and countries are in a many2many relation via
       * an intersection table, which is not supported by the standard propel functions.
       * Instead a custom criterion is used to perform the join over three tables.
       */
        if(!(is_numeric($request->getParameter('id')))){
            $this->forward("arrangement", "index");
        }
        $this->flagDir = sfConfig::get('app_flag');
        $c = new Criteria();
        $c->clearSelectColumns();
        $c->addSelectColumn(RikssymArrangementCountryPeer::ARRANGEMENT_ID);
        $c->addSelectColumn(RikssymArrangementCountryPeer::COUNTRY_ID);
        $c->addSelectColumn(RikssymArrangementCountryPeer::ID);
        $c->addSelectColumn(RikssymCountryPeer::ID);
        $c->addSelectColumn(RikssymCountryPeer::NAME);
        $c->add(RikssymArrangementCountryPeer::ARRANGEMENT_ID, $request->getParameter('id'));
        $c->addJoin(RikssymArrangementCountryPeer::COUNTRY_ID,
            RikssymCountryPeer::ID,
            CRITERIA::LEFT_JOIN);

        $this->rikssym_arrangement = RikssymArrangementPeer::retrieveByPk($request->getParameter('id'));
        $stmt = RikssymArrangementCountryPeer::doSelectStmt($c);

        $this->members = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $member = RikssymCountryPeer::retrieveByPk($row['COUNTRY_ID']);
            $this->members[] = $member;
        }

        $polyOfCountry = $this->dirList("/var/www/riks/web/images/poly/");

        $this->drawableMembers = array();
        foreach($this->members as $member){
            $polyfile = $member->getName().".ply";
            if(in_array($polyfile, $polyOfCountry)){
                $this->drawableMembers[] = $member->getName().".ply";
            }
        }
        $this->mapString .= 'var entities = new Array("';
        $this->mapString .= implode($this->drawableMembers, "\",\"");
        $this->mapString .='");';
        $this->forward404Unless($this->rikssym_arrangement);
    }

    public function dirList ($directory){
        // create an array to hold directory list
        $results = array();

        // create a handler for the directory
        $handler = opendir($directory);

        // keep going until all files in directory have been read
        while ($file = readdir($handler)) {
            // if $file isn't this directory or its parent,
            // add it to the results array
            if ($file != '.' && $file != '..'){
                $results[] = $file;
            }
        }
        // tidy up: close the handler
        closedir($handler);

        // done!
        return $results;
    }
}
