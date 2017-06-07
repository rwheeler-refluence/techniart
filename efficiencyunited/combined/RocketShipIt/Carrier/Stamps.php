<?php

namespace RocketShipIt\Carrier;

/**
* Core Stamp.com Class
*
* Used internally to send data, set debug information, change
* urls, and build xml
*/
class Stamps extends \RocketShipIt\Carrier\Base
{

    var $xmlSent;
    var $xmlPrevResponse;
    var $xmlResponse;
    public $paramSynonyms = array(
        'weight' => 'weightPounds',
    );

    function __construct()
    {
        parent::__construct();

        $creds = array();
        $creds['IntegrationID'] = 'e13dde83-59b9-4b45-9a51-3f83016fd883';
        $creds['Username'] = \RocketShipIt\getStampsDefault('username');
        $creds['Password'] = \RocketShipIt\getStampsDefault('password');
        $this->debugMode = \RocketShipIt\getGenericDefault('debugMode');

        $this->credentials = $creds;
    }

    function request($action, $request)
    {
        $options = array('trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE, 'exceptions' => 0);
        // If proxy is specified as enviornment variable pass it in.
        if (getenv('PROXY_HOST')) {
            $options['proxy_host'] = getenv('PROXY_HOST'); 
        }
        if (getenv('PROXY_PORT')) {
            $options['proxy_port'] = getenv('PROXY_PORT'); 
        }
        if (getenv('STAMPS_URL')) {
            $options['location'] = getenv('STAMPS_URL'); 
        }

        $options['connection_timeout'] = $this->requestTimeout;

        $wsdl = __DIR__. "/stamps.wsdl";

        $client = new \RocketShipIt\Helper\SoapClient($wsdl, $options);

        // Allows for mocking of soap requests
        if ($this->mockXmlResponse != '') {
            $client->mockXmlResponse = $this->mockXmlResponse;
        }

        if ($this->validateOnly != '') {
            $client->validate_only == true;
        }

        $response = $client->$action($request);

        $this->xmlResponse = $client->__getLastResponse();
        $this->xmlSent = $client->__getLastRequest();

        return $response;
    }

    function access()
    {
        $auth = new \stdClass();
        $auth->Credentials = $this->credentials;

        return $this->request('AuthenticateUser', $auth);
    }

    function getAccountInfo()
    {
        $info = new \stdClass();
        $info->Credentials = $this->credentials;

        return $this->request('GetAccountInfo', $info);
    }

    function getUrl()
    {
        $url = new \stdClass();
        $url->Credentials = $this->credentials;
        $url->URLType = 'AccountSettingsPage';

        return $this->request('GetUrl', $url);
    }

    function purchasePostage($amount)
    {
        $ai = $this->getAccountInfo();
        $controlAmount = $ai->AccountInfo->PostageBalance->ControlTotal;

        $response = $this->addPostage($amount, $controlAmount);
        return $response;
    }

    function addPostage($amount, $controlAmount)
    {
        $p = new \stdClass();
        $p->Credentials = $this->credentials;
        $p->PurchaseAmount = $amount;
        $p->ControlTotal = $controlAmount;

        return $this->request('PurchasePostage', $p);
    }

    function getPurchaseStatus($transactionId)
    {
        $ps = new \stdClass();
        $ps->Credentials = $this->credentials;
        $ps->TransactionID = $transactionId;

        return $this->request('GetPurchaseStatus', $ps);
    }

    function getServiceDescriptionFromCode($code)
    {
        switch($code) {
            case 'US-PM':
                return 'USPS Priority Mail';
            case 'US-PMI':
                return 'USPS Priority Mail International';
            case 'US-XM':
                return 'USPS Express Mail';
            case 'US-EMI':
                return 'USPS Express Mail International';
            case 'US-PP':
                return 'USPS Parcel Post';
            case 'US-MM':
                return 'USPS Media Mail';
            case 'US-FC':
                return 'USPS First Class Mail';
            case 'US-FCI':
                return 'USPS Standard Mail';
            case 'US-BP':
                return 'USPS Bound Printed Matter';
            case 'US-LM':
                return 'USPS Library Mail';
            case 'US-PS':
                return 'USPS Parcel Select';
            case 'US-CM':
                return 'USPS Critical Mail';
            default:
                return 'Unknown service code';
        }
    }

    function getCountryName($countryCode)
    {
        $converter = new \RocketShipIt\Helper\CountryConverter;
        return $converter->getCountryName($countryCode); 
    }
   
}
