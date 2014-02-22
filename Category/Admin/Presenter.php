<?php

namespace WebEdit\Shop\Category\Admin;

use WebEdit\Shop;

final class Presenter extends Shop\Admin\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Category\Repository
     */
    public $repository;
    private $category;
    private $categories;

    /**
     * @inject
     * @var \WebEdit\Shop\Category\Form\Factory
     */
    public $formFactory;

    public function renderAdd() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('shop.category.admin.add');
    }

    public function actionEdit($id) {
        $this->category = $this->repository->getCategory($id);
        if (!$this->category) {
            $this->error();
        }
    }

    public function renderEdit() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('shop.category.admin.edit', NULL, ['category' => $this->category->menu->title]);
        $this->template->category = $this->category;
    }

    public function actionView() {
        $this->categories = $this->repository->getAllCategories();
    }

    public function renderView() {
        $this->template->categories = $this->categories;
    }

    protected function createComponentCategoryFormAdd() {
        return $this->formFactory->create();
    }

    protected function createComponentCategoryFormEdit() {
        return $this->formFactory->create($this->category);
    }

}
