<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RikssymSources filter form base class.
 *
 * @package    riks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseRikssymSourcesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'description' => new sfWidgetFormFilterInput(),
      'url'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'description' => new sfValidatorPass(array('required' => false)),
      'url'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_sources_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymSources';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'description' => 'Text',
      'url'         => 'Text',
    );
  }
}
