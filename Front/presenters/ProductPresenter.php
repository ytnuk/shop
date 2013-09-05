<?php

namespace CMS\Shop;

final class ProductPresenter extends BasePresenter {

    /**
     * @inject
     * @var \CMS\Shop\Model\ProductRepository
     */
    public $productRepository;

    /**
     * @var Nette\Database\Table\ActiveRow
     */
    private $product;

    /**
     * @param int $id
     */
    public function actionView($id) {
        $this->product = $this->productRepository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
        $this->menu->setActive($this->product->node);
    }

    public function renderView() {
        $this->menu->breadcrumbAdd($this->product->title);
        $this->template->product = $this->product;
    }

}
