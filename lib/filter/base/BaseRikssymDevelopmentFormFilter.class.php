<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RikssymDevelopment filter form base class.
 *
 * @package    riks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseRikssymDevelopmentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'          => new sfWidgetFormFilterInput(),
      'text'           => new sfWidgetFormFilterInput(),
      'date_published' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'          => new sfValidatorPass(array('required' => false)),
      'text'           => new sfValidatorPass(array('required' => false)),
      'date_published' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('rikssym_development_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymDevelopment';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'title'          => 'Text',
      'text'           => 'Text',
      'date_published' => 'Date',
    );
  }
}
