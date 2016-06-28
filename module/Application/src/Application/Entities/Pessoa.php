<?php
/**
 * Created by PhpStorm.
 * User: nelson
 * Date: 19-06-2016
 * Time: 22:46
 */


namespace Application\Entities;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

require_once '../../../../../vendor/autoload.php';


interface PessoaInterface {

    public function getNome();
}

class Pessoa implements PessoaInterface
{
    public function getNome()
    {
        // TODO: Implement getNome() method.
        return "Nome";
    }

}

class Joao extends Pessoa {

}

interface RodaInterface{

}

class Roda14 implements RodaInterface{

}

class Roda15 implements RodaInterface {

}

class Carro {

    private $roda;

    /* public function __construct(Roda $roda){
        $this->roda = $roda;
    }*/

    public function __construct()
    {
        $this->roda = new Roda14();
    }

    public function inserePessoa(PessoaInterface $pessoa){

    }

}

class CarroFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // TODO: Implement createService() method.
        $pessoa = $serviceLocator->get("ServiceJoao");
        $carro = new Carro($serviceLocator->get("Roda14"));
        $carro->inserePessoa($pessoa);
        return $carro;
    }

}



// DI - dependence injection
//$carro = new Carro(new Roda14(new Parafuso(), new MaterialRoda()), new Pessoa());

// Service - simples
$serviceManager = new ServiceManager();
$serviceManager->setService("Config", [
    'nome' => 'Nelson',
    'conta' => 1234
]);

$config = $serviceManager->get('Config');

print_r($config);

// Invokable
$serviceManager->setInvokableClass('ServiceJoao', 'Joao');
//print_r($serviceManager->get('ServiceJoao'));

$serviceManager->setInvokableClass('Roda14', 'Roda14');
$serviceManager->setInvokableClass('Roda15', 'Roda15');
// Factory

$serviceManager->setFactory('Carro', function ($sm){
    //$carro = new Carro(new Roda15());
    //return $carro;

    return new Carro($sm->get('Roda15'));
});

$serviceManager->setFactory('Carro15', function ($sm){
    return new Carro($sm->get('Roda15'));
});

//print_r($serviceManager->get('Carro15'));

$serviceManager->setFactory('Carro14', function ($sm){
    $pessoa = $sm->get("ServiceJoao");
    $carro = new Carro($sm->get("Roda14"));
    $carro->inserePessoa($pessoa);
    return $carro;
});


//print_r($serviceManager->get('Carro14'));


print_r($serviceManager->get('Carro14', 'CarroFactory'));
