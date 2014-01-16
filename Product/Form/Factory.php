<?php

namespace WebEdit\Shop\Product\Form;

use WebEdit\Form;
use WebEdit\Menu\Node;
use WebEdit\Shop\Product;

final class Factory extends Form\Factory {

    private $nodeFacade;
    private $productFacade;

    public function __construct(Node\Model\Facade $nodeFacade, Product\Model\Facade $productFacade) {
        $this->nodeFacade = $nodeFacade;
        $this->productFacade = $productFacade;
    }

    protected function addForm() {
        $this->form->addComponent($this->nodeFacade->getFormContainer('shop-category', NULL, FALSE), 'node');
        $this->form->addComponent($this->productFacade->getFormContainer(), 'product');
        parent::addForm();
    }

    protected function editForm($product) {
        $this->form->addComponent($this->nodeFacade->getFormContainer('shop-category', NULL, FALSE), 'node');
        $this->form->getComponent('node')->setDefaults($product);
        $this->form->addComponent($this->productFacade->getFormContainer($product), 'product');
        parent::editForm($product);
        $this->deleteForm($product);
    }

    protected function add($data) {
        $product = $this->productFacade->addProduct($data);
        $this->presenter->redirect('Product:edit', array('id' => $product->id));
    }

    protected function edit($product, $data) {
        $this->productFacade->editProduct($product, $data);
        $this->presenter->redirect('this');
    }

    protected function delete($product) {
        $this->productFacade->deleteProduct($product);
        $this->presenter->redirect('Product:list');
    }

}
