<?php

namespace Mopolo\Products\Controller;

use Mopolo\Products\Domain\Model\Product;
use Mopolo\Products\Domain\Repository\ProductRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ProductController extends ActionController
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var ConfigurationManagerInterface
     */
    protected $configurationManager;

    public function injectProductRepository(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param ConfigurationManagerInterface $configurationManager
     * @return void
     */
    public function injectConfigurationManager(ConfigurationManagerInterface $configurationManager) {
        $this->configurationManager = $configurationManager;
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $settings = $this->configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Products', 'frontend');

        $products = $this->productRepository->findAvailables($settings['minimumQuantityToBeAvailable']);
        $this->view->assign('products', $products);

        $this->view->assign('show_pid', $settings['showPageUid']);
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
}
