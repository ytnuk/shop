<?php

namespace WebEdit\Shop\Product\Admin;

use WebEdit\Shop;

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

    /**
     * @inject
     * @var \WebEdit\Shop\Product\Form\Factory
     */
    public $formFactory;
    private $product;

    public function actionAdd() {
        $this['form']->onSuccess[] = [$this, 'handleAdd'];
    }

    public function handleAdd($form) {
        $product = $this->facade->addProduct($form->getValues());
        $this->redirect('Presenter:edit', ['id' => $product->id]);
    }

    public function renderAdd() {
        $this['menu']['breadcrumb'][] = $title = $this->translator->translate('shop.product.admin.add');
    }

    public function actionEdit($id) {
        $this->product = $this->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
        $this['form']['product']->setDefaults($this->product);
        $this['form']['menu']->setDefaults($this->product);
        $this['form']->onSuccess[] = [$this, 'handleEdit'];
    }

    public function handleEdit($form) {
        if ($form->submitted->name == 'delete') {
            $this->facade->deleteProduct($this->product);
            $this->redirect('Presenter:view');
        } else {
            $this->facade->editProduct($this->product, $form->getValues());
            $this->redirect('this');
        }
    }

    public function renderEdit() {
        $this['menu']['breadcrumb'][] = $this->translator->translate('shop.product.admin.edit', NULL, ['product' => $this->product->title]);
    }

    protected function createComponentForm() {
        return $this->formFactory->create($this->product);
    }

}
