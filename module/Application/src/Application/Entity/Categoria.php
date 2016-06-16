<?php
/**
 * Created by PhpStorm.
 * User: nelson
 * Date: 12-04-2016
 * Time: 19:34
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Categoria
 * @package Application\Entity
 * @ORM\Entity // (repositoryClass="Application\Entity\CategoriaRepository")
 * @ORM\Table(name="categorias")
 */

class Categoria {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nome;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}

