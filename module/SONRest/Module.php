<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SONRest;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e){
        $sharedEvents = $e->getApplication()->getEventManager()->getSharedManager();

        $sharedEvents->attach('Zend\Mvc\Controller\AbstractRestfulController', MvcEvent::EVENT_DISPATCH, array($this, 'postProcess'), -100);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }



    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'SONRest\Service\ProcessJson' => function($sm) {
                    $serializer = $sm->get('jms_serializer.serializer');
                    return new Service\ProcessJson(null, null, $serializer);

                }
            )
        );
    }

    public function postProcess(MvcEvent $e) {
        $processJson = $e->getTarget()->getServiceLocator()->get('SONRest\Service\ProcessJson');

        $data = $e->getResult();

        $response = new \Zend\Http\Response();

        $processJson->setResponse($response);
        $processJson->setData($data);

        return $processJson->process();
    }


}



