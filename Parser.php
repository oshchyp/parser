<?php
/**
 * Created by PhpStorm.
 * User: programmer_5
 * Date: 18.09.2018
 * Time: 15:17
 */

namespace oshchyp\parser;

use Curl\Curl;
use Sunra\PhpSimple\HtmlDomParser;

class Parser
{

    public $url;

    public $pageContent;

    private $_curlObject;

    private $_pageObject;

    public function __construct(array $config = [])
    {
        foreach ($config as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->$attribute = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


    /**
     * @return Curl
     * @throws \ErrorException
     */
    public function getCurlObject()
    {
        if ($this->_curlObject===null){
            $this->_curlObject = new Curl();
        }
        return $this->_curlObject;
    }

    /**
     * @param mixed $curlObject
     */
    public function setCurlObject($curlObject)
    {
        $this->_curlObject = $curlObject;
    }

    /**
     * @return \simplehtmldom_1_5\simple_html_dom
     * @throws \ErrorException
     */
    public function getPageObject()
    {
        if ($this->_pageObject === null){
            $this->_pageObject = HtmlDomParser::str_get_html($this->getPageContent());
        }
        return $this->_pageObject;
    }

    /**
     * @param mixed $pageObject
     */
    public function setPageObject($pageObject)
    {
        $this->_pageObject = $pageObject;
    }

    /**
     * @return null
     * @throws \ErrorException
     */
    public function getPageContent()
    {
        if ($this->pageContent === null){
            $this->pageContent = $this->getCurlObject()->response;
        }
        return $this->pageContent;
    }

    /**
     * @param mixed $pageContent
     */
    public function setPageContent($pageContent)
    {
        $this->pageContent = $pageContent;
    }

    private function _curlInit(){
        $this->curlInit();
    }

    public function curlInit(){
        $this->getCurlObject()->get($this->getUrl());
    }

    public function parse()
    {
        $this->_curlInit();
        $methods = get_class_methods($this);
        foreach ($methods as $v) {
            if (strstr($v, 'parsing')) {
                $this->$v();
            }
        }
        return $this;
    }

    public static function getInstance(array $config=[])
    {
        return new static($config);
    }



}