<?php
namespace Ytnuk\Shop\Category\Control;

use Ytnuk;

/**
 * Interface Factory
 *
 * @package Ytnuk\Shop
 */
interface Factory
{

	/**
	 * @param Ytnuk\Shop\Category\Entity $category
	 *
	 * @return Ytnuk\Shop\Category\Control
	 */
	public function create(Ytnuk\Shop\Category\Entity $category);
}
