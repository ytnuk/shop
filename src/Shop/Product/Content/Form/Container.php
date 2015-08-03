<?php
namespace Ytnuk\Shop\Product\Content\Form;

use Ytnuk;

/**
 * Class Container
 *
 * @package Ytnuk\Shop
 */
final class Container
	extends Ytnuk\Orm\Form\Container
{

	/**
	 * @inheritdoc
	 *
	 * @param Ytnuk\Shop\Product\Content\Entity $values
	 */
	public function setValues(
		$values,
		$erase = FALSE
	) {
		if ((array) $values->value->translates) {
			return parent::setValues(
				(array) $values,
				$erase
			);
		} else {
			$this->removeEntity(FALSE);

			return $this;
		}
	}
}
