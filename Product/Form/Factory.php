<?php

namespace WebEdit\Shop\Product\Form;

use WebEdit\Menu;

final class Factory {

    private $menuFormFactory;

    public function __construct(Menu\Form\Factory $menuFormFactory) {
        $this->menuFormFactory = $menuFormFactory;
    }

    public function create($category = NULL) {
        $menu = $category ? $category->menu : NULL;
        $form = $this->menuFormFactory->create($menu, 'shop_category');
        $form->addGroup('shop.product.form.group');
        $container = $form->addContainer('product');
        $container->addTextArea('description', 'shop.product.form.description.label');
        $container->addTextArea('content', 'shop.product.form.content.label');
        $container->addText('price', 'shop.product.form.price.label')
                ->setType('number')->setDefaultValue(0)->setRequired();
        return $form;
    }

}
