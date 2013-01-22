<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RikssymDocumentEntity filter form base class.
 *
 * @package    riks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseRikssymDocumentEntityFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'document_id'    => new sfWidgetFormPropelChoice(array('model' => 'RikssymDocument', 'add_empty' => true)),
      'arrangement_id' => new sfWidgetFormPropelChoice(array('model' => 'RikssymArrangement', 'add_empty' => true)),
      'country_id'     => new sfWidgetFormPropelChoice(array('model' => 'RikssymCountry', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'document_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RikssymDocument', 'column' => 'id')),
      'arrangement_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RikssymArrangement', 'column' => 'id')),
      'country_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'RikssymCountry', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('rikssym_document_entity_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymDocumentEntity';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'document_id'    => 'ForeignKey',
      'arrangement_id' => 'ForeignKey',
      'country_id'     => 'ForeignKey',
    );
  }
}
