<?php

namespace WebEdit\Shop\Category\Form;

use WebEdit\Form;

class Container extends Form\Container {

    public function __construct($category = NULL) {
        $this->addTextArea('description', 'shop.admin.category.form.description.label');
        if ($category) {
            $this->setDefaults($category);
        }
    }

}
