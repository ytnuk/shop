<?php

namespace WebEdit\Shop\Cart;

use WebEdit;
use WebEdit\Form;
use WebEdit\Shop\Cart;
use WebEdit\Shop\Product;

final class Control extends WebEdit\Control {

    protected $entity;
    protected $facade;
    private $repository;
    private $formFactory;
    private $productRepository;

    public function __construct(Cart\Facade $facade, Cart\Repository $repository, Form\Control\Factory $formFactory, Product\Repository $productRepository) {
        $this->facade = $facade;
        $this->repository = $repository;
        $this->formFactory = $formFactory;
        $this->productRepository = $productRepository;
    }

    public function render() {
        $template = $this->template;
        $template->items = $this->repository->getAll();
        $template->products = $this->productRepository->getProducts($this->repository->getIdsOfItems());
        $template->setFile($this->getTemplateFiles('view'));
        $template->render();
    }

}
