<?php

/**
 * data actions.
 *
 * @package    riks_sym
 * @subpackage data
 * @author     Birger Fühne
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class staticActions extends sfActions
{
    public function executeHome(sfWebRequest $request){
        $this->setTemplate('home');
    }

    public function executeDatabase(sfWebRequest $request){
        $this->menuColor = "green";
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_databases')."";
    }

    public function executeResearch(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_research')."";
    }
    //TODO: disable before live deployment
    public function executeNews(sfWebRequest $request){
        $this->breadcrumb = "You are here: Home > News";
    }

    public function executeNotes(sfWebRequest $request){

    }

    public function executeContact(sfWebRequest $request){

    }

    public function executeAbout(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_about')."";
    }

    public function executeEducation(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
            sfConfig::get('app_education')." > Education";
    }

    public function executeRelated(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
            sfConfig::get('app_related')."";
    }

    public function executeError(sfWebRequest $request){
        $response = $this->getResponse();
        $response->setStatusCode(404, 'This page does not exist');
    }
}
