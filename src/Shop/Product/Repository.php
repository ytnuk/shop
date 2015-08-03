<?php
namespace Ytnuk\Shop\Product;

use Nextras;
use Ytnuk;

/**
 * Class Repository
 *
 * @package Ytnuk\Shop
 */
final class Repository
	extends Ytnuk\Orm\Repository
{

	/**
	 * @inheritdoc
	 */
	public function findAll()
	{
		return parent::findAll()->orderBy(
			current($this->getEntityMetadata()->getPrimaryKey()),
			Nextras\Orm\Collection\ICollection::DESC
		);
	}
}
