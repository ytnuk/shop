<?php

namespace WebEdit\Shop\Product\Form;

use WebEdit\Form;

class Container extends Form\Container {

    protected function configure() {
        $this->addTextArea('description', 'shop.product.form.description.label');
        $this->addTextArea('content', 'shop.product.form.content.label');
        $this->addText('price', 'shop.product.form.price.label')
                ->setType('number')->setDefaultValue(0)->setRequired();
    }

}
