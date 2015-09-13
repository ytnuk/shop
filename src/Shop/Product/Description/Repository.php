<?php
namespace Ytnuk\Shop\Product\Description;

use Ytnuk;

final class Repository
	extends Ytnuk\Orm\Repository
{

	public static function getEntityClassNames() : array
	{
		return [
			Entity::class,
		];
	}
}
