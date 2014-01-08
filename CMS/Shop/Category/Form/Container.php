<?php

namespace CMS\Shop\Category\Form;

use CMS\Form;

class Container extends Form\Container {

    public function __construct($category = NULL) {
        $this->addTextArea('description', 'shop.admin.category.form.description.label');
        if ($category) {
            $this->setDefaults($category);
        }
    }

}
