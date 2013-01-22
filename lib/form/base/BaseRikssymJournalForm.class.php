<?php

/**
 * RikssymJournal form base class.
 *
 * @package    riks
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRikssymJournalForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'region_id'   => new sfWidgetFormPropelChoice(array('model' => 'RikssymGeoregion', 'add_empty' => true)),
      'url'         => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'RikssymJournal', 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'description' => new sfValidatorString(array('required' => false)),
      'region_id'   => new sfValidatorPropelChoice(array('model' => 'RikssymGeoregion', 'column' => 'id', 'required' => false)),
      'url'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rikssym_journal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RikssymJournal';
  }


}
