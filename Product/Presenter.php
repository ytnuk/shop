<?php

namespace WebEdit\Shop\Product;

use WebEdit\Shop;
use WebEdit\Shop\Product;
use WebEdit\Gallery;

final class Presenter extends Shop\Presenter {

    /**
     * @inject
     * @var Product\Repository
     */
    public $repository;
    private $product;

    /**
     * @inject
     * @var Gallery\Control\Factory
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
