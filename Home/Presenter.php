<?php

namespace WebEdit\Shop\Home;

use WebEdit\Shop;

final class Presenter extends Shop\Presenter {

    /**
     * @inject
     * @var \WebEdit\Shop\Product\ControlFactory
     */
    public $productControlFactory;

    public function actionView() {
        $this->menu->setActive(':Shop:Home:Presenter:view');
    }

    protected function createComponentProduct() {
        return $this->productControlFactory->create();
    }

}
