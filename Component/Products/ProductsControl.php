<?php

namespace CMS\Shop\Component\Products;

use CMS\Component\BaseControl;

final class ProductsControl extends BaseControl {

    /**
     * @inject
     * @var \CMS\Shop\Model\CategoryRepository
     */
    public $categoryRepository;

    /**
     * @inject
     * @var \CMS\Shop\Model\ProductRepository
     */
    public $productRepository;

    /**
     * @inject
     * @var \CMS\Menu\Model\NodeRepository
     */
    public $nodeRepository;

    public function renderList($category = NULL) {
        $template = $this->template;
        if ($category) {
            $nodes = $this->nodeRepository->getChildNodesIds($category->node);
            $nodes[] = $category->node->id;
            $categories = $this->categoryRepository->getCategoriesInNodes($nodes);
        } else {
            $categories = $this->categoryRepository->getCategoriesIds();
        }
        $template->products = $this->productRepository->getProductsInCategories($categories);
        $template->setFile(__DIR__ . "/templates/list.latte");
        $template->render();
    }

}