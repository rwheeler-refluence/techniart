<?php

namespace RocketShipIt;

use \RocketShipIt\Helper\XmlParser;

/**
* Main class for getting time in transit information
*
*/
class TimeInTransit extends \RocketShipIt\Service\Base
{
    function __construct($carrier)
    {
        $classParts = explode('\\', __CLASS__);
        $service = end($classParts);
        parent::__construct($carrier, $service);
    }

    /**
    * Returns a Time in Transit resposne from the carrier.
    */
    function getTimeInTransit()
    {
        $method = 'get'. $this->carrier. $this->carrierService;
        if (!method_exists($this->inherited, $method)) {
            return $this->invalidCarrierResponse();
        }
        return $this->inherited->$method();
    }
}
