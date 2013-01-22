<?php
/**
 * Description of RikssymIndicatorFactory
 *
 * @author BFuhne
 */
class RikssymIndicatorFactory {
    public static function createIndicator($indicatorClassName, $arrangement, $years, $custom) {
        $availableIndicators = RikssymIndicatorPeer::doSelect($criteria = new Criteria());
        $availableIndicatorClassNames = array();
        foreach($availableIndicators as $availableIndicator) {
            $availableIndicatorClassNames[] = $availableIndicator->getClassName();
        }
        if(in_array($indicatorClassName, $availableIndicatorClassNames)) {
            $criteria = new Criteria();
            $criteria->add(RikssymIndicatorPeer::CLASSNAME, $indicatorClassName);
            $indicatorResult = RikssymIndicatorPeer::doSelect($criteria);
            foreach($indicatorResult as $indicatorRow) {
                $className = $indicatorRow->getClassname();
                $indicatorObject = new $className;
                $indicator = RikssymIndicatorPeer::retrieveByPK($indicatorRow->getId());
                $indicatorObject->name = $indicator->getName();
                $indicatorObject->method = $indicator->getMethod();
                $indicatorObject->description = $indicator->getDescription();
                $indicatorObject->unitTitle = $indicator->getUnitTitle();
                $indicatorObject->setYears($years);
                $indicatorObject->setEntity($arrangement);
                $indicatorObject->prepareQuery();
                
                return $indicatorObject;
            }
        }
        else {
            throw new Exception("The indicator ".$indicatorClassName." could not be found.");
        }
    }
}
?>
