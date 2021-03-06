<?php
namespace Ytnuk\Shop\Category;

use Nextras;
use Ytnuk;

/**
 * @property int $id {primary}
 * @property Nextras\Orm\Relationships\OneHasOne|Description\Entity|NULL $description {1:1 Description\Entity::$category, cascade=[persist, remove]}
 * @property Nextras\Orm\Relationships\OneHasOne|Ytnuk\Menu\Entity $menu {1:1 Ytnuk\Menu\Entity, oneSided=true, isMain=true, cascade=[persist, remove]}
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

	public function getterProducts() : Nextras\Orm\Collection\ICollection
	{
		return $this->productRepository->findBy(['this->categoryNodes->category' => $this->id]);
	}

	public function injectProductRepository(Ytnuk\Shop\Product\Repository $repository)
	{
		$this->productRepository = $repository;
	}
}
