<?php

/**
 * center actions.
 *
 * @package    riks_sym
 * @subpackage center
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class centerActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
     $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_research')." > Research Centres";
     $c = new Criteria();   
     $this->rikssym_center_list = RikssymCenterPeer::doSelectJoinRikssymGeoregion($c);
     $georegionCriteria = new Criteria();
     $georegionCriteria->addAscendingOrderByColumn(RikssymGeoregionPeer::NAME);
     
     $this->rikssym_georegion_list = RikssymGeoregionPeer::doSelect($georegionCriteria);
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_research')." > Research Centres";
    $this->rikssym_center = RikssymCenterPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->rikssym_center);
  }
}
