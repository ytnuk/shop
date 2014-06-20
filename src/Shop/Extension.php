<?php

namespace WebEdit\Shop;

use WebEdit\Application;

final class Extension extends Application\Extension {

    public function loadConfiguration() {
        $builder = $this->getContainerBuilder();
        $builder->addDefinition($this->prefix('category.repository'))
                ->setClass('WebEdit\Shop\Category\Repository');
        $builder->addDefinition($this->prefix('category.facade'))
                ->setClass('WebEdit\Shop\Category\Facade');
        $builder->addDefinition($this->prefix('category.control'))
                ->setImplement('WebEdit\Shop\Category\Control\Factory');
        $builder->addDefinition($this->prefix('category.form.control'))
                ->setImplement('WebEdit\Shop\Category\Form\Control\Factory');
        $builder->addDefinition($this->prefix('product.repository'))
                ->setClass('WebEdit\Shop\Product\Repository');
        $builder->addDefinition($this->prefix('product.facade'))
                ->setClass('WebEdit\Shop\Product\Facade');
        $builder->addDefinition($this->prefix('product.control'))
                ->setImplement('WebEdit\Shop\Product\Control\Factory');
        #TODO: Cart
    }

}
