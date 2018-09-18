<?php
/**
 * Created by PhpStorm.
 * User: programmer_5
 * Date: 18.09.2018
 * Time: 15:17
 */

namespace oshchyp\parser;

use Curl\Curl;

class Parser
{

    public $url;

    public $curlObject;

    public $pageObject;


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
        if ($this->curlObject===null){
            $this->curlObject = new Curl();
        }
        return $this->curlObject;
    }

    /**
     * @param mixed $curlObject
     */
    public function setCurlObject($curlObject)
    {
        $this->curlObject = $curlObject;
    }

    /**
     * @return mixed
     */
    public function getPageObject()
    {
        return $this->pageObject;
    }

    /**
     * @param mixed $pageObject
     */
    public function setPageObject($pageObject)
    {
        $this->pageObject = $pageObject;
    }

    public function curlInit(){

    }

    public static function getInstance(array $config=[])
    {
        return new static($config);
    }

}