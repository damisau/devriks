<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RikssymDatatype filter form base class.
 *
 * @package    riks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseRikssymDatatypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'unit' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'unit' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_datatype_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymDatatype';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'unit' => 'Text',
    );
  }
}
