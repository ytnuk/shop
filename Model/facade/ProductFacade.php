<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseFacade;
use CMS\Shop\Model\ProductRepository;
use CMS\Model\NodeFacade;

class ProductFacade extends BaseFacade {

    public $repository;
    private $nodeFacade;

    public function __construct(ProductRepository $repository, NodeFacade $nodeFacade) {
        $this->repository = $repository;
        $this->nodeFacade = $nodeFacade;
    }

}
