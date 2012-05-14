<?php

namespace Seo\Component\Browser;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\BrowserKit\History;
use Symfony\Component\BrowserKit\CookieJar;

/**
 * Web Browser
 *
 * @version 1.5
 * @author Wojciech Tekiela
 */
class Browser extends Client
{

    /**
     * @var Curl $curl
     */
    private $curl;

    public function __construct(array $server = array(), History $history = null, CookieJar $cookieJar = null)
    {
        parent::__construct($server, $history, $cookieJar);
        $this->curl = Curl::getInstance();
    }

    /**
     * Makes a request.
     *
     * @param Request $request A Request instance
     *
     * @return Response A Response instance
     */
    protected function doRequest($request)
    {
        $this->curl->request($request->getUri());
        return new Response($this->curl->getLastResponse());
    }

}