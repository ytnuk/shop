<?php

namespace CMS\Shop\Model;

use CMS\Model\Facade;
use CMS\Shop\Model\ProductRepository;
use CMS\Menu\Model\NodeFacade;

class ProductFacade extends Facade {

    public $repository;
    private $nodeFacade;

    public function __construct(ProductRepository $repository, NodeFacade $nodeFacade) {
        $this->repository = $repository;
        $this->nodeFacade = $nodeFacade;
    }

}
