<?php

/**
 * arrangements actions.
 *
 * @package    riks_sym
 * @subpackage arrangements
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class arrangementsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->rikssym_arrangement_country_list = RikssymArrangementCountryPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->rikssym_arrangement_country = RikssymArrangementCountryPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->rikssym_arrangement_country);
  }
}
