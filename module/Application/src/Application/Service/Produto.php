<?php

/**
 * Created by PhpStorm.
 * User: nelson
 * Date: 13-04-2016
 * Time: 14:07
 */

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Produto as ProdutoEntity;

class Produto
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(array $data){
        $categoriaEntity = $this->em->getReference('Application\Entity\Categoria', $data['categoriaId']);

        $produto = new ProdutoEntity;
        $produto->setNome($data['nome']);
            $produto->setDescricao('Super maquina');
            $produto->setCategoria($categoriaEntity);

        $this->em->persist($produto);
        $this->em->flush();

        return $produto;
    }

    public function update(array $data){
        // $categoriaEntity = $this->em->getRepository('Application\Entity\Categoria')
        //     ->find($data{'id'});

        $categoriaEntity = $this->em->getReference('Application\Entity\Categoria', $data['categoriaId']);

        $produto = $this->em->getReference('Application\Entity\Produto', $data['id']);
        $produto->setNome($data['nome'])
            ->setDescricao($data['descricao'])
            ->setCategoria($categoriaEntity);

        $this->em->persist($produto);
        $this->em->flush();

        return $produto;
    }

    public function delete($id){
        $produto = $this->em->getReference('Application\Entity\Produto', $id);

        $this->em->remove($produto);
        $this->em->flush();

        return $id;
    }
}