<?php

namespace RocketShipIt\Service\AddressValidate;
use RocketShipIt\Helper\XmlBuilder as XmlBuilder;
use RocketShipIt\Helper\XmlParser as XmlParser;

/**
* Main Address Validation class for carrier.
*
* Valid carriers are: UPS, USPS, STAMPS, and FedEx.
*/
class Usps extends \RocketShipIt\Service\Common
{
    function __construct()
    {
        $classParts = explode('\\', __CLASS__);
        $carrier = end($classParts);
        parent::__construct($carrier);
    }

    function getUSPSValidate()
    {
        $xml = $this->buildUSPSValidateStreetLevelXml();
        $xmlString = 'API=Verify&XML='. $xml;
        $this->core->request('ShippingAPI.dll', $xmlString);

        // Convert the xmlString to an array
        $xmlParser = new xmlParser($this->core->xmlResponse);
        $xmlArray = $xmlParser->xmlparser($this->core->xmlResponse);
        $xmlArray = $xmlParser->getData();
        return $xmlArray;
    }

    function buildUSPSValidateStreetLevelXml()
    {
        $xml = new xmlBuilder();
        $xml->push('AddressValidateRequest', array('USERID' => $this->userid));
            $xml->push('Address');
                if ($this->toAddr2 != '') {
                    $xml->element('Address1', $this->toAddr1);
                    $xml->element('Address2', $this->toAddr2);
                } else {
                    $xml->emptyelement('Address1');
                    $xml->element('Address2', $this->toAddr1);
                }
                $xml->element('City', $this->toCity);
                $xml->element('State', $this->toState);
                $xml->emptyelement('Zip5');
                $xml->emptyelement('Zip4');
            $xml->pop(); //end Address
        $xml->pop(); //end OriginDetail
        return $xml->getXml();
    }
}
