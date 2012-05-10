<?php

namespace Seo\Component\Browser;

class Curl
{
    /**
     * curl resource
     * @var resource
     */
    private $curl;

    private $response;

    /**
     * Instance of the class
     * @var Curl
     */
    static private $instance;

    /**
     * Constructor. Initiates curl connection and sets the header
     */
    final private function __construct()
    {
        $this->curl = curl_init();

        $header = array();

        curl_setopt($this->curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:5.0) Gecko/20100101 Firefox/5.02011-10-16 20:21:42');
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($this->curl, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($this->curl, CURLOPT_REFERER, "http://www.google.com/");
        curl_setopt($this->curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
    }

    /**
     * Destructor, closing curl connection
     */
    public function __destruct()
    {
        curl_close($this->curl);
    }

    /**
     * Destroy Browser Instance.
     * Free some memory people!
     */
    public static function destroy()
    {
        unset(self::$instance);
    }

    /**
     * Return an instance of the class
     * @return Curl
     */
    public static function getInstance()
    {
        return is_null(self::$instance) ? self::$instance = new Curl() : self::$instance;
    }

    public function request($url, $timeout = 10)
    {
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($this->curl, CURLOPT_URL, $url);

        $this->response = curl_exec($this->curl);

        if (curl_errno($this->curl) != 0) {
            return false;
        }

        return true;
    }

    public function getLastResponse()
    {
        return $this->response;
    }

    public function getLastErrorNo()
    {
        return curl_errno($this->curl);
    }

    public function getLastError()
    {
        return curl_error($this->curl);
    }

}