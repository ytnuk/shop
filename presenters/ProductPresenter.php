<?php

namespace CMS\Shop;

final class ProductPresenter extends BasePresenter {

    /**
     * @inject
     * @var \CMS\Shop\Model\ProductFacade
     */
    public $productFacade;

    /**
     * @var Nette\Database\Table\ActiveRow
     */
    private $product;
    private $productTemplate;

    /**
     * @param int $id
     */
    public function actionView($id) {
        $this->product = $this->productFacade->repository->getProduct($id);
        if (!$this->product) {
            $this->error();
        }
        $this->productTemplate = $this->createTemplate('Nette\Templating\Template');
        $this->productTemplate->setSource($this->product->content);
        $this->menu->setActive($this->product->node);
    }

    public function renderView() {
        $this->menu->breadcrumbAdd($this->product->title);
        $this->template->product = $this->product;
        $this->template->productTemplate = $this->productTemplate;
    }

}
