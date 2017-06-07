<?php

namespace RocketShipIt\Service\Rate;

/**
* Main Rate class for producing rates for various packages/shipments
*
* This class is a wrapper for use with all carriers to produce rates 
* Valid carriers are: UPS, USPS, Stamps, DHL, CANADA, and FedEx.
*/
class Stamps extends \RocketShipIt\Service\Common
{
    var $packageCount;
    
    function __construct()
    {
        $classParts = explode('\\', __CLASS__);
        $carrier = end($classParts);
        parent::__construct($carrier);
    }

    function getAllSTAMPSRates()
    {
        $creds = $this->core->credentials;

        $rate = array();
        $rate['FromZIPCode'] = $this->shipCode;
        if ($this->toCode != '') {
            if ($this->toCountry != $this->shipCountry) {
                $rate['ToPostalCode'] = $this->toCode;
            } else {
                $rate['ToZIPCode'] = $this->toCode;
            }
        }
        $rate['ToCountry'] = $this->toCountry;
        $rate['WeightLb'] = $this->weightPounds;
        if ($this->weightOunces != '') {
            $rate['WeightOz'] = $this->weightOunces;
        }
        $rate['PackageType'] = $this->packagingType;

        $rate['Length'] = $this->length;
        $rate['Width'] = $this->width;
        $rate['Height'] = $this->height;

        if ($this->customsValue != '') {
            $rate['DeclaredValue'] = $this->customsValue;
        }
        if ($this->insuredValue != '') {
            $rate['InsuredValue'] = $this->insuredValue;
        }

        if ($this->shipDate != '') {
            $rate['ShipDate'] = $this->shipDate;
        } else {
            $rate['ShipDate'] = date("Y-m-d");
        }

        $rate['AddOnsV2'] = Array();

        $request = array();
        $request['Credentials'] = $creds;
        $request['Rate'] = $rate; 

        $response = $this->core->request('GetRates', $request);
        return $response;
    }

    function simplifySTAMPSRates()
    {
        $stamps = $this->getAllSTAMPSRates();
        // TODO: If error do an array with error as key and description as value
        // else, for each rate find the description and value and put it into an array
        $rates = Array();
        foreach ($stamps->Rates->Rate as $rte) {
            if ($rte) {
                $svc_code = $rte->ServiceType;
                $service = $this->core->getServiceDescriptionFromCode($svc_code);
                $value = $rte->Amount;
                $packageType = $rte->PackageType;
                //$rates["$service - $packageType"] = $value;
                $simpleRate = array(
                    'desc' => "$service - $packageType",
                    'rate' => $value,
                    'service_code' => $svc_code,
                    'package_type' => $packageType
                );
                if (!empty($user_func)) {
                    $simpleRate = call_user_func($user_func, end(explode('\\', __CLASS__)), $rte, $simpleRate);
                }
                $rates[] = $simpleRate;
            }
        }
        return $rates;
    }

    // Checks the country to see if the request is International
    function isInternational($country)
    {
        if ($country == '' || $country == 'US' || $country == $this->core->getCountryName('US')) {
            return false;
        }
        return true;
    }
}
