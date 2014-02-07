<?php

namespace WebEdit\Shop\Product\Control;

use WebEdit\Shop\Product\Control;

interface Factory {

    /**
     * @return Control
     */
    public function create($category = NULL);
}
