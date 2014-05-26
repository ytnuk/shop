<?php

namespace WebEdit\Shop\Category\Form;

use WebEdit\Form;

final class Container extends Form\Container {

    protected function configure() {
        $this->addTextArea('description', 'shop.category.form.description.label');
    }

}
