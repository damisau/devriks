<?php

/**
 * RikssymCenter form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymCenterForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'region_id'   => new sfWidgetFormPropelChoice(array('model' => 'RikssymGeoregion', 'add_empty' => true)),
      'url'         => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'RikssymCenter', 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'description' => new sfValidatorString(array('required' => false)),
      'region_id'   => new sfValidatorPropelChoice(array('model' => 'RikssymGeoregion', 'column' => 'id', 'required' => false)),
      'url'         => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_center[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymCenter';
  }


}
