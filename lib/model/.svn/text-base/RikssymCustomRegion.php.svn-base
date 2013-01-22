<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class RikssymCustomRegion{

    private $id;
    private $countries = array();
    private $name;

    public function __construct(Array $countries){        
        $this->setId();
        $this->countries = $countries;
        $this->setName();
    }

    

    public function setCountries(Array $countries){
        $this->countries = $countries;
    }


    public function getCountries(){
        return $this->countries;
    }

    public function addCountry($country){
        $this->countries[] = $country;
    }

    public function setId(){

       //$this->id = sfConfig::get('app_customArrangementId');
       $this->id = 999;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName(){
        foreach($this->countries as $country){
            $this->name .= $country->getName()."::";
        }
    }

    public function getCountryIds(){
        $countryIds = array();
        foreach($this->countries as $country){
            $countryIds[] = $country->getId();
        }
        return $countryIds;
    }
}
?>
