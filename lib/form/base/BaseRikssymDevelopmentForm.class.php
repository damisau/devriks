<?php

/**
 * RikssymDevelopment form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymDevelopmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'title'          => new sfWidgetFormInput(),
      'text'           => new sfWidgetFormTextarea(),
      'date_published' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'RikssymDevelopment', 'column' => 'id', 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255)),
      'text'           => new sfValidatorString(),
      'date_published' => new sfValidatorDate(),
    ));

    $this->widgetSchema->setNameFormat('rikssym_development[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymDevelopment';
  }


}
