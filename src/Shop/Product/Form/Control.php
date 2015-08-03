<?php
namespace Ytnuk\Shop\Product\Form;

use Ytnuk;

/**
 * Class Control
 *
 * @package Ytnuk\Shop
 */
final class Control
	extends Ytnuk\Orm\Form\Control
{

	/**
	 * @param Ytnuk\Shop\Product\Entity $product
	 * @param Ytnuk\Orm\Form\Factory $form
	 */
	public function __construct(
		Ytnuk\Shop\Product\Entity $product,
		Ytnuk\Orm\Form\Factory $form
	) {
		parent::__construct(
			$product,
			$form
		);
	}
}
