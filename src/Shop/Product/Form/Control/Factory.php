<?php
namespace Ytnuk\Shop\Product\Form\Control;

use Ytnuk;

interface Factory
{

	public function create(Ytnuk\Shop\Product\Entity $product) : Ytnuk\Shop\Product\Form\Control;
}
