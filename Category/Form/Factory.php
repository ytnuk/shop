<?php

namespace WebEdit\Shop\Category\Form;

use WebEdit\Form;
use WebEdit\Menu;
use WebEdit\Shop\Category;

final class Factory extends Form\Factory {

    private $menuFacade;
    private $categoryFacade;

    public function __construct(Menu\Facade $menuFacade, Category\Facade $categoryFacade) {
        $this->menuFacade = $menuFacade;
        $this->categoryFacade = $categoryFacade;
    }

    protected function addForm() {
        $this->form->addComponent($this->menuFacade->getFormContainer(), 'menu');
        $this->form->addComponent($this->categoryFacade->getFormContainer(), 'category');
        parent::addForm();
    }

    protected function editForm($category) {
        $this->form->addComponent($this->menuFacade->getFormContainer($category->menu), 'menu');
        $this->form->addComponent($this->categoryFacade->getFormContainer($category), 'category');
        parent::editForm($category);
        $this->deleteForm($category);
    }

    protected function add($data) {
        $category = $this->categoryFacade->addCategory($data);
        $this->presenter->redirect('Presenter:edit', array('id' => $category->id));
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
