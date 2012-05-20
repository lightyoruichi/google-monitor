<?php

namespace Seo\Component\Google;

use Symfony\Component\DomCrawler\Crawler;
use Seo\Component\Browser\Browser;

class Google
{
    /**
     * @var array
     */
    protected $results;

    protected $phrase;

    /**
     * @var \Symfony\Component\BrowserKit\Response $response
     */
    protected $response;

    public function __construct($phrase)
    {
        $this->phrase = $phrase;
        $this->results = array();
        $this->request();
    }

    protected function request()
    {
        $b = new Browser();
        $b->request('GET','http://www.google.com/search?ie=UTF-8&oe=UTF-8&q='.urlencode($this->phrase));
        $this->response = $b->getResponse();
    }

    public function getResults()
    {
        if(!empty($this->results)) {
            return $this->results;
        }

        $dom = new Crawler($this->response->getContent());

        $dom = $dom->filter('li.g');

        $links = array();

        $dom->rewind();
        while($dom->valid()) {
            $current = $dom->current();

            $inner = new Crawler($current);

            $links[] = array(
                'title' => $inner->filter('h3.r')->text(),
                'url'   => $inner->filter('.f cite')->text(),
                'descr' => $inner->filter('span.st')->text()
            );

            $dom->next();
        }

        $this->results = $links;

        return $this->results;
    }

}
