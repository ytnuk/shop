<?php

namespace WebEdit\Shop\Product\Form;

use WebEdit\Form;

class Container extends Form\Container {

    public function __construct($product = NULL) {
        $this->addTextArea('description', 'shop.admin.product.form.description.label');
        $this->addTextArea('content', 'shop.admin.product.form.content.label');
        $this->addText('price', 'shop.admin.product.form.price.label')
                ->setType('number')
                ->setDefaultValue(0)
                ->setRequired();
        if ($product) {
            $this->setDefaults($product);
        }
    }

}
