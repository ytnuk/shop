<?php

namespace WebEdit\Shop\Product;

use WebEdit\Shop\Product\Control;

interface ControlFactory {

    /**
     * @return Control
     */
    public function create($category = NULL);
}
