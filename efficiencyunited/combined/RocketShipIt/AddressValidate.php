<?php

namespace RocketShipIt;

/**
* Main Address Validation class for carrier.
*
* Valid carriers are: UPS, USPS, STAMPS, and FedEx.
*/
class AddressValidate extends \RocketShipIt\Service\Base
{

    public function __construct($carrier)
    {
        $classParts = explode('\\', __CLASS__);
        $service = end($classParts);
        parent::__construct($carrier, $service);
    }

    /**
    * Send address data to carrier.
    * 
    * This function detects carrier and executes the 
    * carrier specific function.
    */
    public function validate()
    {
        $method = 'get'. $this->carrier. 'Validate';
        if (!method_exists($this->inherited, $method)) {
            return $this->invalidCarrierResponse();
        }
        return $this->inherited->$method();
    }

    public function validateStreetLevel()
    {
        switch ($this->carrier) {
            case "UPS":
                return $this->inherited->getUPSValidateStreetLevel();
            default:
                return $this->invalidCarrierResponse();
        }
    }

}
