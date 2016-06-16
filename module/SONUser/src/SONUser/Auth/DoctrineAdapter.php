<?php

/**
 * Created by PhpStorm.
 * User: nelson
 * Date: 25-04-2016
 * Time: 21:00
 */

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;

use Doctrine\ORM\EntityManager;

class DoctrineAdapter implements AdapterInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;
    protected $username;
    protected $password;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function authenticate()
    {
        $repository = $this->em->getRepository('SONUser\Entity\User');
        $user = $repository->findOneBy(array('username' =>$this->getUsername(), 'password' => $this->getPassword()));

        if($user) {
            return new Result(Result::SUCCESS, array('user' =>$user), array('OK'));
        }else {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());
        }
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


}