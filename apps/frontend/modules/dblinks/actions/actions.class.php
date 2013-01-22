<?php

/**
 * dblinks actions.
 *
 * @package    riks_sym
 * @subpackage dblinks
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class dblinksActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_databases')." > Database Links";
        $this->rikssym_dblinks_list = RikssymDblinksPeer::doSelect(new Criteria());
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_databases')." > Database Links";
        $this->rikssym_dblinks = RikssymDblinksPeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->rikssym_dblinks);
    }

    public function executeAsil(sfWebRequest $request)
    {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_databases')." > ASIL Reports";
    }
}
