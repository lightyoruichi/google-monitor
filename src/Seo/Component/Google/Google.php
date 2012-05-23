<?php

namespace Seo\Component\Google;

use Symfony\Component\DomCrawler\Crawler;
use Seo\Component\Browser\Browser;

class Google
{
    protected $results;

    protected $phrase;

    protected $browser;

    /**
     * @var \Symfony\Component\BrowserKit\Response $response
     */
    protected $response;

    public function __construct($phrase, Browser $b)
    {
        $this->phrase = $phrase;
        $this->browser = $b;
        $this->results = array();

        $this->request();
    }

    protected function request()
    {
        $this->browser->request('GET', 'http://www.google.com/search?q=' . urlencode($this->phrase) . '&ie=UTF-8&oe=UTF-8');
        $this->response = $this->browser->getResponse();
    }

    protected function parseResponse()
    {
        $html = '<html><body><p class="message">Hello World!</p><p>Hello Crawler!</p></body></html>';

        $crawler = new Crawler($html);

        foreach ($crawler as $domElement) {
            print $domElement->nodeName;
        }

        die;

        $content = $this->response->getContent();

        $crawler = new Crawler();
        $crawler->addHtmlContent($content,'UTF-8');

        foreach ($crawler as $domElement) {
            print $domElement->nodeName;
        }
        die;

        $crawler->filter('li.g')->each(
            function($node) use (&$links)
            {
                $inner = new Crawler($node);
                //$map = $inner->filter('table.ts')->count() > 0 ? true : false;
                $links[] = array(
                    'title' => $inner->filter('h3.r')->text(),
                    'url' => $inner->filter('.f cite')->text(),
                    'descr' => $inner->filter('span.st')->text(),
                );
            }
        );

        $this->results = $links;
    }

    public function getResults()
    {
        // if already parsed, return results
        if (!empty($this->results)) {
            return $this->results;
        }
        // if not, parse the response and then return results
        $this->parseResponse();
        return $this->results;
    }

    public function getPlaces()
    {
        // @todo implement
    }

    public function getOrganic()
    {
        // @todo implement
    }

}
