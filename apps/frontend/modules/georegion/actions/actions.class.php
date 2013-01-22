<?php

/**
 * georegion actions.
 *
 * @package    riks_sym
 * @subpackage georegion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class georegionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->rikssym_georegion_list = RikssymGeoregionPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->rikssym_georegion = RikssymGeoregionPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->rikssym_georegion);
  }
}
