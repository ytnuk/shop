<?php

namespace CMS\Shop\Form;

use CMS\Form\FormFactory;
use CMS\Menu\Model\NodeFacade;
use CMS\Shop\Model\ProductFacade;

final class ProductFormFactory extends FormFactory {

    private $nodeFacade;
    private $productFacade;

    public function __construct(NodeFacade $nodeFacade, ProductFacade $productFacade) {
        $this->nodeFacade = $nodeFacade;
        $this->productFacade = $productFacade;
    }

    protected function addForm() {
        $this->form->addComponent($this->nodeFacade->getFormContainer('shop_category'), 'node');
        $this->form->addComponent($this->productFacade->getFormContainer(), 'product');
        $this->form->addSubmit('add', 'Add product');
    }

    protected function editForm($product) {
        $this->form->addComponent($this->nodeFacade->getFormContainer('shop_category'), 'node');
        $this->form['node']->setDefaults($product);
        $this->form->addComponent($this->productFacade->getFormContainer($product), 'product');
        $this->form->addSubmit('edit', 'Edit product');
        $this->form->addSubmit('delete', 'Delete product')->setAttribute('class', 'btn-danger');
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
