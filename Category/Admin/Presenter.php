<?php

namespace WebEdit\Shop\Category\Admin;

use WebEdit\Shop;
use WebEdit\Menu;
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
    protected $entity;
    private $categories;

    /**
     * @inject
     * @var \WebEdit\Menu\Facade
     */
    public $menuFacade;

    public function actionAdd() {
        $this['form']['menu']['menu_id']->setItems($this->menuFacade->getChildren());
    }

    public function renderAdd() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('shop.category.admin.add');
    }

    public function actionEdit($id) {
        $this->entity = $this->repository->getCategory($id);
        if (!$this->entity) {
            $this->error();
        }
        $this['form']['shop_category']->setDefaults($this->entity);
        $this['form']['menu']['menu_id']->setItems($this->menuFacade->getChildren($this->entity->menu));
        $this['form']['menu']->setDefaults($this->entity->menu);
    }

    public function handleEdit($form) {
        try {
            parent::handleEdit($form);
        } catch (Category\Exception $ex) {
            $this->flashMessage($ex->getMessage(), 'warning');
            $this->redirect('this');
        }
    }

    public function renderEdit() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('shop.category.admin.edit', NULL, ['category' => $this->entity->menu->title]);
    }

    public function actionView() {
        $this->categories = $this->repository->getAllCategories();
    }

    public function renderView() {
        $this->template->categories = $this->categories;
    }

    protected function createComponentForm() {
        $form = $this->formFactory->create($this->entity);
        $form['menu'] = new Menu\Form\Container;
        $form['shop_category'] = new Category\Form\Container;
        return $form;
    }

}
