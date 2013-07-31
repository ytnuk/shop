<?php

namespace CMS\Shop;

use CMS\Front\BasePresenter as Presenter;

abstract class BasePresenter extends Presenter {

    /**
     * @inject
     * @var \CMS\Shop\Model\CategoryRepository
     */
    public $categoryRepository;

}