<?php

namespace CMS\Shop;

final class CategoryPresenter extends BasePresenter {

    /**
     * @inject
     * @var \CMS\Shop\Model\CategoryFacade
     */
    public $categoryFacade;

    /**
     * @var Nette\Database\Table\ActiveRow
     */
    private $category;

    /**
     * @param int $id
     */
    public function actionView($id) {
        $this->category = $this->categoryFacade->repository->getCategory($id);
        if (!$this->category) {
            $this->error();
        }
        $this->menu->setActive($this->category->node);
    }

    public function renderView() {
        $this->template->category = $this->category;
    }

}