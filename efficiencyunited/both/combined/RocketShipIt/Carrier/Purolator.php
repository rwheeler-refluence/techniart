<?php

namespace RocketShipIt\Carrier;

use \RocketShipIt\Request;

/**
* Core Purolator Class
*
* Used internally to send data, set debug information, change
* urls, and build xml
*/
class Purolator extends \RocketShipIt\Carrier\Base
{
    var $request;

    function __construct()
    {
        parent::__construct();
    }

    public function request($action, $request)
    {
        $options = array('trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE, 'exceptions' => 0);
        $options['login'] = \RocketShipIt\getPUROLATORDefault('username');
        $options['password'] = \RocketShipIt\getPUROLATORDefault('password');

        //$options['location'] = 'http://localhost:8088/mockTrackingServiceEndpoint';
        $wsdl = __DIR__. "/../Resources/schemas/purolator/EstimatingService.wsdl";
        $client = new \RocketShipIt\Helper\SoapClient($wsdl, $options);

        //Define the SOAP Envelope Headers
        $headers = array();
        $headers[] = new \SoapHeader ( 'http://purolator.com/pws/datatypes/v1', 
        'RequestContext', 
            array (
                'Version'           =>  '1.3',
                'Language'          =>  'en',
                'GroupID'           =>  'xxx',
                'RequestReference'  =>  'Rating 123'
            )
        );

        $client->__setSoapHeaders($headers);

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

}
