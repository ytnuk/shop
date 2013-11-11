<?php

namespace CMS\Admin\Shop;

use Nette\Application\BadRequestException;

final class ProductPresenter extends BasePresenter {

    /**
     * @inject
     * @var \CMS\Shop\Model\ProductFacade
     */
    public $productFacade;
    private $product;

    /**
     * @inject
     * @var \CMS\Shop\Form\ProductFormFactory
     */
    public $productFormFactory;

    public function renderAdd() {
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.product_add'), 'Product:add');
    }

    public function actionEdit($id) {
        $this->product = $this->productFacade->repository->getProduct($id);
        if (!$this->product) {
            throw new BadRequestException;
        }
    }

    public function renderEdit() {
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.product_edit', NULL, ['product' => $this->product->title]), 'Product:edit', $this->product->id);
    }

    protected function createComponentProductFormAdd() {
        return $this->productFormFactory->create();
    }

    protected function createComponentProductFormEdit() {
        return $this->productFormFactory->create($this->product);
    }

}
