<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RikssymPhd filter form base class.
 *
 * @package    riks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseRikssymPhdFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'country_id'    => new sfWidgetFormPropelChoice(array('model' => 'RikssymCountry', 'add_empty' => true)),
      'institute'     => new sfWidgetFormFilterInput(),
      'program_title' => new sfWidgetFormFilterInput(),
      'url'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'country_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RikssymCountry', 'column' => 'id')),
      'institute'     => new sfValidatorPass(array('required' => false)),
      'program_title' => new sfValidatorPass(array('required' => false)),
      'url'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_phd_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymPhd';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'country_id'    => 'ForeignKey',
      'institute'     => 'Text',
      'program_title' => 'Text',
      'url'           => 'Text',
    );
  }
}
