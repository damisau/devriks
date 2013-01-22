<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RikssymCountry filter form base class.
 *
 * @package    riks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseRikssymCountryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(),
      'show'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'iso_countrycode'  => new sfWidgetFormFilterInput(),
      'iso3_countrycode' => new sfWidgetFormFilterInput(),
      'cow_code'         => new sfWidgetFormFilterInput(),
      'georegion'        => new sfWidgetFormPropelChoice(array('model' => 'RikssymGeoregion', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'show'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'iso_countrycode'  => new sfValidatorPass(array('required' => false)),
      'iso3_countrycode' => new sfValidatorPass(array('required' => false)),
      'cow_code'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'georegion'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RikssymGeoregion', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('rikssym_country_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymCountry';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'show'             => 'Boolean',
      'iso_countrycode'  => 'Text',
      'iso3_countrycode' => 'Text',
      'cow_code'         => 'Number',
      'georegion'        => 'ForeignKey',
    );
  }
}