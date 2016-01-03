<?php
namespace Ytnuk\Shop\Product\Description;

use Nextras;
use Ytnuk;

/**
 * @property int $id {primary}
 * @property Nextras\Orm\Relationships\OneHasOne|Ytnuk\Shop\Product\Entity $product {1:1 Ytnuk\Shop\Product\Entity::$description, isMain=true}
 * @property Nextras\Orm\Relationships\OneHasOne|Ytnuk\Translation\Entity|NULL $value {1:1 Ytnuk\Translation\Entity, oneSided=true, isMain=true, cascade=[persist, remove]}
 */
final class Entity
	extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'value';
}
