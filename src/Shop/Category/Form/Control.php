<?php
namespace Ytnuk\Shop\Category\Form;

use Ytnuk;

final class Control
	extends Ytnuk\Orm\Form\Control
{

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
