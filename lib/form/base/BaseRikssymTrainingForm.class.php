<?php

/**
 * RikssymTraining form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymTrainingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'country_id'    => new sfWidgetFormPropelChoice(array('model' => 'RikssymCountry', 'add_empty' => true)),
      'institute'     => new sfWidgetFormInput(),
      'program_title' => new sfWidgetFormInput(),
      'url'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'RikssymTraining', 'column' => 'id', 'required' => false)),
      'country_id'    => new sfValidatorPropelChoice(array('model' => 'RikssymCountry', 'column' => 'id', 'required' => false)),
      'institute'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'program_title' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_training[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymTraining';
  }


}
