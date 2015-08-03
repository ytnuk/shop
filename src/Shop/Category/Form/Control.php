<?php
namespace Ytnuk\Shop\Category\Form;

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
	 * @param Ytnuk\Shop\Category\Entity $category
	 * @param Ytnuk\Orm\Form\Factory $form
	 */
	public function __construct(
		Ytnuk\Shop\Category\Entity $category,
		Ytnuk\Orm\Form\Factory $form
	) {
		parent::__construct(
			$category,
			$form
		);
	}
}
