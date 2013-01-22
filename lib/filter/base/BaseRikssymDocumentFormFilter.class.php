<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * RikssymDocument filter form base class.
 *
 * @package    riks
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseRikssymDocumentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title_short' => new sfWidgetFormFilterInput(),
      'title_long'  => new sfWidgetFormFilterInput(),
      'type'        => new sfWidgetFormFilterInput(),
      'date_signed' => new sfWidgetFormFilterInput(),
      'date_force'  => new sfWidgetFormFilterInput(),
      'filename'    => new sfWidgetFormFilterInput(),
      'language'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title_short' => new sfValidatorPass(array('required' => false)),
      'title_long'  => new sfValidatorPass(array('required' => false)),
      'type'        => new sfValidatorPass(array('required' => false)),
      'date_signed' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_force'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'filename'    => new sfValidatorPass(array('required' => false)),
      'language'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_document_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymDocument';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'title_short' => 'Text',
      'title_long'  => 'Text',
      'type'        => 'Text',
      'date_signed' => 'Number',
      'date_force'  => 'Number',
      'filename'    => 'Text',
      'language'    => 'Text',
    );
  }
}