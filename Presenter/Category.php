<?php

namespace CMS\Shop\Presenter;

use CMS\Shop\Presenter\Base;

final class Category extends Base {

    /**
     * @inject
     * @var \CMS\Shop\Category\Model\Facade
     */
    public $categoryFacade;
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
