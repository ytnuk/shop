<?php

namespace WebEdit\Shop\Cart;

use WebEdit\Shop;

final class Presenter extends Shop\Presenter {

    public function renderView() {
        $this['menu']->showHeader(FALSE);
    }

}