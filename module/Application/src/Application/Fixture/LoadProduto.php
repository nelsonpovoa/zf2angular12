<?php

/**
 * Created by PhpStorm.
 * User: nelson
 * Date: 27-04-2016
 * Time: 15:43
 */
namespace Application\Fixture;

use Doctrine\Common\DataFixtures\AbastractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\Entity\Produto;

class LoadProduto extends AbstractFixture implements OrderedFixtureInterface
{


    public function load(ObjectManager $manager) {

        $categoriaLivros = $this->getReference('categoria-livros');
        $categoriaComputadores = $this->getReference('categoria-computadores');

        $produto = new Produto();
        $produto->setNome("Orientação a objectos")
            ->setCategoria($categoriaLivros)
            ->setDescricao("Descricao do livro");
        $manager->persist($produto);


        $produto = new Produto();
        $produto->setNome("MacBook Pro")
            ->setCategoria($categoriaLivros)
            ->setDescricao("Descricao do computador");
        $manager->persist($produto);

        /*
        $categoria = new Categoria();
        $categoria->setNome("Livros");

        $manager->persist($categoria);

        $categoria2 = new Categoria();
        $categoria2->setNome("Computadores");

        $manager->persist($categoria2);

        */

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }


}