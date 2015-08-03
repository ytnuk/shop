<?php
namespace Ytnuk\Shop\Category;

use Nextras;
use Ytnuk;

/**
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Description\Entity|NULL $description {1:1d Description\Entity::$category}
 * @property Nextras\Orm\Relationships\OneHasOneDirected|Ytnuk\Menu\Entity $menu {1:1d Ytnuk\Menu\Entity::$category primary}
 * @property Nextras\Orm\Relationships\OneHasMany|Ytnuk\Shop\Product\Category\Entity[] $productNodes {1:m Ytnuk\Shop\Product\Category\Entity::$category}
 * @property-read Nextras\Orm\Collection\ICollection|Ytnuk\Shop\Product\Entity[] $products {virtual}
 */
final class Entity
	extends Ytnuk\Orm\Entity
{

	const PROPERTY_NAME = 'menu';

	/**
	 * @var Ytnuk\Shop\Product\Repository
	 */
	private $productRepository;

	/**
	 * @return Nextras\Orm\Collection\ICollection|Ytnuk\Shop\Product\Entity[]
	 */
	public function getterProducts()
	{
		return $this->productRepository->findBy(['this->categoryNodes->category' => $this->id]);
	}

	/**
	 * @param Ytnuk\Shop\Product\Repository $repository
	 */
	public function injectProductRepository(Ytnuk\Shop\Product\Repository $repository)
	{
		$this->productRepository = $repository;
	}
}
