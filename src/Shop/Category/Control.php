<?php

namespace WebEdit\Shop\Category;

use WebEdit\Entity;
use WebEdit\Shop\Category\Form;

final class Control extends Entity\Control {

    public function __construct(Form\Control\Factory $formControl) {
        $this->formControl = $formControl;
    }

}
