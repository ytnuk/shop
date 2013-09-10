<?php

namespace CMS\Admin\Shop;

use Nette\Application\BadRequestException;

final class CategoryPresenter extends BasePresenter {

    private $category;

    /**
     * @inject
     * @var \CMS\Admin\Shop\Form\CategoryFormFactory
     */
    public $categoryFormFactory;

    public function renderAdd() {
        $this->menu->breadcrumbAdd('Add new category');
    }

    public function actionEdit($id) {
        $this->category = $this->categoryRepository->getCategory($id);
        if (!$this->category) {
            throw new BadRequestException;
        }
    }

    public function renderEdit() {
        $this->menu->breadcrumbAdd('Edit category: ' . $this->category->node->title);
    }

    protected function createComponentCategoryFormAdd() {
        return $this->categoryFormFactory->create();
    }

    protected function createComponentCategoryFormEdit() {
        return $this->categoryFormFactory->create($this->category);
    }

}
