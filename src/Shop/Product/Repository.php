<?php
namespace Ytnuk\Shop\Product;

use Nextras;
use Ytnuk;

final class Repository
	extends Ytnuk\Orm\Repository
{

	public function findAll() : Nextras\Orm\Collection\ICollection
	{
		return parent::findAll()->orderBy(
			current($this->getEntityMetadata()->getPrimaryKey()),
			Nextras\Orm\Collection\ICollection::DESC
		);
	}
}
