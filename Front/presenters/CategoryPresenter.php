<?php

namespace CMS\Shop;

final class CategoryPresenter extends BasePresenter {

    /**
     * @var Nette\Database\Table\ActiveRow
     */
    private $category;

    /**
     * @param int $id
     */
    public function actionView($id) {
        $this->category = $this->categoryRepository->getCategory($id);
        if (!$this->category) {
            $this->error();
        }
        $this->menu->setCurrent($this->category->node);
    }

    public function renderView() {
        $this->template->category = $this->category;
    }

}