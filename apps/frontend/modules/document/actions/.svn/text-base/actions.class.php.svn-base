<?php

/**
 * document actions.
 *
 * @package    riks_sym
 * @subpackage document
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class documentActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_databases')." > Legal Texts";
        $countryDocumentCriteria = new Criteria();
        $countryDocumentCriteria->addSelectColumn(RikssymCountryPeer::ID);
        $countryDocumentCriteria->addJoin(RikssymCountryPeer::ID,
            RikssymDocumentEntityPeer::COUNTRY_ID,
            Criteria::INNER_JOIN);
        $countryDocumentCriteria->addGroupByColumn(RikssymCountryPeer::ID);

        $stmt = RikssymCountryPeer::doSelectStmt($countryDocumentCriteria);
        $this->members = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $member = RikssymCountryPeer::retrieveByPk($row['ID']);
            $this->members[] = $member;
        }

        $this->arrangements = RikssymArrangementPeer::doSelect(new Criteria());

        /*

        $arrangementDocumentCriteria = new Criteria();
        $arrangementDocumentCriteria->addSelectColumn(RikssymArrangementPeer::ID);
        $arrangementDocumentCriteria->addJoin(RikssymArrangementPeer::ID,
                                              RikssymDocumentEntityPeer::ARRANGEMENT_ID,
                                              Criteria::INNER_JOIN);
        $arrangementDocumentCriteria->addGroupByColumn(RikssymArrangementPeer::ID);
        $stmt = RikssymCountryPeer::doSelectStmt($arrangementDocumentCriteria);
        $this->arrangements = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $arrangement = RikssymArrangementPeer::retrieveByPk($row['ID']);
            $this->arrangements[] = $arrangement;
        }*/
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod('post'));
        
        $countryIds = $request->getParameter('countries');
        $arrangementId = $request->getParameter('arrangement');
        $this->arrangement = RikssymArrangementPeer::retrieveByPK($arrangementId);
        
        $countryArrangementCriteria = new Criteria();
        $countryArrangementCriteria->clearSelectColumns();
        $countryArrangementCriteria->addSelectColumn(RikssymArrangementCountryPeer::ARRANGEMENT_ID);
        $countryArrangementCriteria->addSelectColumn(RikssymArrangementCountryPeer::COUNTRY_ID);
        $countryArrangementCriteria->addSelectColumn(RikssymArrangementCountryPeer::ID);
        $countryArrangementCriteria->addSelectColumn(RikssymCountryPeer::ID);
        $countryArrangementCriteria->addSelectColumn(RikssymCountryPeer::NAME);
        $countryArrangementCriteria->add(RikssymArrangementCountryPeer::ARRANGEMENT_ID, $arrangementId);
        $countryArrangementCriteria->addJoin(RikssymArrangementCountryPeer::COUNTRY_ID,
                    RikssymCountryPeer::ID,
                    CRITERIA::LEFT_JOIN);
        $stmt = RikssymArrangementCountryPeer::doSelectStmt($countryArrangementCriteria);

        $this->memberIds = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
           $this->memberIds[] = $row['COUNTRY_ID'];           
        }
                
        $relatedCountryCriteria = new Criteria();
        $relatedCountryCriteria->add(RikssymDocumentEntityPeer::COUNTRY_ID, $countryIds, Criteria::IN);
        $relatedCountryCriteria->addAscendingOrderByColumn(RikssymCountryPeer::NAME);
        $this->countryDocumentPeer = RikssymDocumentEntityPeer::doSelectJoinAll($relatedCountryCriteria);

        $this->countryDocumentArray = array();
        foreach($this->countryDocumentPeer as $peer){
          $this->countryDocumentArray[][$peer->getCountryId()][0] = RikssymCountryPeer::retrieveByPk($peer->getCountryId());
          $this->countryDocumentArray[][$peer->getCountryId()][1] = RikssymDocumentPeer::retrieveByPk($peer->getDocumentId());
        }

        $relatedArrangementCriteria = new Criteria();
        $relatedArrangementCriteria->add(RikssymDocumentEntityPeer::COUNTRY_ID, $this->memberIds, Criteria::IN);
        $this->arrangementDocumentPeer = RikssymDocumentEntityPeer::doSelectJoinAll($relatedArrangementCriteria);
        $this->arrangementDocumentArray = array();
        foreach($this->arrangementDocumentPeer as $peer){
          $this->arrangementDocumentArray[][$peer->getCountryId()][0] = RikssymCountryPeer::retrieveByPk($peer->getCountryId());
          $this->arrangementDocumentArray[][$peer->getCountryId()][1] = RikssymDocumentPeer::retrieveByPk($peer->getDocumentId());
        }        
    }

    public function executeBrowse(sfWebRequest $request){
        $this->rikssym_document_list = RikssymDocumentPeer::doSelect(new Criteria());
        $this->pager = new sfPropelPager('RikssymDocument', 10);
        $this->pager->setCriteria(new Criteria());
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }
}
