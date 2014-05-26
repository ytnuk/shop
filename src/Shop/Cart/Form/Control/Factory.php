<?php

namespace WebEdit\Shop\Cart\Form\Control;

use WebEdit\Shop\Cart\Form;

interface Factory {

    /**
     * @return Form\Control
     */
    public function create();
}
