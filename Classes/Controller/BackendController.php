<?php
namespace Mopolo\Products\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Nathan Boiron <nathan.boiron@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use Mopolo\Products\Domain\Model\Product;
use Mopolo\Products\Domain\Repository\ProductRepository;
use Mopolo\Products\Support\ProductHelper;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * ProductController
 */
class BackendController extends ActionController
{

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    public function injectProductRepository(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $products = $this->productRepository->findAll();
        $this->view->assign('products', $products);
    }

    /**
     * action show
     *
     * @param Product $product
     * @return void
     */
    public function showAction(Product $product)
    {
        $this->view->assign('product', $product);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {

    }

    /**
     * action create
     *
     * @param Product $newProduct
     * @return void
     */
    public function createAction(Product $newProduct)
    {
        if (!ProductHelper::getBackendUser()->check('modules', 'products')) {
            $this->redirect('list');
        }

        $this->addFlashMessage('Le produit a bien été ajouté !', '', AbstractMessage::INFO);
        $this->productRepository->add($newProduct);
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param Product $product
     * @ignorevalidation $product
     * @return void
     */
    public function editAction(Product $product)
    {
        $this->view->assign('product', $product);
    }

    /**
     * action update
     *
     * @param Product $product
     * @return void
     */
    public function updateAction(Product $product)
    {
        if (!ProductHelper::getBackendUser()->check('modules', 'products')) {
            $this->redirect('list');
        }

        $this->addFlashMessage('Le produit a bien été mis à jour', '', AbstractMessage::INFO);
        $this->productRepository->update($product);
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param Product $product
     * @return void
     */
    public function deleteAction(Product $product)
    {
        if (!ProductHelper::getBackendUser()->check('modules', 'products')) {
            $this->redirect('list');
        }

        $this->addFlashMessage('Le produit a bien été supprimé', '', AbstractMessage::ERROR);
        $this->productRepository->remove($product);
        $this->redirect('list');
    }

}
