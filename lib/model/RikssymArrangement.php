<?php

class RikssymArrangement extends BaseRikssymArrangement {

    public function getCountryIds() {
        $countryIds = array();
        $riksArrangementCountry = parent::getRikssymArrangementCountrys();
        foreach($riksArrangementCountry as $rac) {
            $countryIds[] = $rac->getCountryId();
        }
        return $countryIds;
    }

    public function __toString() {
        return $this->name;
    }
}
