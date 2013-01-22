<?php

/**
 * development actions.
 *
 * @package    riks
 * @subpackage development
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class developmentActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->rikssym_development_list = RikssymDevelopmentPeer::doSelect(new Criteria());
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->rikssym_development = RikssymDevelopmentPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->rikssym_development);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new RikssymDevelopmentForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new RikssymDevelopmentForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($rikssym_development = RikssymDevelopmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object rikssym_development does not exist (%s).', $request->getParameter('id')));
    $this->form = new RikssymDevelopmentForm($rikssym_development);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($rikssym_development = RikssymDevelopmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object rikssym_development does not exist (%s).', $request->getParameter('id')));
    $this->form = new RikssymDevelopmentForm($rikssym_development);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($rikssym_development = RikssymDevelopmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object rikssym_development does not exist (%s).', $request->getParameter('id')));
    $rikssym_development->delete();

    $this->redirect('development/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $rikssym_development = $form->save();

      $this->redirect('development/edit?id='.$rikssym_development->getId());
    }
  }
}
