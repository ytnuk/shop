<?php

namespace CMS\Shop\Form;

use CMS\Form\FormContainer;

class CategoryFormContainer extends FormContainer {

    public function __construct($category = NULL) {
        $this->addTextArea('description', 'shop.form.description');
        if ($category) {
            $this->setDefaults($category);
        }
    }

}
