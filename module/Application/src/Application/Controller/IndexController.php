<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Categoria;
use Application\Entity\Produto;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

        // getServiceLocator() faz parte do Zend e esta invocando service manager.
        // O get está invocar um servico
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        // getRepository vem do doctrine
        $repo = $em->getRepository("Application\Entity\Categoria");

        // insere uma nova categoria
        /*
        $categoria = new Categoria();
          $categoria->setNome('teste 3');
          $em->persist($categoria);  // preparar para gravar
          $em->flush(); // grava no banco
*/


        // inserção de produto associado a uma categoria
        /*
        $categoria = $repo->find(1);
        $produto = new Produto();

        // usa interface  fluente
        $produto->setNome("Game B")
        ->setDescricao("O game B é porreiro.")
        ->setCategoria($categoria);
        $em->persist($produto);
        $em->flush();
*/

        // insercao atraves de servico
        /* $categoriaService = $this->getServiceLocator()->get('Application\Service\Categoria');
        $categoriaService->insert('teste 4');
        */

        // atualizar nome
        /*$categoriaService = $this->getServiceLocator()->get('Application\Service\Categoria');
        $categoriaService->update(array('id' => 7, 'nome' => 'monitores 3'));
*/

        // inserir um produto
       /*  $produtoService = $this->getServiceLocator()->get('Application\Service\Produto');
        $produtoService->insert(array('nome' => 'Game C', 'categoriaId' =>1));
        */


        $categorias = $repo->findAll();

        return new ViewModel(array('categorias' => $categorias));
    }
}
