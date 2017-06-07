<?php

namespace RocketShipIt\Service\TimeInTransit;

use \RocketShipIt\Helper\XmlParser;
use \RocketShipIt\Helper\XmlBuilder;

/**
* Main class for getting time in transit information
*
*/
class Ups extends \RocketShipIt\Service\Common
{
    function __construct()
    {
        $classParts = explode('\\', __CLASS__);
        $carrier = end($classParts);
        parent::__construct($carrier);
    }

    public function processResponse()
    {
        $xmlParser = new xmlParser($this->core->xmlResponse);
        $xmlArray = $xmlParser->xmlparser($this->core->xmlResponse);
        $xmlArray = $xmlParser->getData();

        $this->responseArray = $xmlArray;

        if (isset($xmlArray['TimeInTransitResponse']['Response']['ResponseStatusCode'])) {
            if ($xmlArray['TimeInTransitResponse']['Response']['ResponseStatusCode'] == 1) {
                $this->status = 'success';
            }
            if ($xmlArray['TimeInTransitResponse']['Response']['ResponseStatusCode'] == 0) {
                $this->status = 'failure';
            }
        }
    }

    function buildUPSTimeInTransitXml()
    {
        $this->core->access();
        $accessXml = $this->core->xmlObject;

        $xml = new xmlBuilder();
        $xml->push('TimeInTransitRequest',array('xml:lang' => 'en-US'));
            $xml->push('Request');
                $xml->push('TransactionReference'); // Not required
                    $xml->element('CustomerContext', 'RocketShipIt'); // Not required
                $xml->pop(); // close TransactionReference, not required
                $xml->element('RequestAction', 'TimeInTransit');
            $xml->pop(); // end Request;
            $xml->push('TransitFrom');
                $xml->push('AddressArtifactFormat');
                    $xml->element('PoliticalDivision2',$this->shipCity);
                    $xml->element('CountryCode',$this->shipCountry);
                    $xml->element('PostcodePrimaryLow',$this->shipCode);
                $xml->pop(); // end AddressArtifactFormat
            $xml->pop(); // end TransitFrom
            $xml->push('TransitTo');
                $xml->push('AddressArtifactFormat');
                    $xml->element('PoliticalDivision2',$this->toCity);
                    $xml->element('CountryCode',$this->toCountry);
                    $xml->element('PostcodePrimaryLow',$this->toCode);
                $xml->pop(); // end AddressArtifactFormat
            $xml->pop(); // end TransitTo
            if ($this->weight != '') {
                $xml->push('ShipmentWeight');
                    $xml->push('UnitOfMeasurement');
                        $xml->element('Code',$this->weightUnit);
                        $xml->element('Description','Pounds');
                    $xml->pop(); //end UnitOfMeasurement
                    $xml->element('Weight',$this->weight);
                $xml->pop(); //end ShipmentWeight
            }
            $xml->element('TotalPackagesInShipment','1');
            // $xml->push('InvoiceLineTotal');
            //     $xml->element('CurrencyCode',$this->currency);
            //     $xml->element('MonetaryValue',$this->monetaryValue);
            // $xml->pop(); // end InvoiceLineTotal
            $xml->element('PickupDate',$this->pickupDate);
            //$xml->element('DocumentsOnlyIndicator','');
            if ($this->monetaryValue != '') {
                $xml->push('InvoiceLineTotal');
                    $xml->element('CurrencyCode', $this->currency);
                    $xml->element('MonetaryValue', $this->monetaryValue);
                $xml->pop();
            }
        $xml->pop(); // end TimeInTransitRequest

        // Convert xml object to a string
        $accessXmlString = $accessXml->getXml();
        $requestXmlString = $xml->getXml();
        return $accessXmlString. $requestXmlString;
    }

    function getUPSTimeInTransit()
    {
        $xmlString = $this->buildUPSTimeInTransitXml();
        $this->core->request('TimeInTransit', $xmlString);
        $this->processResponse();
        return $this->responseArray; 
    }
}
