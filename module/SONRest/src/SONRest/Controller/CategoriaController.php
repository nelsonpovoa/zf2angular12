<?php

/**
 * Created by PhpStorm.
 * User: nelson
 * Date: 27-04-2016
 * Time: 20:27
 */

namespace SONRest\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class CategoriaController extends AbstractRestfulController
{
    public function getList(){
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $data = $em->getRepository('Application\Entity\Categoria')->findAll();

        // devolve atraves de eventos configurado no module.php
        return $data;
        //echo 1;die;
        //print_r($data); die;
        //$data = array('key' => 'ola');
        //return new JsonModel($data);




/*
        $service = $this->getServiceLocator()->get('SONRest\Service\ProcessJson');
        $service->setResponse($this->response);
        $service->setData($data);
        $this->response = $service->process();
*/







/*
        $serializer = $this->getServiceLocator()->get('jms_serializer.serializer');
        $result = $serializer->serialize($data, 'json');
        //return new JsonModel($result);
        $this->response->setContent($result);

        $headers = $this->response->getHeaders();
        $headers->addHeaderLine('Content-type', 'application/json');
        $this->response->setHeaders($headers);
*/


        //return $this->response;
    }

    // get
    public function get($id){
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $data = $em->getRepository('Application\Entity\Categoria')->find($id);

        return $data;
    }

    // post
    public function create($data){
        $serviceCategoria = $this->getServiceLocator()->get('Application\Service\Categoria');

        $nome = $data['nome'];

        $categoria = $serviceCategoria->insert($nome);
        if($categoria) {
            return $categoria;
        } else {
            return array('success'=>false);
        }

    }

    // put
    public function update($id, $data){
        $serviceCategoria = $this->getServiceLocator()->get('Application\Service\Categoria');

        $param['id'] = $id;
        $param['nome'] = $data['nome'];

        $categoria = $serviceCategoria->update($param);
        if($categoria) {
            return $categoria;
        } else {
            return array('success'=>false);
        }
    }

    // delete
    public function delete($id){
        $serviceCategoria = $this->getServiceLocator()->get('Application\Service\Categoria');
         $result = $serviceCategoria->delete($id);
         if($result) return $result;
    }
}

