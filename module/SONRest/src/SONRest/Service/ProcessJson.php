<?php

/**
 * Created by PhpStorm.
 * User: nelson
 * Date: 27-04-2016
 * Time: 22:45
 */

namespace SONRest\Service;

use Zend\Http\Response;

class ProcessJson
{

    private $response;
    private $data;
    private $serializer;

    public function __construct (\Zend\Http\Response $response = null, $data = null, $serializer = null){
        $this->response = $response;
        $this->data = $data;
        $this->serializer = $serializer;
    }

    public function process(){
        $serializer = $this->serializer;
        $result = $serializer->serialize($this->data, 'json');
        //return new JsonModel($result);
        $this->response->setContent($result);

        $headers = $this->response->getHeaders();
        $headers->addHeaderLine('Content-type', 'application/json');
        $this->response->setHeaders($headers);

        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @param mixed $serializer
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;
    }




}