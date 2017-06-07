<?php

namespace RocketShipIt\Service\AddressValidate;

/**
* Main Address Validation class for carrier.
*
* Valid carriers are: UPS, USPS, STAMPS, and FedEx.
*/
class Stamps extends \RocketShipIt\Service\Common
{
    function __construct()
    {
        $classParts = explode('\\', __CLASS__);
        $carrier = end($classParts);
        parent::__construct($carrier);
    }

    function buildSTAMPSValidateRequest()
    {
        $creds = $this->core->credentials;

        $address = new \stdClass;
        $address->FullName = 'John Doe';
        $address->Address1 = $this->toAddr1;
        if ($this->toAddr2 != '') {
            $address->Address2 = $this->toAddr2;
        }
        $address->City = $this->toCity;
        if ($this->toCountry == $this->shipCountry) {
            $address->State = $this->toState;
        } else {
            $address->Province = $this->toState;
        }
        if ($this->toCode != '') {
            if ($this->toCountry != $this->shipCountry) {
                $address->PostalCode = $this->toCode;
            } else {
                $parts = explode('-', $this->toCode);
                if (count($parts) > 1) {
                    $address->ZIPCode = $parts[0];
                    $address->ZIPCodeAddOn = $parts[1];
                } else {
                    $address->ZIPCode = $parts[0];
                }
            }
        }
        if ($this->toCountry != '') {
            $address->Country = $this->toCountry;
        }
        if ($this->toPhone != '') {
            $address->PhoneNumber = $this->toPhone;
        }

        $request = array();
        $request['Credentials'] = $creds;
        $request['Address'] = $address;
        return $request;
    }

    function getSTAMPSValidate()
    {
        $request = $this->buildSTAMPSValidateRequest();
        return $this->core->request('CleanseAddress', $request);
    }
}
