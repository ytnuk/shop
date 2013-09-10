<?php

namespace CMS\Admin\Shop\Form;

use CMS\Form\BaseFormFactory;
use Nette\Application\UI\Form;
use CMS\Model\MenuFacade;
use CMS\Shop\Model\CategoryFacade;
use CMS\Admin\Menu\Form\NodeFormContainer;
use CMS\Admin\Shop\Form\CategoryFormContainer;

final class CategoryFormFactory extends BaseFormFactory {

    private $menuFacade;
    private $categoryFacade;

    public function __construct(MenuFacade $menuFacade, CategoryFacade $categoryFacade) {
        $this->menuFacade = $menuFacade;
        $this->categoryFacade = $categoryFacade;
    }

    protected function addForm() {
        $form = parent::addForm();
        $data = $this->menuFacade->getParentNodeSelectData('shop_category');
        $form['node'] = new NodeFormContainer($data);
        $form['category'] = new CategoryFormContainer();
        $form->addSubmit('add', 'Add category');
        return $form;
    }

    protected function editForm($category) {
        $form = parent::editForm($category);
        $data = $this->menuFacade->getParentNodeSelectData($category->node->tree, $category->node);
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
            $this->categoryFacade->deleteCategory($category);
            $this->presenter->redirect('Home:view');
        } else {
            $this->categoryFacade->editCategory($category, $form->getValues(TRUE));
            $this->presenter->redirect('this');
        }
    }

}
