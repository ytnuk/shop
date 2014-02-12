<?php

namespace WebEdit\Shop\Product;

use WebEdit\Shop;

final class Presenter extends Shop\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Model\Facade
     */
    public $productFacade;
    private $product;

    public function actionView($id) {
        $this->product = $this->productFacade->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
        $this->menu->breadcrumb->fromMenu($this->product->menu);
    }

    public function renderView() {
        $this->menu->breadcrumb->append($this->product->title);
        $this->template->product = $this->product;
    }

}
