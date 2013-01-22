<?php
/* 
 * A basic data storage class, fetching data via the indicator classes and entities
 * @author  Birger Fühne
 * @version 1.0
 */
class RikssymDataDump{

    /* array containing the entities for which data is requested
     *
     * @var entities array
     */
    private $entities;

    /** 
     * @var years array data  array containing the years that data is requested for
     */
    private $years;

    /**
     * @var indicators array containing the indicators that data is requested for
     */
    private $indicators;

    /* multi-dimensional array containing the data for the requested
     * entities and indicators.
     * First key is the entity id e.g. $this->data[$entity->getId()].
     * Second key is the indicator id e.g. $this->data[$entity->getId()][indicator->getId()]
     */
    public $data = array();

    public function __construct($entities, Array $years, Array $indicators){
        $this->entities = $entities;
        $this->years = $years;
        $this->indicators = $indicators;
        $entityCounter = 0;
        foreach($this->entities as $entity){
            $indicatorCounter = 0;
            foreach($this->indicators as $indicator){
                $classname = $indicator->getClassname();
                $this->data[$entity->getId()][$indicator->getId()] = new $classname($indicator->getName(),
                    $indicator->getDescription(),
                    $years,
                    $entity,
                    $indicator->getIspublic());
                $indicatorCounter++;
            }
            $entityCounter++;
        }
    }

    /**
     *
     * @param Object $entity    The requested entity
     * @param Indicator $indicator  The requested indicator
     * @return Array    Array containing all values for the entity and indicator
     */
    public function getValuesOfIndicator($entity, $indicator){
        return $this->data[$entity->getId()]
        [$indicator->getId()]
        ->getValues();
    }

    /**
     * returns the value for an entity for a year of an indicator.
     * @param   Object  $entity The entity data is requested for
     * @param   Integer $year   The year data is requested for
     * @param   Boolean $format Toggles wether to print values with unit symbol or not.
     * 
     */
    public function getValueOfYear($entity, $indicator, $year, $format = false){
        $valueOfYear = $this->data[$entity->getId()]
            [$indicator->getId()]->getValueOfYear($year, $format);
        return $valueOfYear;
    }

    public function getEntities(){
        $entities = null;
        while(list($key, $val) = each($this->data)){
            $entities[] = $val;
        }        
        return $entities;
    }
}
?>