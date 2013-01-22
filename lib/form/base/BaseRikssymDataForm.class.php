<?php

/**
 * RikssymData form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymDataForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'reporter_id' => new sfWidgetFormPropelChoice(array('model' => 'RikssymCountry', 'add_empty' => false)),
      'partner_id'  => new sfWidgetFormPropelChoice(array('model' => 'RikssymCountry', 'add_empty' => true)),
      'type_id'     => new sfWidgetFormPropelChoice(array('model' => 'RikssymDatatype', 'add_empty' => false)),
      'value'       => new sfWidgetFormInput(),
      'source_id'   => new sfWidgetFormPropelChoice(array('model' => 'RikssymSources', 'add_empty' => false)),
      'period'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'RikssymData', 'column' => 'id', 'required' => false)),
      'reporter_id' => new sfValidatorPropelChoice(array('model' => 'RikssymCountry', 'column' => 'id')),
      'partner_id'  => new sfValidatorPropelChoice(array('model' => 'RikssymCountry', 'column' => 'id', 'required' => false)),
      'type_id'     => new sfValidatorPropelChoice(array('model' => 'RikssymDatatype', 'column' => 'id')),
      'value'       => new sfValidatorInteger(array('required' => false)),
      'source_id'   => new sfValidatorPropelChoice(array('model' => 'RikssymSources', 'column' => 'id')),
      'period'      => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('rikssym_data[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymData';
  }


}
