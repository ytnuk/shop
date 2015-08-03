<?php
namespace Ytnuk\Shop\Product;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Translation\Entity $title {1:1d Ytnuk\Translation\Entity::$product primary}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Description\Entity|NULL $description {1:1d Description\Entity::$product}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Content\Entity|NULL $content {1:1d Content\Entity::$product}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Link\Entity $link {1:1d Ytnuk\Link\Entity::$product primary}
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

	/**
	 * @return Nextras\Orm\Collection\ICollection|Ytnuk\Shop\Category\Entity[]
	 */
	public function getterCategories()
	{
		return $this->categoryRepository->findBy(['this->productNodes->product' => $this->id]);
	}

	/**
	 * @return Ytnuk\Shop\Category\Entity|NULL
	 */
	public function getterCategory()
	{
		$node = $this->categoryNodes->get()->findBy(['primary' => TRUE])->fetch();

		return $node instanceof Category\Entity ? $node->category : NULL;
	}

	/**
	 * @param Ytnuk\Shop\Category\Repository $repository
	 */
	public function injectCategoryRepository(Ytnuk\Shop\Category\Repository $repository)
	{
		$this->categoryRepository = $repository;
	}
}
