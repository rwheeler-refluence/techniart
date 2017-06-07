<?php

namespace RocketShipIt\Service\Shipment;

use \RocketShipIt\Helper\XmlParser;

/**
* Main Shipping class for producing labels and notifying carriers of pickups.
*
* This class is a wrapper for use with all carriers to produce labels for
* shipments.  Valid carriers are: UPS, USPS, and FedEx.
*/
class Usps extends \RocketShipIt\Service\Common
{
    var $customsLines;

    function __construct()
    {
        $classParts = explode('\\', __CLASS__);
        $carrier = end($classParts);
        parent::__construct($carrier);
    }
    
    function buildUSPSShipmentXml()
    {
        $xml = $this->core->xmlObject;

        $xml->push('DeliveryConfirmationV3.0Request', array('USERID' => $this->userid));
            $xml->element('Option','1');
            $xml->push('ImageParameters');
            $xml->pop(); // end ImageParameters
            $xml->element('FromName', $this->shipContact);
            $xml->element('FromFirm', $this->shipper);
            $xml->element('FromAddress1', ' ');
            $xml->element('FromAddress2', $this->shipAddr1); // Why?  Cause usps requires addr2 but addr1 can be blank
            $xml->element('FromCity', $this->shipCity);
            $xml->element('FromState', $this->shipState);
            $xml->element('FromZip5', $this->shipCode);
            $xml->emptyelement('FromZip4');
            $xml->element('ToName', $this->toName);
            $xml->element('ToFirm', $this->toCompany);
            // Why?  Cause usps requires addr2 but addr1 can be blank
            if ($this->toAddr2 != '') {
                $xml->element('ToAddress1', $this->toAddr2); 
            } else {
                $xml->emptyelement('ToAddress1');
            }
            $xml->element('ToAddress2', $this->toAddr1);
            $xml->element('ToCity', $this->toCity);
            $xml->element('ToState', $this->toState);
            $xml->element('ToZip5', $this->toCode);
            $xml->emptyelement('ToZip4');
            $xml->element('WeightInOunces', $this->weightOunces);
            $xml->element('ServiceType', $this->service);
            $xml->emptyelement('POZipCode');
            $xml->element('ImageType', $this->imageType);
            $xml->emptyelement('LabelDate');
        $xml->pop(); // end DeliveryConfirmationV3.0Request

        $xmlString = $xml->getXml();
        return 'API=DeliveryConfirmationV3&XML='. $xmlString;
    }

    function buildUSPSReturnShipmentXml()
    {
		$xml = $this->core->xmlObject;
        $xml->push('EMRSV4.0Request', array('USERID' => $this->userid));
			$xml->element('Option', 'LEFTWINDOW');
			$xml->element('CustomerName', $this->fromName);
			$xml->emptyelement('CustomerAddress1');
            if ($this->fromAddr1) {
                $xml->element('CustomerAddress2', $this->fromAddr1);					
            } else {
                $xml->element('CustomerAddress2', $this->fromAddr1);
            }
			$xml->element('CustomerCity', $this->fromCity);
			$xml->element('CustomerState', $this->fromState);
			$xml->element('CustomerZip5', $this->toCode);
			if ($this->fromExtendedCode) {
                $xml->element('CustomerZip4', $this->fromExtendedCode);
            } else {
                $xml->element('CustomerZip4', ' ');
            }

			$xml->element('RetailerName', $this->shipper);
			$xml->element('RetailerAddress', $this->shipAddr1);
			$xml->element('PermitNumber', $this->permitNumber);
			$xml->element('PermitIssuingPOCity', $this->permitIssuingPOCity);
			$xml->element('PermitIssuingPOState', $this->permitIssuingPOState);
			$xml->element('PermitIssuingPOZip5', $this->permitIssuingPOZip5);
			$xml->element('PDUFirmName', $this->pduFirmName);
			$xml->element('PDUPOBox', $this->pduPOBox);
			$xml->element('PDUCity', $this->pduCity);
			$xml->element('PDUState', $this->pduState);
			$xml->element('PDUZip5', $this->pduZip5);
			$xml->element('PDUZip4', $this->pduZip4);
			$xml->element('ServiceType', $this->service);
			$xml->element('DeliveryConfirmation', 'False');
			$xml->element('InsuranceValue', ' ');
			$xml->element('WeightInPounds', $this->weightPounds);
			$xml->element('WeightInOunces', $this->weightOunces);
			$xml->element('RMA', $this->referenceValue);
			$xml->element('RMAPICFlag', 'False');
			$xml->element('ImageType', $this->imageType);
			// $xml->element('RMABarcode', 'True');

            // Email confirmation
            if ($this->returnEmailAddress != '') {
                $xml->element('SenderName', $this->returnEmailFromName);
                $xml->element('SenderEMail ', $this->returnFromEmailAddress);
                $xml->element('RecipientName', $this->returnToName);
                $xml->element('RecipientEMail', $this->returnEmailAddress);
            }

			$xml->element('AllowNonCleansedDestAddr', 'False');

		$xml->pop(); // end EMRSV4.0Request

		$xmlString = $xml->getXml();
		return 'API=MerchandiseReturnV4&XML='. $xmlString;
	}

    function sendUSPSshipment()
    {
        if ($this->permitNumber != '') {
            $xmlString = $this->buildUSPSReturnShipmentXml();
            $this->core->uspsUrl = 'https://secure.shippingapis.com/ShippingAPI.dll';
        } else {
            $xmlString = $this->buildUSPSShipmentXml();
        }

        $this->core->xmlSent = $xmlString;
        $this->core->xmlResponse = $this->core->request('ShippingAPI.dll', $xmlString);

        $xmlParser = new xmlParser($this->core->xmlResponse);
        $xmlArray = $xmlParser->xmlparser($this->core->xmlResponse);
        $xmlArray = $xmlParser->getData();
        return $xmlArray; 
    }

    /**
     * Simplifies the response array 
     *
     * @param array $xmlArray
     * @return array|string
     */
    function simplifyUSPSResponse($xmlArray)
    {
		// If error in the array return the error.
		if (in_array('Error', array_keys($xmlArray))) {
            return ("Error confirming shipment: ". $xmlArray['Error']['Description']);
		}

        if (in_array('DeliveryConfirmationV3.0Response', array_keys($xmlArray))) {
			$trk_main = $xmlArray['DeliveryConfirmationV3.0Response']['DeliveryConfirmationNumber'];
			$label = $xmlArray['DeliveryConfirmationV3.0Response']['DeliveryConfirmationLabel'];
			return array('charges' => '0.00', 'trk_main' => $trk_main, 'pkgs' => array(0 => array('pkg_trk_num' => $trk_main, 'label_fmt' => 'pdf', 'label_img' => $label)));
		}

        if (in_array('EMRSV4.0Response', array_keys($xmlArray))) {
			$trk_main = $xmlArray['EMRSV4.0Response']['MerchandiseReturnNumber'];
			$label = $xmlArray['EMRSV4.0Response']['MerchandiseReturnLabel'];
			return array('charges' => '0.00', 'trk_main' => $trk_main, 'pkgs' => array(0 => array('pkg_trk_num' => $trk_main, 'label_fmt' => 'pdf', 'label_img' => $label)));
        }

		return $xmlArray;
	}

    /**
     * Creates random string of alphanumeric characters
     * 
     * @return string
     */
    function generateRandomString()
    {
        $length = 128;
        $characters = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = "";
        
        for ($i = 0; $i < $length; $i++) {
            $index = mt_rand(0, strlen($characters));
            $string .= substr($characters, $index, 1);
        }
        return $string;
    }
}
