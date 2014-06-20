<?php

namespace WebEdit\Shop\Cart\Form;

use WebEdit\Form;
use WebEdit\Cart;
use WebEdit\Menu;
use WebEdit\Application;

final class Control extends Form\Control {

    private $menuFacade;

    public function __construct(Cart\Facade $facade, Form\Factory $form, Menu\Facade $menuFacade) {
        $this->facade = $facade;
        $this->form = $form;
        $this->menuFacade = $menuFacade;
    }

    public function handleEdit($form) {
        $this->entity = $form->getName();
        $values = $form->getValues();
        if ($values['item']['quantity'] < 1) {
            $this->handleDelete($form);
        }
        parent::handleEdit($form);
    }

    protected function createComponentForm() {
        return new Application\Control\Multiplier(function($key) {
            $item = $this->repository->get($key);
            $form = $this->formFactory->create($item);
            $form['item'] = new Cart\Form\Container;
            if ($item) {
                $form['item']->setDefaults($item);
            }
            return $form;
        });
    }

}
