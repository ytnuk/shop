<?php

namespace WebEdit\Shop\Category\Admin;

use WebEdit\Shop;

final class Presenter extends Shop\Admin\Presenter {

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

    protected function startup() {
        parent::startup();
        $this->menu->setActive(':Shop:Category:Admin:Presenter:view');
    }

    public function renderAdd() {
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.category.admin.add'), 'Presenter:add');
    }

    public function actionEdit($id) {
        $this->category = $this->categoryFacade->repository->getCategory($id);
        if (!$this->category) {
            $this->error();
        }
    }

    public function renderEdit() {
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.category.admin.edit', NULL, ['category' => $this->category->node->title]), 'Presenter:edit', $this->category->id);
        $this->template->category = $this->category;
    }

    public function actionView() {
        $this->categories = $this->categoryFacade->repository->getAllCategories();
    }

    public function renderView() {
        $this->template->categories = $this->categories;
    }

    protected function createComponentCategoryFormAdd() {
        return $this->categoryFormFactory->create();
    }

    protected function createComponentCategoryFormEdit() {
        return $this->categoryFormFactory->create($this->category);
    }

}
