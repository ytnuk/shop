<?php

namespace WebEdit\Shop\Category\Form;

use WebEdit\Form;
use WebEdit\Menu\Node;
use WebEdit\Shop\Category;

final class Factory extends Form\Factory {

    private $nodeFacade;
    private $categoryFacade;

    public function __construct(Node\Model\Facade $nodeFacade, Category\Model\Facade $categoryFacade) {
        $this->nodeFacade = $nodeFacade;
        $this->categoryFacade = $categoryFacade;
    }

    protected function addForm() {
        $this->form->addComponent($this->nodeFacade->getFormContainer(), 'node');
        $this->form->addComponent($this->categoryFacade->getFormContainer(), 'category');
        parent::addForm();
    }

    protected function editForm($category) {
        $this->form->addComponent($this->nodeFacade->getFormContainer(NULL, $category->node), 'node');
        $this->form->addComponent($this->categoryFacade->getFormContainer($category), 'category');
        parent::editForm($category);
        if ($category->node->node_id) {
            $this->deleteForm($category);
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
        $this->categoryFacade->deleteCategory($category);
        $this->presenter->redirect('Presenter:view');
    }

}
