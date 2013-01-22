<?php

/**
 * RikssymCountry form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymCountryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInput(),
      'show'             => new sfWidgetFormInputCheckbox(),
      'iso_countrycode'  => new sfWidgetFormInput(),
      'iso3_countrycode' => new sfWidgetFormInput(),
      'cow_code'         => new sfWidgetFormInput(),
      'georegion'        => new sfWidgetFormPropelChoice(array('model' => 'RikssymGeoregion', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'RikssymCountry', 'column' => 'id', 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 255)),
      'show'             => new sfValidatorBoolean(array('required' => false)),
      'iso_countrycode'  => new sfValidatorString(array('max_length' => 2, 'required' => false)),
      'iso3_countrycode' => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'cow_code'         => new sfValidatorInteger(array('required' => false)),
      'georegion'        => new sfValidatorPropelChoice(array('model' => 'RikssymGeoregion', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymCountry';
  }


}
