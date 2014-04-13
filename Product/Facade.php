<?php

namespace WebEdit\Shop\Product;

use WebEdit\Shop\Product;
use WebEdit\Gallery;

final class Facade {

    private $repository;
    private $galleryFacade;

    public function __construct(Product\Repository $repository, Gallery\Facade $galleryFacade) {
        $this->repository = $repository;
        $this->galleryFacade = $galleryFacade;
    }

    public function add(array $data) {
        $gallery = $this->galleryFacade->add($data);
        $data['shop_product'] = array_merge($data['shop_product'], $data['menu']);
        $data['shop_product']['gallery_id'] = $gallery->id;
        return $this->repository->insert($data['shop_product']);
    }

    public function edit($product, array $data) {
        $data = array_merge($data['shop_product'], $data['menu']);
        $this->repository->update($product, $data);
    }

    public function delete($product) {
        $this->repository->remove($product);
    }

}
