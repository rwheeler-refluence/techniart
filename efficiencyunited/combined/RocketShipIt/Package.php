<?php

namespace RocketShipIt;

/**
* Main class for producing package objects that are later inserted into a shipment
* @see RocketShipShipment::addPackageToShipment()
*/
class Package extends \RocketShipIt\Service\Base
{

    var $ups;

    public function __Construct($carrier)
    {
        parent::__construct($carrier, false);
    }

}
