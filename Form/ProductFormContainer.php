<?php

namespace CMS\Shop\Form;

use CMS\Form\FormContainer;

class ProductFormContainer extends FormContainer {

    public function __construct($category = NULL) {
        $this->addTextArea('description', 'shop.form.description');
        $this->addTextArea('content', 'shop.form.content');
        $this->addText('price', 'shop.form.price')->setDefaultValue(0)->setRequired()->setType('number');
        if ($category) {
            $this->setDefaults($category);
        }
    }

}
