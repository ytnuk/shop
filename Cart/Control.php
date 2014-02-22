<?php

namespace WebEdit\Shop\Cart;

use WebEdit;
use WebEdit\Shop\Cart\Item;

class Control extends WebEdit\Control {

    private $itemRepository;

    public function __construct(Item\Repository $itemRepository) {
        $this->itemRepository = $itemRepository;
    }

    public function render() {
        $template = $this->template;
        $template->items = $this->itemRepository->getItems();
        $template->setFile(__DIR__ . '/Control/cart.latte');
        $template->render();
    }

}
