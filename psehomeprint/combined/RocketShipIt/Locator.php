<?php

namespace RocketShipIt;

class Locator extends \RocketShipIt\Service\Base {

    function __construct($carrier) {
        $classParts = explode('\\', __CLASS__);
        $service = end($classParts);
        parent::__construct($carrier, $service); 
    }

    function find() {
        $method = 'get'. $this->carrier. 'Locate';
        if (!method_exists($this->inherited, $method)) {
            return $this->invalidCarrierResponse();
        }
        return $this->inherited->$method();
    }

}
