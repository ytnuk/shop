<?php

namespace CMS\Shop\Presenter;

use CMS\Shop\Presenter\Base;

final class Product extends Base {

    /**
     * @inject
     * @var \CMS\Shop\Product\Model\Facade
     */
    public $productFacade;
    private $product;

    public function actionView($id) {
        $this->product = $this->productFacade->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
        $this->menu->setActive($this->product->node);
    }

    public function renderView() {
        $this->menu->breadcrumbAdd($this->product->title);
        $this->template->product = $this->product;
    }

}
