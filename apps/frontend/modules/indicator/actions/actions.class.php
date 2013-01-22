<?php

/**
 * indicator actions.
 *
 * @package    riks_sym
 * @subpackage indicator
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class indicatorActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->rikssym_indicator_list = RikssymIndicatorPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->rikssym_indicator = RikssymIndicatorPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->rikssym_indicator);
  }
}
