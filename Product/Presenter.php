<?php

namespace WebEdit\Shop\Product;

use WebEdit\Shop;

final class Presenter extends Shop\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Repository
     */
    public $repository;
    private $product;

    /**
     * @inject
     * @var \WebEdit\Gallery\Control\Factory
     */
    public $galleryControlFactory;

    public function actionView($id) {
        $this->product = $this->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
    }

    public function renderView() {
        $this['menu']['breadcrumb'][] = $this->product->menu;
        $this['menu']['breadcrumb'][] = $this->product->title;
        $this->template->product = $this->product;
    }

    protected function createComponentGallery() {
        return $this->galleryControlFactory->create($this->product->gallery);
    }

}
