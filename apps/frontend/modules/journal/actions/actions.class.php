<?php

/**
 * journal actions.
 *
 * @package    riks_sym
 * @subpackage journal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class journalActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_research')." > Journals";
        $criteria = new Criteria();
        $criteria->addAscendingOrderByColumn(RikssymJournalPeer::NAME);
        $this->rikssym_journal_list = RikssymJournalPeer::doSelect($criteria);

    }

    public function executeShow(sfWebRequest $request)
    {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_research')." > Journals";
        $this->rikssym_journal = RikssymJournalPeer::retrieveByPk($request->getParameter('id'));
        $this->forward404Unless($this->rikssym_journal);
    }
}
