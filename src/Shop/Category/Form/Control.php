<?php

namespace WebEdit\Shop\Category\Form;

use WebEdit\Entity;
use WebEdit\Shop\Category;
use WebEdit\Form;
use WebEdit\Menu;

final class Control extends Entity\Form\Control {

    private $menuFacade;

    public function __construct(Category\Facade $facade, Form\Factory $form, Menu\Facade $menuFacade) {
        $this->facade = $facade;
        $this->form = $form;
        $this->menuFacade = $menuFacade;
    }

    protected function createComponentForm() {
        $form = parent::createComponentForm();
        $form['menu'] = new Menu\Form\Container;
        $form['shop_category'] = new Category\Form\Container;
        $form['menu']['menu_id']->setItems($this->menuFacade->getChildren($this->entity ? $this->entity->menu : NULL));
        if ($this->entity) {
            $form['shop_category']->setDefaults($this->entity);
            $form['menu']->setDefaults($this->entity->menu);
        }
        return $form;
    }

}
