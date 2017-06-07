<?php

namespace RocketShipIt\Carrier;

class Base
{
    public $xmlSent;
    public $requestTimeout;
    public $mockXmlRequest;
    public $mockXmlResponse;
    public $url;
    var $xmlPrevSent;
    var $curlReturned;
    var $parameters;
    var $testingUrl;
    var $productionUrl;

    public function __construct()
    {
        $this->xmlPrevSent = '';
        $this->xmlSent = '';
        $this->curlReturned = '';
        $this->parameters = array('packages' => array(), 'customs' => array());
        $this->requestTimeout = 60; // Default 60 second request timeout
        $this->mockXmlRequest = '';
        $this->mockXmlResponse = '';
    }

    public function isCliMode()
    {
        if (php_sapi_name() == "cli") {
            return true;
        }
        return false; 
    }

    public function jsonEncodeParameters()
    {
        $filteredParams = array();
        foreach ($this->parameters as $param => $value) {
            if ($value != '') {
                $filteredParams[$param] = $value;
            }
        }

        $filteredParams['packages'] = array();
        foreach ($this->parameters['packages'] as $package) {
            $pack = array();
            foreach ($package as $param => $value) {
                if ($value == '') {
                    continue;
                }
                if ($value == $this->parameters[$param]) {
                    continue;
                }
                $pack[$param] = $value;
            }
            $filteredParams['packages'][] = $pack;
        }

        $filteredParams['customs'] = array();
        foreach ($this->parameters['customs'] as $custom) {
            $cust = array();
            foreach ($custom as $param => $value) {
                if ($value == '') {
                    continue;
                }
                if ($value == $this->parameters[$param]) {
                    continue;
                }
                $cust[$param] = $value;
            }
            $filteredParams['customs'][] = $cust;
        }
        return json_encode($filteredParams);
    }

    function debugSection($name, $info, $nohtmlentities=true)
    {
        if ($info == '') {
            return;
        }
        $debugInfo = '';
        $debugInfo .= '--------------------------------------------------'. "\n";
        $debugInfo .= $name. "\n";
        $debugInfo .= '--------------------------------------------------'. "\n";
        if ($nohtmlentities) {
            $debugInfo .= $info;
        } else {
            $debugInfo .= htmlentities($info);
        }
        $debugInfo .= "\n\n";
        return $debugInfo;
    }

    function debug()
    {
        $debugInfo = "<pre>\n";
        if (!isset($this->debugMode)) {
            $this->debugMode = 0;
        }
        $debugInfo .= $this->debugSection(
            'RocketShipIt Debug Information',
            'Version: '. \RocketShipIt\VERSION. "\n"
            ."Debug Mode: $this->debugMode"
        );
        if (isset($this->xmlPrevSent)) {
            if ($this->isCliMode()) {
                $xmlPrevSent = \RocketShipIt\xmlPrettyPrint($this->xmlPrevSent);
            } else {
                $xmlPrevSent = htmlentities(\RocketShipIt\xmlPrettyPrint($this->xmlPrevSent));
            }
            $debugInfo .= $this->debugSection('XML Prev Sent', $xmlPrevSent);
        }
        if (isset($this->xmlPrevResponse)) {
            $debugInfo .= $this->debugSection('XML Prev Response', $this->xmlPrevResponse, $this->isCliMode());
        }
        if (isset($this->xmlSent)) {
            $debugInfo .= $this->debugSection('XML Sent', \RocketShipIt\xmlPrettyPrint($this->xmlSent), $this->isCliMode());
        } else {
            $debugInfo .= $this->debugSection('XML Sent', 'xmlSent was not set', $this->isCliMode());
        }
        if (isset($this->xmlResponse)) {
            $debugInfo .= $this->debugSection('XML Response', \RocketShipIt\xmlPrettyPrint($this->xmlResponse), $this->isCliMode());
        } else {
            $debugInfo .= $this->debugSection('XML Response', 'xmlResponse was not set', $this->isCliMode());
        }
        $helper = new \RocketShipIt\Helper\General;
        $debugInfo .= $this->debugSection('Set Parameters', $helper->jsonPrettyPrint($this->jsonEncodeParameters()), $this->isCliMode());
        $debugInfo .= $this->debugSection('PHP Information', 'Version: '. phpversion(), $this->isCliMode());
        if (isset($this->curlReturned)) {
            $debugInfo .= $this->debugSection('cURL Return Information', $this->curlReturned, $this->isCliMode());
        }
        $debugInfo .= '</pre>';
        return $debugInfo;
    }

    public function saveResponse($xmlResponse)
    {
        $random = substr(md5(rand()),0,7);
        $filename = $random. '.xml';
        $fh = fopen($filename, 'w');
        fwrite($fh, $xmlResponse);
        fclose($fh);
        return true;
    }

    public function setTestingMode($bool)
    {
        if (!$bool) {
            // Production mode
            $this->debugMode = false;
            $this->url = $this->productionUrl;
            return;
        }

        $this->debugMode = true;
        $this->url = $this->testingUrl;
    }
}
