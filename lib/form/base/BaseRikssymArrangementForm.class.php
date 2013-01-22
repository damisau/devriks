<?php

/**
 * RikssymArrangement form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymArrangementForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInput(),
      'description'  => new sfWidgetFormTextarea(),
      'abbrev'       => new sfWidgetFormInput(),
      'georegion_id' => new sfWidgetFormPropelChoice(array('model' => 'RikssymGeoregion', 'add_empty' => true)),
      'show'         => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'RikssymArrangement', 'column' => 'id', 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255)),
      'description'  => new sfValidatorString(array('required' => false)),
      'abbrev'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'georegion_id' => new sfValidatorPropelChoice(array('model' => 'RikssymGeoregion', 'column' => 'id', 'required' => false)),
      'show'         => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_arrangement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymArrangement';
  }


}
