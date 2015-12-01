<?php
namespace Ytnuk\Shop\Product;

use Nextras;
use Ytnuk;

/**
 * @property int $id {primary}
 * @property Nextras\Orm\Relationships\OneHasOne|Ytnuk\Translation\Entity $title {1:1 Ytnuk\Translation\Entity::$product, primary=true, cascade=[persist, remove]}
 * @property Nextras\Orm\Relationships\OneHasOne|Description\Entity|NULL $description {1:1 Description\Entity::$product}
 * @property Nextras\Orm\Relationships\OneHasOne|Content\Entity|NULL $content {1:1 Content\Entity::$product}
 * @property Nextras\Orm\Relationships\OneHasOne|Ytnuk\Link\Entity $link {1:1 Ytnuk\Link\Entity::$product, primary=true}
 * @property Nextras\Orm\Relationships\OneHasMany|Category\Entity[] $categoryNodes {1:m Category\Entity::$product}
 * @property-read Nextras\Orm\Collection\ICollection|Ytnuk\Shop\Category\Entity[] $categories {virtual}
 * @property-read Ytnuk\Shop\Category\Entity|NULL $category {virtual}
 */
final class Entity
	extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'title';

	/**
	 * @var Ytnuk\Shop\Category\Repository
	 */
	private $categoryRepository;

	public function getterCategories() : Nextras\Orm\Collection\ICollection
	{
		return $this->categoryRepository->findBy(['this->productNodes->product' => $this->id]);
	}

	public function getterCategory()
	{
		$node = $this->categoryNodes->get()->findBy(['primary' => TRUE])->fetch();

		return $node instanceof Category\Entity ? $node->category : NULL;
	}

	public function injectCategoryRepository(Ytnuk\Shop\Category\Repository $repository)
	{
		$this->categoryRepository = $repository;
	}
}
