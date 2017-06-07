<?php

namespace RocketShipIt\Service\Rate;

use \RocketShipIt\Helper\XmlParser;
use \RocketShipIt\Helper\XmlBuilder;

/**
* Main Rate class for producing rates for various packages/shipments
*
* This class is a wrapper for use with all carriers to produce rates 
* Valid carriers are: UPS, USPS, and FedEx.
*/
class Usps extends \RocketShipIt\Service\Common
{
    var $packageCount;
    
    function __construct()
    {
        $classParts = explode('\\', __CLASS__);
        $carrier = end($classParts);
        parent::__construct($carrier);
    }

    public function simplifyUSPSRates($user_func)
    {
        $usps = $this->getAllUSPSRates();
        return $this->simplifyUSPSRatesXml($this->core->xmlResponse, $user_func);
    }


    function simplifyUSPSRatesXml($xml, $user_func=null)
    {
        if (count(qp($xml)->has('Error')) > 0) {
            $message = qp($xml)->find('Error Description')->text();
            return array('error' => (string) $message); 
        }

        $packages = qp($xml, 'Package');
        $rates = array();

        if (count(qp($xml)->has('IntlRateV2Response')) > 0) {
            foreach ($packages as $package) {
                foreach ($package->branch()->find('Service') as $postage) {
                    $service = $this->stripHtml($postage->branch()->find('SvcDescription')->text());
                    $rate = $postage->branch()->find('Postage')->text();
                    $service_code = $postage->attr('ID'); // International uses ID instead of CLASSID
                    if (!isset($rates[$service])) {
                        $simpleRate = array('desc' => $service, 'rate' => $rate, 'service_code' => $service_code);
                    } else {
                        $rates[$service]['rate'] += $rate;
                        $simpleRate = $rates[$service];
                    }
                    if (!empty($user_func)) {
                        $simpleRate = call_user_func($user_func, end(explode('\\', __CLASS__)), $postage, $simpleRate);
                    }
                    $rates[$service] = $simpleRate;
                }
            }
        } else {
            foreach ($packages as $package) {
                foreach ($package->branch()->find('Postage') as $postage) {
                    $service = $this->stripHtml($postage->branch()->find('MailService')->text());
                    $rate = $postage->branch()->find('Rate')->text();
                    $service_code = $postage->attr('CLASSID');
                    if (!isset($rates[$service])) {
                        $simpleRate = array('desc' => $service, 'rate' => $rate, 'service_code' => $service_code);
                    } else {
                        $simpleRate = $rates[$service];
                        $simpleRate['rate'] += $rate;
                    }
                    if (!empty($user_func)) {
                        $simpleRate = call_user_func($user_func, end(explode('\\', __CLASS__)), $postage, $simpleRate);
                    }
                    $rates[$service] = $simpleRate;
                }
            }
        }

        if (empty($rates)) {
            $xmlParser = new xmlParser($this->core->xmlResponse);
            $xmlArray = $xmlParser->xmlparser($this->core->xmlResponse);
            $xmlArray = $xmlParser->getData();
            return $xmlArray;
        }
        
        return array_values($rates);
    }

    function simplifyUSPSRate()
    {
        $usps = $this->getUSPSRate();
        if(!isset($usps['Error']) && !isset($usps['RateV4Response']['Package']['Error'])) {
            return $usps['RateV4Response']['Package']['Postage']['Rate'];
        } else {
            if (isset($usps['Error']['Description'])) {
                return $usps['Error']['Description'];
            } else {
                return $usps['RateV4Response']['Package']['Error']['Description'];
            }
        }
    }

    function getAllUSPSRates()
    {
        return $this->getUSPSRate(true);
    }

    function getUSPSRate($allAvailableRates=false)
    {
        if (!$this->isInternational($this->toCountry)) {
            $xmlString = $this->buildUSPSRateXml($allAvailableRates);
        } else {
            if ($allAvailableRates) {
                $xmlString = $this->buildUSPSInternationalRateXml($allAvailableRates);
            } else {
                exit("Please use getAllRates() for international USPS rate quotes");
            }
        }
        
        $this->core->request('ShippingAPI.dll', $xmlString);

        // Convert the xmlString to an array
        $xmlParser = new xmlParser($this->core->xmlResponse);
        $xmlArray = $xmlParser->xmlparser($this->core->xmlResponse);
        $xmlArray = $xmlParser->getData();
        return $xmlArray; 
    }

    function addPackageToUSPSShipment($package, $isInternational = false)
    {
        if (!isset($this->core->packagesObject)) {
            $this->core->packagesObject = new xmlBuilder(true);
        }

        $xml = $this->core->packagesObject;
        
        // Create package ID
        $packageId = NULL;
        switch(substr($this->packageCount, -1)) { 
            case 1: $packageId = $this->packageCount . "ST"; break;
            case 2: $packageId = $this->packageCount . "ND"; break;
            case 3: $packageId = $this->packageCount . "RD"; break;
            default: $packageId = $this->packageCount . "TH"; break;
        }
        
        if ($isInternational) {
            
            $country = (strlen($this->toCountry) == 2) 
                        ? $this->core->getCountryName($this->toCountry)
                        : $this->toCountry;
            
            // Assign options
            $options = array(
                'packageId'     => $packageId,
                'toCountry'     => $country,
        		'weightPounds'	=> $package->weightPounds,
            	'weightOunces'  => $package->weightOunces,
            	'weight'        => $package->weight,
                'packagingType' => $this->packagingType,
                'width'         => $package->width,
                'height'        => $package->height,
                'length'        => $package->length
            );
            $xml = $this->buildUSPSInternationalPackage($xml, $options);
        } else {
            $xml->push('Package',array('ID' => $packageId));
            $xml->element('Service',$this->service);
            if ($this->firstClassMailType != '') {
                $xml->element('FirstClassMailType',$package->firstClassMailType);
            }
            $xml->element('ZipOrigination',$this->shipCode);
            $xml->element('ZipDestination',$this->toCode);

            // Calculate weight in lbs and ounces based on weight parameter
            if ($package->weight != '') {
                $lbsAndOunces = \RocketShipIt\weightToLbsOunces($package->weight);
                $xml->element('Pounds',$lbsAndOunces[0]);
                $xml->element('Ounces',$lbsAndOunces[1]);
            } else {
                $xml->element('Pounds',(string)$package->weightPounds);
                $xml->element('Ounces',(string)$package->weightOunces);
            }

            if ($this->container != '') {
                $xml->element('Container', $package->container);
            } else {
                $xml->emptyelement('Container');
            }
            
            $girth = $this->length + ($this->height*2) + ($this->width*2);

            if($girth > 108) $xml->element('Size','OVERSIZE');
            else if($girth > 84) $xml->element('Size','LARGE');
            else $xml->element('Size','Regular');

            $xml->element('Width',$package->width);
            $xml->element('Length',$package->length);
            $xml->element('Height',$package->height);
            $xml->element('Girth', $girth);

            $xml->element('Machinable','false');
            $xml->pop(); // Close Package  
        }
        
        $this->core->packagesObject = $xml;
        return true;
    }
    
    function buildUSPSInternationalPackage($xml, $options)
    {
        $xml->push('Package',array('ID' => $options['packageId']));
            
            if ($options['weight'] != '') {
                $weight =  $options['weight'];
                $lbsAndOunces = \RocketShipIt\weightToLbsOunces($weight);
                $xml->element('Pounds',$lbsAndOunces[0]);
                $xml->element('Ounces',$lbsAndOunces[1]);
            } else {
                $xml->element('Pounds', $options['weightPounds']);
                $xml->element('Ounces', $options['weightOunces']);
            }
            
            if ($options['packagingType'] != '') {
                $xml->element('MailType', $options['packagingType']);
            } else {
                $xml->element('MailType', 'Package');
            }

            if ($options['insuredValue'] != '') {
                $xml->element('ValueOfContents', $options['insuredValue']);
            } else {
                $xml->emptyelement('ValueOfContents');
            }

            $xml->element('Country', $options['toCountry']);
            
            if ($options['container'] != '') {
                $xml->element('Container', $options['container']);
            } else {
                $xml->emptyelement('Container');
            }
            
            $girth = ($options['length'] * 2) + ($options['width'] * 2);

            if($options['length'] + $girth > 84) $xml->element('Size','LARGE');
            else $xml->element('Size','REGULAR');
            
            $xml->element('Width', (string)$options['width']);
            $xml->element('Length',(string)$options['length']);
            $xml->element('Height',(string)$options['height']);
            $xml->element('Girth', (string)$girth);
            
        $xml->pop(); // Close Package

        return $xml;
    }

    function buildUSPSRateXml($allAvailableRates=false)
    {
        $xml = $this->core->xmlObject;

        $xml->push('RateV4Request', array('USERID' => $this->userid));
            $xml->element('Revision', '2'); // Turns on added services
            if (!isset($this->core->packagesObject)) {
                $xml->push('Package',array('ID' => '1ST'));
                    if ($allAvailableRates) {
                        $xml->element('Service','ALL');
                    } else {
                        $xml->element('Service', $this->service);
                    }
                    if ($this->firstClassMailType != '') {
                        $xml->element('FirstClassMailType',$this->firstClassMailType);
                    }
                    $xml->element('ZipOrigination',$this->shipCode);
                    $xml->element('ZipDestination',$this->toCode);

                    // Calculate weight in lbs and ounces based on weight parameter
                    if ($this->weight != '') {
                        $lbsAndOunces = \RocketShipIt\weightToLbsOunces($this->weight);
                        $xml->element('Pounds',$lbsAndOunces[0]);
                        $xml->element('Ounces',$lbsAndOunces[1]);
                    } else {
                        $xml->element('Pounds',$this->weightPounds);
                        $xml->element('Ounces',$this->weightOunces);
                    }

                    if ($this->packagingType != '') {
                        $xml->element('Container', $this->container);
                    } else {
                        $xml->emptyelement('Container');
                    }
                    
                    $girth = ($this->height*2) + ($this->width*2);

                    if ($this->length + $girth > 84 && $this->length + $girth <= 108) {
                        $xml->element('Size','LARGE');
                    } elseif($this->length + $girth > 108 && $this->length + $girth <= 130) {
                        $xml->element('Size','OVERSIZE');
                    } else {
                        $xml->element('Size','REGULAR');
                    }

                    $xml->element('Width',$this->width);
                    $xml->element('Length',$this->length);
                    $xml->element('Height',$this->height);
                    $xml->element('Girth', $girth);

                    $xml->element('Machinable','false');
                $xml->pop(); // Close Package
                $xmlString = $xml->getXml();
            } else {
                $xmlString = $xml->getXml();
                $xmlString .= $this->core->packagesObject->getXml();
            }
            $xmlString .= '</RateV4Request>'."\n";

        return 'API=RateV4&XML='. $xmlString;
    }

    function buildUSPSInternationalRateXml($allAvailableRates=false)
    {
        $xmlString = "";
        
        $country = (strlen($this->toCountry) == 2) 
                        ? $this->core->getCountryName($this->toCountry)
                        : $this->toCountry;
        
        $xml = $this->core->xmlObject;
        $xml->push('IntlRateV2Request',array('USERID' => $this->userid));
            
            $xml->element('Revision','2');
            
            if (!isset($this->core->packagesObject)) {
                
                $options = array(
                    'packageId'     => '1ST',
                    'toCountry'     => $country,
            		'weightPounds'	=> $this->weightPounds,
                	'weightOunces'  => $this->weightOunces,
                	'weight'        => $this->weight,
                    'packagingType' => $this->packagingType,
                    'width'         => $this->width,
                    'height'        => $this->height,
                    'length'        => $this->length,
                    'container'     => $this->container,
                    'insuredValue'  => $this->insuredValue
                );
                $xml = $this->buildUSPSInternationalPackage($xml, $options);
                $xmlString = $xml->getXml();
                
            } else {
                $xmlString = $xml->getXml();
                $xmlString .= $this->core->packagesObject->getXml();
            }
        
        $xmlString .= '</IntlRateV2Request>'."\n";
        return 'API=IntlRateV2&XML='. $xmlString;        
    }

    // Checks the country to see if the request is International
    function isInternational($country)
    {
        if ($country == '' ||
            $country == 'US' ||
            $country == $this->core->getCountryName('US'))
        {
            return false;
        }
        return true;
    }

    function stripHtml($text)
    {
        $no_html = strip_tags(html_entity_decode($text, ENT_COMPAT, 'UTF-8'));
        // Strip html special chars
        $no_html = str_replace('&reg;', '', $no_html);
        //$noSpecialChars = preg_replace("/&#?[a-z0-9]{2,8};/i", "", $no_html);
        return preg_replace('/[^A-Za-z0-9\- ]/', '', $no_html);
    }
}
