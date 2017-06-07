<?php

namespace RocketShipIt\Service\Shipment;

/**
* Main Shipping class for producing labels and notifying carriers of pickups.
*
* This class is a wrapper for use with all carriers to produce labels for
* shipments.  Valid carriers are: UPS, DHL, Stamps, CANADA USPS, and FedEx.
*/
class Stamps extends \RocketShipIt\Service\Common
{
    
    var $customsLines;

    function __construct()
    {
        $classParts = explode('\\', __CLASS__);
        $carrier = end($classParts);
        parent::__construct($carrier);
        $this->customsLines = array();
    }

    
    function addPackageToSTAMPSshipment($packageObj)
    {
        // Add Rate array to the stamps shipment object
        $this->package = $packageObj;
    }

    function addCustomsLineToSTAMPSshipment($customsObj)
    {
        $customs = $customsObj;
        // Customs document generation
        $custLine = new \stdClass();
        $custLine->Description = $customs->customsDescription; //required
        $custLine->Quantity = $customs->customsQuantity; //required
        $custLine->Value = $customs->customsValue; //required
        $custLine->WeightLb = $customs->customsWeight; //required
        $custLine->HSTariffNumber = $customs->customsHsTariff; //max 6 digits, required
        $custLine->CountryOfOrigin = $customs->customsOriginCountry; //max 2 digits, required
        array_push($this->customsLines, $custLine);
    }

    function sendSTAMPSshipment()
    {
        $creds = $this->core->credentials;

        // Get package from addPackageToSTAMPSshipment()
        if (isset($this->package)) {
            $rate = $this->package;
        }

        $v = new \RocketShipIt\AddressValidate('STAMPS');
        $v->setParameter('toState', $this->toState);
        $v->setParameter('toCity', $this->toCity);
        $v->setParameter('toAddr1', $this->toAddr1);
        if ($this->toAddr2 != '') {
            $v->setParameter('toAddr2', $this->toAddr2);
        }
        $v->setParameter('toCode', $this->toCode);
        $v->setParameter('toCountry', $this->toCountry);
        $v->setParameter('toPhone', $this->toPhone);
        if ($this->shipCountry != '') {
            $v->setParameter('shipCountry', $this->shipCountry);
        } else {
            $v->setParameter('shipCountry', $this->toCountry);
        }
        $response = $v->validate();

        if (is_soap_fault($response)) {
            return $response;
        }

        $to = $response->Address;

        $from = new \stdClass;
        $from->FullName = $this->shipper;
        if ($this->shipPhone != '') {
            $from->PhoneNumber = $this->shipPhone;
        }
        $from->Address1 = $this->shipAddr1;
        if ($this->shipAddr2 != '') {
            $from->Address2 = $this->shipAddr2;
        }
        $from->City = $this->shipCity;
        $from->State = $this->shipState;
        if ($this->shipCode != '') {
            $from->ZIPCode = $this->shipCode;
        }

        if ($this->toCompany != '') {
            $to->Company = $this->toCompany;
        }
        $to->FullName = $this->toName;

        $customs = new \stdClass();
        $customs->ContentType = $this->customsContentType; //required
        $customs->Comments = $this->customsComments; //not required
        $customs->LicenseNumber = $this->customsLicenseNumber; //max length 6 //not required
        $customs->CertificateNumber = $this->customsCertificateNumber; //max length 8 //not required
        $customs->InvoiceNumber = $this->customsInvoiceNumber; //max length 10 //not required
        $customs->OtherDescribe = $this->customsOtherDescribe; //max length 20 //required when contentType is other
        $customs->CustomsLines = $this->customsLines; //required


        $request = new \stdClass();
        $request->Credentials = $creds;
        $request->IntegratorTxID = $this->generateRandomString();
        $request->Rate = $rate;
        $request->From = $from;
        $request->To = $to;
        if ($this->toCountry != 'US') {
            $request->Customs = $customs;
        }
        $request->ImageType = $this->upCaseFirstLetter($this->imageType);

        if ($this->core->debugMode) {
            $request->SampleOnly = 'true';
        }
        if ($this->referenceValue != '') {
            $request->memo = $this->referenceValue;
        }
        if ($this->emailTo != '') {
            $request->recipient_email = $this->emailTo;
        }

        $response = @$this->core->request('CreateIndicium', $request);
        return $response;
    }

    public function upCaseFirstLetter($word)
    {
        $word = strtolower($word);
        return ucfirst($word);
    }

    /**
     * Creates random string of alphanumeric characters
     * 
     * @return string
     */
    private function generateRandomString()
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
