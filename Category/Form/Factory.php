<?php

namespace WebEdit\Shop\Category\Form;

use WebEdit\Menu;

class Factory {

    private $menuFormFactory;

    public function __construct(Menu\Form\Factory $menuFormFactory) {
        $this->menuFormFactory = $menuFormFactory;
    }

    public function create($category = NULL) {
        $menu = $category ? $category->menu : NULL;
        $form = $this->menuFormFactory->create($menu);
        $form->addGroup('shop.category.form.group');
        $container = $form->addContainer('category');
        $container->addTextArea('description', 'shop.category.form.description.label');
        return $form;
    }

}
