<?php
namespace Ytnuk\Shop\Product\Form\Control;

use Ytnuk;

/**
 * Interface Factory
 *
 * @package Ytnuk\Shop
 */
interface Factory
{

	/**
	 * @param Ytnuk\Shop\Product\Entity $product
	 *
	 * @return Ytnuk\Shop\Product\Form\Control
	 */
	public function create(Ytnuk\Shop\Product\Entity $product);
}
