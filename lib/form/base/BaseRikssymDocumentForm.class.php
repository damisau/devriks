<?php

/**
 * RikssymDocument form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymDocumentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title_short' => new sfWidgetFormTextarea(),
      'title_long'  => new sfWidgetFormTextarea(),
      'type'        => new sfWidgetFormInput(),
      'date_signed' => new sfWidgetFormInput(),
      'date_force'  => new sfWidgetFormInput(),
      'filename'    => new sfWidgetFormInput(),
      'language'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'RikssymDocument', 'column' => 'id', 'required' => false)),
      'title_short' => new sfValidatorString(),
      'title_long'  => new sfValidatorString(array('required' => false)),
      'type'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'date_signed' => new sfValidatorInteger(array('required' => false)),
      'date_force'  => new sfValidatorInteger(array('required' => false)),
      'filename'    => new sfValidatorString(array('max_length' => 255)),
      'language'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_document[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymDocument';
  }


}
