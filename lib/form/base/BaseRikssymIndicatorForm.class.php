<?php

/**
 * RikssymIndicator form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymIndicatorForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'ispublic'    => new sfWidgetFormInputCheckbox(),
      'classname'   => new sfWidgetFormInput(),
      'unit_title'  => new sfWidgetFormInput(),
      'method'      => new sfWidgetFormInput(),
      'category'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'RikssymIndicator', 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'description' => new sfValidatorString(),
      'ispublic'    => new sfValidatorBoolean(array('required' => false)),
      'classname'   => new sfValidatorString(array('max_length' => 255)),
      'unit_title'  => new sfValidatorString(array('max_length' => 255)),
      'method'      => new sfValidatorString(array('max_length' => 255)),
      'category'    => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_indicator[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymIndicator';
  }


}
