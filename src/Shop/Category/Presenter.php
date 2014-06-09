<?php

namespace WebEdit\Shop\Category;

use WebEdit\Shop;
use WebEdit\Shop\Category;
use WebEdit\Shop\Product;

final class Presenter extends Shop\Presenter {

    /**
     * @inject
     * @var Category\Repository
     */
    public $repository;
    private $category;

    /**
     * @inject
     * @var Product\Control\Factory
     */
    public $productControlFactory;

    public function actionView($id) {
        $this->category = $this->repository->getCategory($id);
        if (!$this->category) {
            $this->error();
        }
    }

    public function renderView() {
        $this['menu']->setEntity($this->category->menu);
        $this->template->category = $this->category;
    }

    protected function createComponentProduct() {
        return $this->productControlFactory->create($this->category);
    }

}
