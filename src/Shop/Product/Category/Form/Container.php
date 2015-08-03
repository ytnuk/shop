<?php
namespace Ytnuk\Shop\Product\Category\Form;

use Nette;
use Nextras;
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
	protected function addProperty(Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata)
	{
		$component = parent::addProperty($metadata);
		if ($component instanceof Nette\Forms\Controls\BaseControl) {
			switch ($metadata->name) {
				case 'product':
				case 'category':
					$component->setOption(
						'unique',
						TRUE
					);
					break;
				case 'primary':
					$component->setOption(
						'unique',
						'product'
					);
					break;
			}
		}

		return $component;
	}
}
