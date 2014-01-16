<?php

namespace WebEdit\Shop\Admin\Presenter;

use WebEdit\Shop\Admin\Presenter\Base;

final class Category extends Base {

    /**
     * @inject
     * @var \WebEdit\Shop\Category\Model\Facade
     */
    public $categoryFacade;
    private $category;
    private $categories;

    /**
     * @inject
     * @var \WebEdit\Shop\Category\Form\Factory
     */
    public $categoryFormFactory;

    public function renderAdd() {
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.category.add'), 'Category:add');
    }

    public function actionEdit($id) {
        $this->category = $this->categoryFacade->repository->getCategory($id);
        if (!$this->category) {
            $this->error();
        }
    }

    public function renderEdit() {
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.category.edit', NULL, ['category' => $this->category->node->title]), 'Category:edit', $this->category->id);
        $this->template->category = $this->category;
    }

    public function actionList() {
        $this->categories = $this->categoryFacade->repository->getAllCategories();
    }

    public function renderList() {
        $this->template->categories = $this->categories;
    }

    protected function createComponentCategoryFormAdd() {
        return $this->categoryFormFactory->create();
    }

    protected function createComponentCategoryFormEdit() {
        return $this->categoryFormFactory->create($this->category);
    }

}
