<?php

namespace WebEdit\Shop\Category;

use WebEdit\Shop;

final class Presenter extends Shop\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Category\Model\Facade
     */
    public $categoryFacade;
    private $category;

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Control\Factory
     */
    public $productControlFactory;

    public function actionView($id) {
        $this->category = $this->categoryFacade->repository->getCategory($id);
        if (!$this->category) {
            $this->error();
        }
        $this->menu->breadcrumb->fromNode($this->category->node);
    }

    public function renderView() {
        $this->template->category = $this->category;
    }

    protected function createComponentProduct() {
        return $this->productControlFactory->create($this->category);
    }

}
