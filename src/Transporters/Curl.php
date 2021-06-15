<?php
/** @noinspection PhpMultipleClassDeclarationsInspection */
/** @noinspection SpellCheckingInspection */
namespace PlaygroundStudio\BlackBridge\Transporters;

use PlaygroundStudio\BlackBridge\Element;

class Curl extends Element
{
    private $headers = array();
    private $curl;
    private $url;

    public $error = [];

    public function __construct($url)
    {
        $this->init($url);
        $this->withReturn();
    }

    public function init($url)
    {
        $this->url = $url;
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
    }

    public function withParams($params)
    {
        curl_setopt($this->curl, CURLOPT_URL, $this->url.'?'.http_build_query($params));
        return $this;
    }

    public function withBearerToken($bearer_token)
    {
        $this->headers[] = 'Authorization: Bearer ' . $bearer_token;
        return $this;
    }

    public function withReturn()
    {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        return $this;
    }

    public function withoutReturn()
    {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, false);
        return $this;
    }

    public function withoutSSLVerify()
    {
        $this->withCustomOption(CURLOPT_SSL_VERIFYHOST, false);
        $this->withCustomOption(CURLOPT_SSL_VERIFYPEER, false);
        return $this;
    }

    public function withCustomOption($option, $value)
    {
        curl_setopt($this->curl, $option, $value);
        return $this;
    }

    public function get()
    {
        curl_setopt($this->curl, CURLOPT_POST, false);
        return $this->exec();
    }

    public function getJSON($assoc = FALSE)
    {
        curl_setopt($this->curl, CURLOPT_POST, false);
        return json_decode($this->exec(), $assoc);
    }

    public function post($data = array())
    {
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
        return $this->exec();
    }

    public function postJSON($data = array())
    {
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $raw_response = $this->exec();
        return json_decode($raw_response);
    }

    private function exec()
    {
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->headers);
        $output = curl_exec ($this->curl); // execute
        $this->error = curl_error($this->curl);
        curl_close ($this->curl); // close curl handle

        return $output;
    }
}