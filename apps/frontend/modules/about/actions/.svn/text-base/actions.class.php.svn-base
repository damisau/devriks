<?php

/**
 * about actions.
 *
 * @package    riks
 * @subpackage about
 * @author     Birger Fühne
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class aboutActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

    public function executeIndex(sfWebRequest $request)
    {
        $this->menuColor = "red";
    }

    public function executeContact(sfWebRequest $request)
    {
        $this->menuColor = "red";
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_about')." > Contact Us";
    }

    public function executeNotes(sfWebRequest $request)
    {
        $this->menuColor = "red";
        $this->breadcrumb = "You are here: ";
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_about')." > Technical Notes";
    }

    public function executeContents(sfWebRequest $request)
    {
        $this->menuColor = "red";
        $this->breadcrumb = "You are here: ";
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_about')." > Contents";
    }

    public function executePartners(sfWebRequest $request)
    {
        $this->menuColor = "red";
        $this->breadcrumb = "You are here: ";
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_about')." > Partners";

    }

    public function executeDevelopments(sfWebRequest $request)
    {
        $this->menuColor = "red";
        $this->breadcrumb = "You are here: ";
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_about')." > Latest Developments";

        $developmentsCriteria = new Criteria();
        $developmentsCriteria->addDescendingOrderByColumn(RikssymDevelopmentPeer::DATE_PUBLISHED);
        $this->developmentsList = RikssymDevelopmentPeer::doSelect($developmentsCriteria);
    }

    public function executeFunding(sfWebRequest $request){
         $this->menuColor = "red";
        $this->breadcrumb = "You are here: ";
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_about')." > Funding";
    }
}
