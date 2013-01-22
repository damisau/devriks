<?php

/**
 * RikssymSources form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymSourcesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'description' => new sfWidgetFormTextarea(),
      'url'         => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'RikssymSources', 'column' => 'id', 'required' => false)),
      'description' => new sfValidatorString(),
      'url'         => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_sources[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymSources';
  }


}
