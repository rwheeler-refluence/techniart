<?php

namespace RocketShipIt\Service\TimeInTransit;

use \RocketShipIt\Helper\XmlParser;

/**
* Main class for getting time in transit information
*
*/
class Usps extends \RocketShipIt\Service\Common
{
    var $inherited;

    function __construct() {
        $classParts = explode('\\', __CLASS__);
        $carrier = end($classParts);
        parent::__construct($carrier);
    }

    public function buildUSPSTimeInTransitXml()
    {
        $xml = $this->core->xmlObject;
        
        $xml->push('ExpressMailCommitmentRequest',array('USERID' => $this->userid));
            $xml->element('OriginZIP', $this->shipCode);
            $xml->element('DestinationZIP', $this->toCode);
            $xml->element('Date', $this->pickupDate);
        $xml->pop();
        
        return 'API=ExpressMailCommitment&XML='. $xml->getXml();
    }

    function getUSPSTimeInTransit()
    {
        $xmlString = $this->buildUSPSTimeInTransitXml();
        $this->core->request('ShippingAPI.dll', $xmlString);
        
        // Convert the xmlString to an array
        $xmlParser = new xmlParser($this->core->xmlResponse);
        $xmlArray = $xmlParser->xmlparser($this->core->xmlResponse);
        $xmlArray = $xmlParser->getData();
        return $xmlArray; 
    }
}
