<?php

namespace WebEdit\Shop\Category\Form\Control;

use WebEdit\Shop\Category\Form;

interface Factory {

    /**
     * @return Form\Control
     */
    public function create();
}
