<?php
namespace Ytnuk\Shop\Product;

use Nextras;
use Ytnuk;

/**
 * @property int $id {primary}
 * @property Nextras\Orm\Relationships\OneHasOne|Ytnuk\Translation\Entity $title {1:1 Ytnuk\Translation\Entity, oneSided=true, isMain=true, cascade=[persist, remove]}
 * @property Nextras\Orm\Relationships\OneHasOne|Description\Entity|NULL $description {1:1 Description\Entity::$product, cascade=[persist, remove]}
 * @property Nextras\Orm\Relationships\OneHasOne|Content\Entity|NULL $content {1:1 Content\Entity::$product, cascade=[persist, remove]}
 * @property Nextras\Orm\Relationships\OneHasOne|Ytnuk\Link\Entity $link {1:1 Ytnuk\Link\Entity, oneSided=true, isMain=true, cascade=[persist, remove]}
 * @property Nextras\Orm\Relationships\OneHasMany|Category\Entity[] $categoryNodes {1:m Category\Entity::$product, cascade=[persist, remove]}
 * @property-read Ytnuk\Shop\Category\Entity|NULL $category {virtual}
 */
final class Entity
	extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'title';

	public function getterCategory()
	{
		$node = $this->categoryNodes->get()->findBy(['primary' => TRUE])->fetch();

		return $node instanceof Category\Entity ? $node->category : NULL;
	}
}
