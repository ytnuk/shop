<?php

namespace WebEdit\Shop\Product\Control;

use WebEdit\Shop\Product;

interface Factory {

    /**
     * @return Product\Control
     */
    public function create();
}
