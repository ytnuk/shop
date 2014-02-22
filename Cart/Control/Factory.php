<?php

namespace WebEdit\Shop\Cart\Control;

use WebEdit\Shop\Cart\Control;

interface Factory {

    /**
     * @return Control
     */
    public function create();
}
