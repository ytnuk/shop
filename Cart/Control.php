<?php

namespace WebEdit\Shop\Cart;

use WebEdit;
use WebEdit\Form;
use WebEdit\Shop\Cart;
use WebEdit\Shop\Product;
use WebEdit\Control\Multiplier;

final class Control extends WebEdit\Control {

    protected $entity;
    protected $facade;
    private $repository;
    private $formFactory;
    private $productRepository;

    public function __construct(Cart\Facade $facade, Cart\Repository $repository, Form\Factory $formFactory, Product\Repository $productRepository) {
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

    public function handleEdit($form) {
        $this->entity = $form->getName();
        $values = $form->getValues();
        if ($values['item']['quantity'] < 1) {
            $this->handleDelete($form);
        }
        parent::handleEdit($form);
    }

    protected function createComponentForm() {
        return new Multiplier(function($key) {
            $item = $this->repository->get($key);
            $form = $this->formFactory->create($item);
            $form['item'] = new Cart\Form\Container;
            if ($item) {
                $form['item']->setDefaults($item);
            }
            return $form;
        });
    }

}
