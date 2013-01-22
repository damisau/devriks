<?php

/**
 * related actions.
 *
 * @package    riks_sym
 * @subpackage related
 * @author     Birger Fühne
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class relatedActions extends sfActions {
    public function executeIndex(sfWebRequest $request) {
        $this->redirect('static/related');
    }

    public function executeFirst(sfWebRequest $request) {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
                sfConfig::get('app_related')." > FIRST";
    }

    public function executeCow(sfWebRequest $request) {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
                sfConfig::get('app_related')." > CoW";
    }

    public function executeAric(sfWebRequest $request) {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
                sfConfig::get('app_related')." > ARIC";
    }

    public function executeRisc(sfWebRequest $request) {
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
                sfConfig::get('app_related')." > RISC";
    }
}