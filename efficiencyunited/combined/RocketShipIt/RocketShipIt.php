<?php
/**
 * Copyright RocketShipIt LLC All Rights Reserved
 * Author: Mark Sanborn
 * Version: 1.2.5.8
 * PHP Version 5
 * For Support email: support@rocketship.it
**/

namespace RocketShipIt;

require "ThirdParty/QueryPath.php";

// RocketShipIt Config
if (getenv('RS_CUSTOM_CONFIG_PATH')) {
    include_once getenv('RS_CUSTOM_CONFIG_PATH'). '/config.php';
} else {
    include_once dirname(__FILE__). '/../config.php';
}

define('RocketShipIt\VERSION', '1.2.5.8');

/**
* Ensures that only settable paramaters are allowed.
*
* This function aids the setPramater() function in that it only
* allows known paramaters to be set.  This helps to avoid typos when
* setting parameters.
*
* @param string $carrier name of carrier i.e. ups
* @return array $okparams array of all available params for given carrier
*/
function getOKparams($carrier)
{
    $parameters = json_decode(file_get_contents(dirname(__FILE__). '/Resources/parameters.json'), true);

    // Force fedex, FedEx, FEDEX to all read the same
    $carrier = strtoupper($carrier);

    // Generic parameters that are accessible in each class regardless of carrier
    $generic = $parameters['generic'];

    if (!validateCarrier($carrier)) {
        return $generic;
    }

    return array_merge($generic, $parameters[$carrier]);
}

/**
* Gets defaults
*
* This function will grab defaults from config.php
*/
function getParameter($param, $value, $carrier)
{
    // Force fedex, FedEx, FEDEX to all read the same
    $carrier = strtoupper($carrier);

    // If the default is not in the getOKparams function an exception is thrown
    //if (!in_array($param, rocketshipit_getOKparams($carrier)) && $param != '') {
    //    throw new RuntimeException("Invalid parameter '$param' in setParameter");
    //}

    if ($value === "") { // get the default, if set
        $value = getGenericDefault($param);
        if ($value === "") { // not in the generics? look in the specific carrier params
            switch ($carrier) {
                case "UPS":
                    $value = getUPSDefault($param);
                    break;
                case "USPS":
                    $value = getUSPSDefault($param);
                    break;
                case "FEDEX":
                    $value = getFEDEXDefault($param);
                    break;
                case "STAMPS":
                    $value = getSTAMPSDefault($param);
                    break;
                case "DHL":
                    $value = getDHLDefault($param);
                    break;
                case "CANADA":
                    $value = getCANADADefault($param);
                    break;
                case "PUROLATOR":
                    $value = getPUROLATORDefault($param);
                    break;
            }
        }
    }
    return $value;
}

function limitParameterSize($param, $value, $carrier)
{
    // Force fedex, FedEx, FEDEX to all read the same
    $carrier = strtoupper($carrier);

    $sizeLimits = array();
    $sizeLimits['UPS']['shipper'] = 35;

    if (isset($sizeLimits[$carrier][$param])) {
        return substr($value, 0, $sizeLimits[$carrier][$param]);
    }
    return $value;
}

/**
* Validates carrier name
*
* This function will return true when given a proper
* carier name.
*/
function validateCarrier($carrier)
{
    switch (strtoupper($carrier)) {
        case "UPS":
            return true;
        case "FEDEX":
            return true;
        case "USPS":
            return true;
        case "STAMPS":
            return true;
        case "DHL":
            return true;
        case "CANADA":
            return true;
        case "PUROLATOR":
            return true;
    }
}

/**
* Create html code for base64 embedded image
*
* This function will return valid html for an
* embedded base64 image.  This html does not
* work in all browsers.
*/
function label_html($base64EncodedLabel, $imageType)
{
    return sprintf('<img src="data:image/%s;base64,%s" alt="Label" />',
        $imageType,
        $base64EncodedLabel
    );
}

function xmlPrettyPrint($xml, $tryAgain=false)
{
    if (empty($xml)) {
        return $xml;
    }
    $originalXml = $xml;

    if ($tryAgain) {
        $xml = preg_replace('/<\?xml .*\?>/', '', $xml);
        $xml = '<root>'. $xml. '</root>';
    }
    $previous_value = libxml_use_internal_errors(true);
    $doc = new \DOMDocument();
    $doc->strictErrorChecking = false;
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput   = true;
    $status = $doc->loadXML($xml, LIBXML_NOWARNING);
    $formatted_xml = $doc->saveXML();
    libxml_clear_errors();
    libxml_use_internal_errors($previous_value);

    if ($status) {
        if ($tryAgain) {
            $formatted_xml = str_replace("<root>\n", '', $formatted_xml);
            $formatted_xml = str_replace("</root>\n", '', $formatted_xml);
            $formatted_xml = str_replace("<root>", '', $formatted_xml);
            $formatted_xml = str_replace("</root>", '', $formatted_xml);
        }
        return $formatted_xml;
    } else {
        if ($tryAgain == false) {
            return \RocketShipIt\xmlPrettyPrint($xml, true);
        }
        return $originalXml;
    }
}

function weightToLbsOunces($weight)
{
    list($lbs, $partialLb) = explode('.', "$weight.");
    $ounces =  round(($weight-floor($weight)) * 16, 0);
    return array((string)$lbs, (string)$ounces);
}


// Error if cURL is not present
if (!extension_loaded('curl')) {
    $errorMessage = 'The required php extension, cURL, was not found.';
    $errorMessage .= '  Please install the cURL module to continue using RocketShipIt.';
    exit($errorMessage);
}
