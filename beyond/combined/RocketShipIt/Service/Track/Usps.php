<?php

namespace RocketShipIt\Service\Track;

use \RocketShipIt\Helper\XmlParser;
use \RocketShipIt\Helper\XmlBuilder;

/**
* Main class for tracking shipments and packages
*
* This class is a wrapper for use with all carriers to track packages
* Valid carriers are: UPS, USPS, and FedEx.
*/
class Usps extends \RocketShipIt\Service\Common
{
    function __construct()
    {
        $classParts = explode('\\', __CLASS__);
        $carrier = end($classParts);
        parent::__construct($carrier);
    }

    function trackUSPS($trackingNumber)
    {
        $xml = $this->core->xmlObject;

        $xml->push('TrackRequest',array('USERID' => $this->userid));
        $xml->push('TrackID',array('ID' => $trackingNumber));
        $xml->pop(); // end TrackID
        $xml->pop(); // end TrackRequest

        $xmlString = $xml->getXml();

        $postData = 'API=TrackV2&XML='. $xmlString;

        $this->core->request('ShippingAPI.dll',$postData);

        // Convert the xmlString to an array
        $xmlParser = new xmlParser($this->core->xmlResponse);
        $xmlArray = $xmlParser->xmlparser($this->core->xmlResponse);
        $xmlArray = $xmlParser->getData();
        return $xmlArray; 
    }
}
