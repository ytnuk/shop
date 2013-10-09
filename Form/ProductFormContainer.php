<?php

namespace CMS\Shop\Form;

use CMS\Form\FormContainer;

class ProductFormContainer extends FormContainer {

    public function __construct($category = NULL) {
        $this->addTextArea('description', 'Description');
        $this->addTextArea('content', 'Content');
        $this->addText('price', 'Price')->setDefaultValue(0)->setRequired()->setType('number');
        if ($category) {
            $this->setDefaults($category);
        }
    }

}
