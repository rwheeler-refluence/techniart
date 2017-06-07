<?php

namespace RocketShipIt;

class Request
{
    public $statusCode;
    public $url;
    public $header;
    public $response;
    var $ch;
    var $curlInfo;
    var $username;
    var $password;
    var $payload;
    var $error;

    public function __construct()
    {
        $this->statusCode = 0;
        $this->ch = curl_init();
        $this->curlInfo = array();

        // Set curl options
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
    }

    public function doPostRequest()
    {
        if ($this->payload != '') {
            curl_setopt($this->ch, CURLOPT_POST, 1);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->payload);
        }
        $this->doRequest();
    }

    public function doRequest()
    {
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        if ($this->username != '' and $this->password != '') {
            curl_setopt($this->ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);
        }
        if ($this->header) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->header);
        }
        $this->response = curl_exec($this->ch);
        $this->curlInfo = curl_getinfo($this->ch);
        $this->error = curl_error($this->ch);
        curl_close($this->ch);
    }

    public function post()
    {
        $this->doPostRequest();
    }

    public function get()
    {
        $this->doRequest();
    }

    public function getCurl()
    {
        return $this->ch;
    }

    public function getInfo()
    {
        return $this->curlInfo;
    }

    public function setCurlOption($option, $value)
    {
        curl_setopt($this->ch, $option, $value);
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getStatusCode()
    {
        if (!empty($this->curlInfo)) {
            return $this->curlInfo['http_code'];
        }
        return $this->statusCode;
    }

    public function getError()
    {
        return $this->error; 
    }
}
