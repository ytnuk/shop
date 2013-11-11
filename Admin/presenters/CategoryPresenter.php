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

    public function renderAdd() {
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.category_add'), 'Category:add');
    }

    public function actionEdit($id) {
        $this->category = $this->categoryFacade->repository->getCategory($id);
        if (!$this->category) {
            throw new BadRequestException;
        }
    }

    public function renderEdit() {
        $this->menu->breadcrumbAdd(
                $this->translator->translate('shop.admin.category_edit', NULL, ['category' => $this->category->node->title]), 'Category:edit', $this->category->id);
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
