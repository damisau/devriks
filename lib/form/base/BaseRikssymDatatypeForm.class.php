<?php

/**
 * RikssymDatatype form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymDatatypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'   => new sfWidgetFormInputHidden(),
      'unit' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'   => new sfValidatorPropelChoice(array('model' => 'RikssymDatatype', 'column' => 'id', 'required' => false)),
      'unit' => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_datatype[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymDatatype';
  }


}
