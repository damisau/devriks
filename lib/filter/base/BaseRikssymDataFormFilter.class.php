<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RikssymData filter form base class.
 *
 * @package    riks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseRikssymDataFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'reporter_id' => new sfWidgetFormPropelChoice(array('model' => 'RikssymCountry', 'add_empty' => true)),
      'partner_id'  => new sfWidgetFormPropelChoice(array('model' => 'RikssymCountry', 'add_empty' => true)),
      'type_id'     => new sfWidgetFormPropelChoice(array('model' => 'RikssymDatatype', 'add_empty' => true)),
      'value'       => new sfWidgetFormFilterInput(),
      'source_id'   => new sfWidgetFormPropelChoice(array('model' => 'RikssymSources', 'add_empty' => true)),
      'period'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'reporter_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RikssymCountry', 'column' => 'id')),
      'partner_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RikssymCountry', 'column' => 'id')),
      'type_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RikssymDatatype', 'column' => 'id')),
      'value'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'source_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RikssymSources', 'column' => 'id')),
      'period'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('rikssym_data_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymData';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'reporter_id' => 'ForeignKey',
      'partner_id'  => 'ForeignKey',
      'type_id'     => 'ForeignKey',
      'value'       => 'Number',
      'source_id'   => 'ForeignKey',
      'period'      => 'Number',
    );
  }
}
