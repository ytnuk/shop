<?php

namespace CMS\Shop\Form;

use CMS\Form\FormFactory;
use CMS\Menu\Model\NodeFacade;
use CMS\Shop\Model\CategoryNotEmptyException;
use CMS\Shop\Model\CategoryFacade;

final class CategoryFormFactory extends FormFactory {

    private $nodeFacade;
    private $categoryFacade;

    public function __construct(NodeFacade $nodeFacade, CategoryFacade $categoryFacade) {
        $this->nodeFacade = $nodeFacade;
        $this->categoryFacade = $categoryFacade;
    }

    protected function addForm() {
        $this->form->addComponent($this->nodeFacade->getFormContainer('shop_category'), 'node');
        $this->form->addComponent($this->categoryFacade->getFormContainer(), 'category');
        $this->form->addSubmit('add', 'Add category');
    }

    protected function editForm($category) {
        $this->form->addComponent($this->nodeFacade->getFormContainer($category->node->tree, $category->node), 'node');
        $this->form->addComponent($this->categoryFacade->getFormContainer($category), 'category');
        $this->form->addSubmit('edit', 'Edit category');
        if ($category->node->node_id) {
            $this->form->addSubmit('delete', 'Delete category')->setAttribute('class', 'btn-danger');
        }
    }

    protected function add($data) {
        $category = $this->categoryFacade->addCategory($data);
        $this->presenter->redirect($category->node->link_admin, array('id' => $category->node->link_id));
    }

    protected function edit($category, $data) {
        $this->categoryFacade->editCategory($category, $data);
        $this->presenter->redirect('this');
    }

    protected function delete($category) {
        try {
            $this->categoryFacade->deleteCategory($category);
            $this->presenter->redirect('Category:list');
        } catch (CategoryNotEmptyException $e) {
            $this->presenter->flashMessage($e->getMessage(), 'warning');
            $this->presenter->redirect('this');
        }
    }

}
