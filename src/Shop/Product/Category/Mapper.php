<?php
namespace Ytnuk\Shop\Product\Category;

use Nextras;
use Ytnuk;

final class Mapper
	extends Ytnuk\Orm\Mapper
{

	public function createCollectionOneHasMany(
		Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata,
		Nextras\Orm\Entity\IEntity $parent
	) : Nextras\Orm\Mapper\Dbal\DbalCollection
	{
		return parent::createCollectionOneHasMany($metadata, $parent)->orderBy('primary', Nextras\Orm\Collection\ICollection::DESC);
	}
}
