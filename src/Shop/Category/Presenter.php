<?php

namespace WebEdit\Shop\Category;

use WebEdit\Application;
use WebEdit\Shop\Category;

final class Presenter extends Application\Front\Presenter {

    private $repository;
    private $control;
    private $category;

    public function __construct(Category\Repository $repository, Category\Control\Factory $control) {
        $this->repository = $repository;
        $this->control = $control;
    }

    public function actionView($id) {
        $this->category = $this->repository->getCategory($id);
        if (!$this->category) {
            $this->error();
        }
        $this['category']->setEntity($this->category);
    }

    public function renderView() {
        $this['menu']->setEntity($this->category->menu);
    }

    protected function createComponentCategory() {
        return $this->control->create();
    }

}
