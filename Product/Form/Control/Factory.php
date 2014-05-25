<?php

namespace WebEdit\Shop\Product\Form\Control;

use WebEdit\Shop\Product\Form;

interface Factory {

    /**
     * @return Form\Control
     */
    public function create();
}
