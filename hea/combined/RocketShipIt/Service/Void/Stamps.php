<?php

namespace RocketShipIt\Service\Void;

/**
* Main class for voiding shipments.
*
* This class is a wrapper for use with all carriers to cancel 
* shipments.  Valid carriers are: UPS, USPS, and FedEx.
* To create a shipment see {@link RocketShipShipment}.
*/
class Stamps extends \RocketShipIt\Service\Common
{
    function __construct()
    {
        $classParts = explode('\\', __CLASS__);
        $carrier = end($classParts);
        parent::__construct($carrier);
    }
   
    function voidStampsShipment()
    {
        $shipment = new \stdClass();
        $shipment->Credentials = $this->core->credentials;
        $shipment->StampsTxID = $this->shipmentIdentification;

        return $this->core->request('CancelIndicium', $shipment);
    }
}
