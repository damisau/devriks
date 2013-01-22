<?php

/**
 * RikssymArrangementCountry form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymArrangementCountryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'arrangement_id' => new sfWidgetFormPropelChoice(array('model' => 'RikssymArrangement', 'add_empty' => false)),
      'country_id'     => new sfWidgetFormPropelChoice(array('model' => 'RikssymCountry', 'add_empty' => false)),
      'id'             => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'arrangement_id' => new sfValidatorPropelChoice(array('model' => 'RikssymArrangement', 'column' => 'id')),
      'country_id'     => new sfValidatorPropelChoice(array('model' => 'RikssymCountry', 'column' => 'id')),
      'id'             => new sfValidatorPropelChoice(array('model' => 'RikssymArrangementCountry', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_arrangement_country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymArrangementCountry';
  }


}
