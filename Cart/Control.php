<?php

namespace WebEdit\Shop\Cart;

use WebEdit;
use WebEdit\Shop\Cart;
use WebEdit\Shop\Product;

final class Control extends WebEdit\Control {

    private $repository;
    private $formFactory;
    private $productRepository;

    public function __construct(Cart\Repository $repository, Cart\Form\Factory $formFactory, Product\Repository $productRepository) {
        $this->repository = $repository;
        $this->formFactory = $formFactory;
        $this->productRepository = $productRepository;
    }

    public function render() {
        $template = $this->template;
        $template->items = $this->repository->getItems();
        $template->products = $this->productRepository->getProducts($this->repository->getItemKeys());
        $template->setFile(__DIR__ . '/Control/view.latte');
        $template->render();
    }

    public function formSuccess($form) {
        $key = $form->getName();
        if ($form->submitted->name == 'delete') {
            $this->repository->removeItem($key);
        } else {
            $values = $form->getValues();
            $this->repository->insertItem($key, $values['item']['quantity']);
        }
        $this->presenter->redirect('this');
    }

    protected function createComponentForm() {
        return new WebEdit\Control\Multiplier(function($key) {
            $quantity = $this->repository->getItem($key);
            $form = $this->formFactory->create($quantity);
            if ($quantity) {
                $form['item']['quantity']->setDefaultValue($quantity);
            }
            $form->onSuccess[] = array($this, 'formSuccess');
            return $form;
        });
    }

}
