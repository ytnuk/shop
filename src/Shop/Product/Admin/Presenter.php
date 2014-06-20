<?php

namespace WebEdit\Shop\Product\Admin;

use WebEdit\Application;
use WebEdit\Menu;
use WebEdit\Gallery;
use WebEdit\Shop\Product;

final class Presenter extends Application\Admin\Presenter {

    /**
     * @inject
     * @var Product\Repository
     */
    public $repository;

    /**
     * @inject
     * @var Product\Facade
     */
    public $facade;
    protected $entity;

    /**
     * @inject
     * @var Menu\Facade
     */
    public $menuFacade;

    public function actionAdd() {
        $this['form']['menu']['menu_id']->setItems($this->menuFacade->getMenuByType('shop_category'));
    }

    public function renderAdd() {
        $this['menu'][] = 'shop.product.admin.add';
    }

    public function actionEdit($id) {
        $this->entity = $this->repository->getProduct($id);
        if (!$this->entity) {
            $this->error();
        }
        $this['form']['shop_product']->setDefaults($this->entity);
        $this['form']['menu']['menu_id']->setItems($this->menuFacade->getMenuByType('shop_category'));
        $this['form']['menu']->setDefaults($this->entity);
    }

    public function renderEdit() {
        $this['menu'][] = 'shop.product.admin.edit';
    }

    protected function createComponentForm() {
        $form = $this->formFactory->create($this->entity);
        $form['menu'] = new Menu\Form\Container;
        $form['gallery'] = new Gallery\Form\Container;
        $form['shop_product'] = new Product\Form\Container;
        return $form;
    }

}
