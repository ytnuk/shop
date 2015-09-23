<?php
namespace Ytnuk\Shop;

use Nette;
use Ytnuk;

final class Control
	extends Ytnuk\Application\Control
{

	const NAME = 'shop';

	/**
	 * @var Category\Control\Factory
	 */
	private $categoryControl;

	/**
	 * @var Product\Control\Factory
	 */
	private $productControl;

	/**
	 * @var Category\Entity
	 */
	private $category;

	/**
	 * @var Product\Entity
	 */
	private $product;

	public function __construct(
		Category\Control\Factory $categoryControl,
		Product\Control\Factory $productControl
	) {
		parent::__construct();
		$this->categoryControl = $categoryControl;
		$this->productControl = $productControl;
	}

	public function setCategory(Category\Entity $entity)
	{
		$this->category = $entity;
		unset($this[Category\Control::NAME]);
	}

	public function setProduct(Product\Entity $entity)
	{
		$this->product = $entity;
		unset($this[Product\Control::NAME]);
	}

	protected function createComponentCategory() : Category\Control
	{
		return $this->categoryControl->create($this->category ? : new Category\Entity);
	}

	protected function createComponentProduct() : Product\Control
	{
		return $this->productControl->create($this->product ? : new Product\Entity);
	}
}
