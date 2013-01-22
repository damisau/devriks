<?php

/**
 * RikssymJournal form.
 *
 * @package    riks_sym
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class RikssymJournalForm extends BaseRikssymJournalForm
{
  public function configure()
  {
    $this->widgetSchema['name'] = new sfWidgetFormInput($options = array(),
                                    $attributes = array('size' => 150));
    
    $this->widgetSchema['description'] =  new sfWidgetFormTextareaFCKEditor(
      array(
        'width' => 550,
        'height' => 350,
        'tool' => 'Default', // name of a configured toolbar
        'config'=> 'fckconfig.js'  // points to web/js/myfckconfig.js
      ));

     $this->widgetSchema['url'] = new sfWidgetFormInput($options = array(),
                                    $attributes = array('size' => 150));
  }
}
