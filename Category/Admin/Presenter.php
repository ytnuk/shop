<?php

namespace WebEdit\Shop\Category\Admin;

use WebEdit\Shop;
use WebEdit\Shop\Category;

final class Presenter extends Shop\Admin\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Category\Repository
     */
    public $repository;

    /**
     * @inject
     * @var \WebEdit\Shop\Category\Facade
     */
    public $facade;
    private $category;
    private $categories;

    /**
     * @inject
     * @var \WebEdit\Shop\Category\Form\Factory
     */
    public $formFactory;

    public function actionAdd() {
        $this['form']->onSuccess[] = [$this, 'handleAdd'];
    }

    public function handleAdd($form) {
        $category = $this->facade->addCategory($form->getValues());
        $this->redirect('Presenter:edit', ['id' => $category->id]);
    }

    public function renderAdd() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('shop.category.admin.add');
    }

    public function actionEdit($id) {
        $this->category = $this->repository->getCategory($id);
        if (!$this->category) {
            $this->error();
        }
        $this['form']['category']->setDefaults($this->category);
        $this['form']['menu']->setDefaults($this->category->menu);
        $this['form']->onSuccess[] = [$this, 'handleEdit'];
    }

    public function handleEdit($form) {
        if ($form->submitted->name == 'delete') {
            try {
                $this->facade->deleteCategory($this->category);
            } catch (Category\Exception $ex) {
                $this->flashMessage($ex->getMessage(), 'warning');
                $this->redirect('this');
            }
            $this->redirect('Presenter:view');
        } else {
            $this->facade->editCategory($this->category, $form->getValues());
            $this->redirect('this');
        }
    }

    public function renderEdit() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('shop.category.admin.edit', NULL, ['category' => $this->category->menu->title]);
    }

    public function actionView() {
        $this->categories = $this->repository->getAllCategories();
    }

    public function renderView() {
        $this->template->categories = $this->categories;
    }

    protected function createComponentForm() {
        return $this->formFactory->create($this->category);
    }

}
