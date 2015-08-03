<?php
namespace Ytnuk\Shop\Category\Form\Control;

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
	 * @return Ytnuk\Shop\Category\Form\Control
	 */
	public function create(Ytnuk\Shop\Category\Entity $category);
}
