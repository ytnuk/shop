<?php
namespace Ytnuk\Shop\Product\Category;

use Nextras;
use Ytnuk;

/**
 * Class Mapper
 *
 * @package Ytnuk\Shop
 */
final class Mapper
	extends Ytnuk\Orm\Mapper
{

	/**
	 * @inheritdoc
	 */
	public function createCollectionOneHasMany(
		Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata,
		Nextras\Orm\Entity\IEntity $parent
	) {
		return parent::createCollectionOneHasMany(
			$metadata,
			$parent
		)->orderBy(
			'primary',
			Nextras\Orm\Collection\ICollection::DESC
		);
	}
}
