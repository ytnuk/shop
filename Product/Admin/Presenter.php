<?php

namespace WebEdit\Shop\Product\Admin;

use WebEdit\Shop;
use WebEdit\Menu;
use WebEdit\Gallery;
use WebEdit\Shop\Product;

final class Presenter extends Shop\Admin\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Repository
     */
    public $repository;

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Facade
     */
    public $facade;
    protected $entity;

    /**
     * @inject
     * @var \WebEdit\Menu\Facade
     */
    public $menuFacade;

    public function actionAdd() {
        $this['form']['menu']['menu_id']->setItems($this->menuFacade->getMenuByType('shop_category'));
    }

    public function renderAdd() {
        $this['menu']['breadcrumb'][] = $title = $this->translator->translate('shop.product.admin.add');
    }

    public function actionEdit($id) {
        $this->entity = $this->repository->getProduct($id);
        if (!$this->entity) {
            $this->error();
        }
        $this['form']['product']->setDefaults($this->entity);
        $this['form']['menu']['menu_id']->setItems($this->menuFacade->getMenuByType('shop_category'));
        $this['form']['menu']->setDefaults($this->entity);
    }

    public function renderEdit() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('shop.product.admin.edit', NULL, ['product' => $this->entity->title]);
    }

    protected function createComponentForm() {
        $form = $this->formFactory->create($this->entity);
        $form['menu'] = new Menu\Form\Container;
        $form['gallery'] = new Gallery\Form\Container;
        $form['product'] = new Product\Form\Container;
        return $form;
    }

}
