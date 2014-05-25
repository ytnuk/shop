<?php

namespace WebEdit\Shop\Product\Form;

use WebEdit\Form;
use WebEdit\Page;
use WebEdit\Menu;

final class Control extends Form\Control {

    private $menuFacade;

    public function __construct(Page\Facade $facade, Form\Factory $form, Menu\Facade $menuFacade) {
        $this->facade = $facade;
        $this->form = $form;
        $this->menuFacade = $menuFacade;
    }

    protected function createComponentForm() {
        $form = parent::createComponentForm();
        $form['menu'] = new Menu\Form\Container;
        $form['page'] = new Page\Form\Container;
        $form['menu']['menu_id']->setItems($this->menuFacade->getChildren($this->entity ? $this->entity->menu : NULL));
        if ($this->entity) {
            $form['page']->setDefaults($this->entity);
            $form['menu']->setDefaults($this->entity->menu);
        }
        return $form;
    }

}
