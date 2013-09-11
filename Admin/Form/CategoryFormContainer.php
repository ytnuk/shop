<?php

namespace CMS\Admin\Shop\Form;

use Nette\Forms\Container;
use Nette\Database\Table\ActiveRow;

class CategoryFormContainer extends Container {

    /**
     * @param ActiveRow|NULL $category
     */
    public function __construct($category = NULL) {
        $this->addTextArea('description', 'Description');
        if ($category) {
            $this->setDefaults($category);
        }
    }

}
