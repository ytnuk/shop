<?php

namespace WebEdit\Shop\Cart\Control;

use WebEdit\Shop\Cart;

interface Factory {

    /**
     * @return Cart\Control
     */
    public function create();
}
