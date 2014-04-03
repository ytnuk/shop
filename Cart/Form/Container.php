<?php

namespace WebEdit\Shop\Cart\Form;

use WebEdit\Form;

final class Container extends Form\Container {

    protected function configure() {
        $this->addText('quantity', 'shop.cart.form.quantity.label')
                ->setType('number')
                ->setDefaultValue(1)
                ->setRequired();
    }

}
