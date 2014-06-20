<?php

namespace WebEdit\Shop\Category\Admin;

use WebEdit\Application;
use WebEdit\Shop\Category;

final class Presenter extends Application\Admin\Presenter {

    private $repository;
    private $control;
    private $category;

    public function __construct(Category\Repository $repostory, Category\Control\Factory $control) {
        $this->repository = $repostory;
        $this->control = $control;
    }

    public function renderAdd() {
        $this['menu'][] = 'shop.category.admin.add';
    }

    public function actionEdit($id) {
        $this->category = $this->repository->getCategory($id);
        if (!$this->category) {
            $this->error();
        }
        $this['category']->setEntity($this->category);
    }

    public function renderEdit() {
        $this['menu'][] = 'shop.category.admin.edit';
    }

    protected function createComponentCategory() {
        return $this->control->create();
    }

}
