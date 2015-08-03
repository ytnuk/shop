<?php
namespace Ytnuk\Shop\Category\Description\Form;

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
	 */
	public function setValues(
		$values,
		$erase = FALSE
	) {
		if (isset($values['value'], $values['value']['translates']) && (array) $values['value']['translates']) {
			return parent::setValues(
				$values,
				$erase
			);
		} else {
			$this->removeEntity(FALSE);

			return $this;
		}
	}
}
