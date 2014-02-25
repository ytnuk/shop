<?php

namespace WebEdit\Shop\Cart\Item\Form;

use WebEdit\Form;

class Factory {

    private $formFactory;

    public function __construct(Form\Factory $formFactory) {
        $this->formFactory = $formFactory;
    }

    public function create($item = NULL) {
        $form = $this->formFactory->create($item);
        $form->addGroup('shop.cart.form.group');
        $container = $form->addContainer('item');
        $container->addText('quantity', 'shop.cart.form.quantity.label')
                ->setType('number')
                ->setDefaultValue(1)
                ->setRequired();
        return $form;
    }

}
