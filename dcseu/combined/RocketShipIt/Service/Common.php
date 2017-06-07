<?php

namespace RocketShipIt\Service;

class Common {

    public $status;
    public $responseArray;
    var $OKparams;
    var $carrier; // Set variable for carrier
    var $inherited;

    function __construct($carrier)
    {
        $this->OKparams = \RocketShipIt\getOKparams(strtoupper($carrier));
        $this->carrier = strtoupper($carrier);

        $className = '\RocketShipIt\Carrier\\'. $carrier;
        $this->core = new $className();

        foreach ($this->OKparams as $param) {
            $this->setParameter($param, '');
        }

        $this->status = 'unknown';
        $this->responseArray = array();
    }

    // In order to allow users to override defaults or specify obsecure UPS
    // data, this function allows you to set any of the variables that this class uses
    function setParameter($param,$value)
    {
        $value = \RocketShipIt\getParameter($param, $value, $this->carrier);
        $this->{$param} = $value;
        $this->core->{$param} = $value;
    }
}
