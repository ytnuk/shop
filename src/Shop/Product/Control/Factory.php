<?php
namespace Ytnuk\Shop\Product\Control;

use Ytnuk;

interface Factory
{

	public function create(Ytnuk\Shop\Product\Entity $product) : Ytnuk\Shop\Product\Control;
}
