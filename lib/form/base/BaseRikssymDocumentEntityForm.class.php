<?php

/**
 * RikssymDocumentEntity form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymDocumentEntityForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'document_id'    => new sfWidgetFormPropelChoice(array('model' => 'RikssymDocument', 'add_empty' => false)),
      'arrangement_id' => new sfWidgetFormPropelChoice(array('model' => 'RikssymArrangement', 'add_empty' => true)),
      'country_id'     => new sfWidgetFormPropelChoice(array('model' => 'RikssymCountry', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'RikssymDocumentEntity', 'column' => 'id', 'required' => false)),
      'document_id'    => new sfValidatorPropelChoice(array('model' => 'RikssymDocument', 'column' => 'id')),
      'arrangement_id' => new sfValidatorPropelChoice(array('model' => 'RikssymArrangement', 'column' => 'id', 'required' => false)),
      'country_id'     => new sfValidatorPropelChoice(array('model' => 'RikssymCountry', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_document_entity[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymDocumentEntity';
  }


}
