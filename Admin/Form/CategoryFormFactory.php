<?php

namespace CMS\Admin\Shop\Form;

use CMS\Form\FormFactory;
use Nette\Application\UI\Form;
use CMS\Model\NodeFacade;
use CMS\Shop\Model\CategoryNotEmptyException;
use CMS\Shop\Model\CategoryFacade;
use CMS\Admin\Menu\Form\NodeFormContainer;
use CMS\Admin\Shop\Form\CategoryFormContainer;

final class CategoryFormFactory extends FormFactory {

    private $nodeFacade;
    private $categoryFacade;

    public function __construct(NodeFacade $nodeFacade, CategoryFacade $categoryFacade) {
        $this->nodeFacade = $nodeFacade;
        $this->categoryFacade = $categoryFacade;
    }

    protected function addForm() {
        $form = parent::addForm();
        $data = $this->nodeFacade->getParentNodeSelectData('shop_category');
        $form['node'] = new NodeFormContainer($data);
        $form['category'] = new CategoryFormContainer();
        $form->addSubmit('add', 'Add category');
        return $form;
    }

    protected function editForm($category) {
        $form = parent::editForm($category);
        $data = $this->nodeFacade->getParentNodeSelectData($category->node->tree, $category->node);
        $form['node'] = new NodeFormContainer($data, $category->node);
        $form['category'] = new CategoryFormContainer($category);
        $form->addSubmit('edit', 'Edit category');
        if ($category->node->node_id) {
            $form->addSubmit('delete', 'Delete category')->setAttribute('class', 'btn-danger');
        }
        return $form;
    }

    public function addFormSuccess(Form $form) {
        $category = $this->categoryFacade->addCategory($form->getValues(TRUE));
        $this->presenter->redirect($category->node->link_admin, array('id' => $category->node->link_id));
    }

    public function editFormSuccess(Form $form, $category) {
        if ($form->isSubmitted()->getHtmlName() == 'delete') {
            try {
                $this->categoryFacade->deleteCategory($category);
                $this->presenter->redirect('Home:view');
            } catch (CategoryNotEmptyException $e) {
                $this->presenter->flashMessage($e->getMessage(), 'warning');
                $this->presenter->redirect('this');
            }
        } else {
            $this->categoryFacade->editCategory($category, $form->getValues(TRUE));
            $this->presenter->redirect('this');
        }
    }

}
