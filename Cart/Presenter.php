<?php

namespace WebEdit\Shop\Cart;

use WebEdit\Shop;

class Presenter extends Shop\Presenter {

    public function renderView() {
        $this['menu']->showHeader(FALSE);
    }

}
