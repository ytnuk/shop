<?php

namespace CMS\Shop\Form;

use Nette\Forms\Container;

class ProductFormContainer extends Container {

    public function __construct($category = NULL) {
        $this->addTextArea('description', 'Description');
        $this->addTextArea('content', 'Content');
        $this->addText('price', 'Price')->setRequired()->setType('number');
        if ($category) {
            $this->setDefaults($category);
        }
    }

}
