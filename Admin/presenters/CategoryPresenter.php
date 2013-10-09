<?php

namespace CMS\Admin\Shop;

use Nette\Application\BadRequestException;

final class CategoryPresenter extends BasePresenter {

    /**
     * @inject
     * @var \CMS\Shop\Model\CategoryFacade
     */
    public $categoryFacade;
    private $category;
    private $categories;

    /**
     * @inject
     * @var \CMS\Shop\Form\CategoryFormFactory
     */
    public $categoryFormFactory;

    protected function beforeRender() {
        parent::beforeRender();
        $this->menu->breadcrumbAdd('Category list', 'Category:list');
    }

    public function renderAdd() {
        $this->menu->breadcrumbAdd('Add new category');
    }

    public function actionEdit($id) {
        $this->category = $this->categoryFacade->repository->getCategory($id);
        if (!$this->category) {
            throw new BadRequestException;
        }
    }

    public function renderEdit() {
        $this->menu->breadcrumbAdd('Edit category');
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
