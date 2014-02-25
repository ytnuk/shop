<?php

namespace WebEdit\Shop\Cart;

use WebEdit;
use WebEdit\Shop\Cart\Item;

class Control extends WebEdit\Control {

    private $itemRepository;
    private $itemFormFactory;

    public function __construct(Item\Repository $itemRepository, Item\Form\Factory $itemFormFactory) {
        $this->itemRepository = $itemRepository;
        $this->itemFormFactory = $itemFormFactory;
    }

    public function render() {
        $template = $this->template;
        $template->items = $this->itemRepository->getItems();
        $template->setFile(__DIR__ . '/Control/cart.latte');
        $template->render();
    }

    public function renderInsert() {
        $template = $this->template;
        $template->setFile(__DIR__ . '/Control/insert.latte');
        $template->render();
    }

    protected function createComponentForm() {
        return $this->itemFormFactory->create();
    }

}
