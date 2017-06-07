<?php

namespace RocketShipIt;

/**
* Main Rate class for producing rates for various packages/shipments
*
* This class is a wrapper for use with all carriers to produce rates 
* Valid carriers are: UPS, USPS, STAMPS and FedEx.
*/
class Rate extends \RocketShipIt\Service\Base
{
    var $packageCount;
    
    function __construct($carrier)
    {
        $classParts = explode('\\', __CLASS__);
        $service = end($classParts);
        parent::__construct($carrier, $service);
    }

    /**
    * Retruns a single rate from the carrier.
    */
    function getRate()
    {
        $method = 'get'. $this->carrier. $this->carrierService;
        if (!method_exists($this->inherited, $method)) {
            return $this->invalidCarrierResponse();
        }
        return $this->inherited->$method();
    }

    /**
    * Retruns all available rates from the carrier.
    */
    function getAllRates()
    {
        $method = 'getAll'. $this->carrier. 'Rates';
        if (!method_exists($this->inherited, $method)) {
            return $this->invalidCarrierResponse();
        }
        return $this->inherited->$method();
    }

    /**
    * This is a wrapper to create a running package for each carrier.
    *
    * This is used to add packages to a shipment for any carrier.
    * You use the {@link RocketShipPackage} class to create a package
    * object.
    */
    function addPackageToShipment ($packageObj)
    {
        $this->inherited->core->parameters['packages'][] = $packageObj->parameters;
        $this->packageCount++;
        switch ($this->carrier) {
            case "UPS":
                return $this->inherited->addPackageToUPSShipment($packageObj);
            case "USPS":
                return $this->inherited->addPackageToUSPSShipment($packageObj, $this->inherited->isInternational($this->inherited->toCountry));
            case 'FEDEX':
                return $this->inherited->addPackageToFEDEXShipment($packageObj);
            case 'DHL':
                return $this->inherited->addPackageToDHLShipment($packageObj);
        }
    }

    /**
    * Return a simple rate from carrier.
    */
    public function getSimpleRate()
    {
        $method = 'simplify'. $this->carrier. 'Rate';
        if (!method_exists($this->inherited, $method)) {
            return $this->invalidCarrierResponse();
        }
        return $this->inherited->$method();
    }

    /**
    * Return all available rates from carrier in a simple array.
    */
    public function getSimpleRates($user_func=null)
    {
        $method = 'simplify'. $this->carrier. 'Rates';
        if (!method_exists($this->inherited, $method)) {
            return $this->invalidCarrierResponse();
        }
        return $this->inherited->$method($user_func);
    }

    // Checks the country to see if the request is International
    function isInternational($country)
    {
        if ($country == '' || $country == 'US' || $country == $this->inherited->core->getCountryName('US')) {
            return false;
        }
        return true;
    }

}
