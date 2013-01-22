<?php

/**
 * education actions.
 *
 * @package    riks
 * @subpackage education
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class educationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {

    }

    public function executeTraining(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_education')." > Training Programmes";
        $this->masterList = RikssymTrainingPeer::doSelect(new Criteria());
        $this->pager = new sfPropelPager('RikssymTraining', 10);
        $this->pager->setCriteria(new Criteria());
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeMaster(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_education')." > Master Programmes";
        $this->masterList = RikssymMasterPeer::doSelect(new Criteria());
        $this->pager = new sfPropelPager('RikssymMaster', 10);
        $this->pager->setCriteria(new Criteria());
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executePhd(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_education')." > PhD Programmes";
        $this->masterList = RikssymPhdPeer::doSelect(new Criteria());
        $this->pager = new sfPropelPager('RikssymPhd', 10);
        $this->pager->setCriteria(new Criteria());
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeVirtual(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_education')." > UNCTAD virtual institute";
    }
}