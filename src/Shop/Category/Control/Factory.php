<?php

namespace WebEdit\Shop\Category\Control;

use WebEdit\Shop\Category;

interface Factory {

    /**
     * @return Category\Control
     */
    public function create();
}
