<?php

class RikssymIndicator extends BaseRikssymIndicator {
    public $name;
    public $description;
    public $method;
    public $unitTitle;
    public $entity;
    public $years;
    public $values;
    public $frontendMessage;
    public $missingStatement = "No data available for ";

    public function __construct() {
        parent::__construct();
    }

    public function setEntity($entity) {
        $this->entity = $entity;
    }

    public function getEntity() {
        return $this->entity;
    }

    public function setValues($values) {
        $this->values = $values;
    }

    public function getValues() {
        return $this->values;
    }

    public function setYears($years) {
        $this->years = $years;
    }

    public function getYears() {
        return $this->years;
    }

    public function setFrontendMessage($message){
        $this->frontendMessage = $message;
    }

    public function getFrontendMessage(){
        return $this->frontendMessage;
    }

    public function getValueOfYear($year, $format) {
        if($format == true && in_array($year, $this->years)) {
            return $this->values[$year].$this->unitSymbol;
        }
        else if($format == false && in_array($year, $this->years)) {
            return $this->values[$year];
        }
        else {
            throw new Exception("RikssymIndicator::getValueOfYear ".$year." is not in array.");
        }
    }
}
