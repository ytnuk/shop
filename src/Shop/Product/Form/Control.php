<?php
namespace Ytnuk\Shop\Product\Form;

use Ytnuk;

final class Control
	extends Ytnuk\Orm\Form\Control
{

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
