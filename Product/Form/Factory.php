<?php

namespace WebEdit\Shop\Product\Form;

use WebEdit\Form;
use WebEdit\Menu;
use WebEdit\Shop\Product;

final class Factory extends Form\Factory {

    private $menuFacade;
    private $productFacade;

    public function __construct(Menu\Facade $menuFacade, Product\Facade $productFacade) {
        $this->menuFacade = $menuFacade;
        $this->productFacade = $productFacade;
    }

    protected function addForm() {
        $this->form->addComponent($this->menuFacade->getFormContainer(NULL, 'shop_category'), 'menu');
        $this->form->addComponent($this->productFacade->getFormContainer(), 'product');
        parent::addForm();
    }

    protected function editForm($product) {
        $this->form->addComponent($this->menuFacade->getFormContainer(NULL, 'shop_category'), 'menu');
        $this->form->getComponent('menu')->setDefaults($product);
        $this->form->addComponent($this->productFacade->getFormContainer($product), 'product');
        parent::editForm($product);
        $this->deleteForm($product);
    }

    protected function add($data) {
        $product = $this->productFacade->addProduct($data);
        $this->presenter->redirect('Presenter:edit', array('id' => $product->id));
    }

    protected function edit($product, $data) {
        $this->productFacade->editProduct($product, $data);
        $this->presenter->redirect('this');
    }

    protected function delete($product) {
        $this->productFacade->deleteProduct($product);
        $this->presenter->redirect('Presenter:view');
    }

}
