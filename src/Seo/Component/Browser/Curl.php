<?php

namespace Seo\Component\Browser;

class Curl
{
    /**
     * Instance of the class
     * @var Curl
     */
    static private $instance;



    /**
     * Return an instance of the class
     * @return Curl
     */
    public static function getInstance()
    {
        return is_null(self::$instance) ? self::$instance = new Curl() : self::$instance;
    }

    /**
     * Destroy Curl instance for more memory
     */
    public static function destroy()
    {
        unset(self::$instance);
    }



    /**
     * curl resource
     * @var resource
     */
    private $curl;

    /**
     * curl response cache
     * @var string
     */
    private $response;



    /**
     * Constructor. Initiates curl connection and sets the header
     */
    final private function __construct()
    {
        $this->curl = curl_init();

        curl_setopt($this->curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:5.0) Gecko/20100101 Firefox/5.02011-10-16 20:21:42');
        curl_setopt($this->curl, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($this->curl, CURLOPT_REFERER, "http://www.google.com/");
        curl_setopt($this->curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Destructor, closing curl connection
     */
    public function __destruct()
    {
        curl_close($this->curl);
    }

    /**
     * Make a request
     * @param $url
     * @param int $timeout
     * @return bool
     */
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

    /**
     * Return last curl response
     * @return mixed
     */
    public function getLastResponse()
    {
        return $this->response;
    }

    /**
     * Return last curl error no
     * @return int
     */
    public function getLastErrorNo()
    {
        return curl_errno($this->curl);
    }

    /**
     * Return last curl error
     * @return string
     */
    public function getLastError()
    {
        return curl_error($this->curl);
    }

}