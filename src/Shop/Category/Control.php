<?php
namespace Ytnuk\Shop\Category;

use Nette;
use Ytnuk;

final class Control
	extends Ytnuk\Orm\Control
{

	/**
	 * @var Entity
	 */
	private $category;

	/**
	 * @var Form\Control\Factory
	 */
	private $formControl;

	/**
	 * @var Ytnuk\Orm\Grid\Control\Factory
	 */
	private $gridControl;

	/**
	 * @var Ytnuk\Shop\Product\Control\Factory
	 */
	private $productControl;

	/**
	 * @var Ytnuk\Shop\Product\Repository
	 */
	private $productRepository;

	/**
	 * @var Repository
	 */
	private $repository;

	public function __construct(
		Entity $category,
		Repository $repository,
		Form\Control\Factory $formControl,
		Ytnuk\Orm\Grid\Control\Factory $gridControl,
		Ytnuk\Shop\Product\Control\Factory $productControl,
		Ytnuk\Shop\Product\Repository $productRepository
	) {
		parent::__construct($category);
		$this->category = $category;
		$this->repository = $repository;
		$this->formControl = $formControl;
		$this->gridControl = $gridControl;
		$this->productControl = $productControl;
		$this->productRepository = $productRepository;
	}

	protected function startup() : array
	{
		return [
			'category' => $this->category,
		];
	}

	protected function renderView() : array
	{
		return [
			'products' => $this['pagination']['products'],
		];
	}

	protected function getViews() : array
	{
		return [
			'view' => function () {
				return [
					$this->category,
					$this['pagination']['products'],
				];
			},
		] + parent::getViews();
	}

	protected function createComponentForm() : Form\Control
	{
		return $this->formControl->create($this->category);
	}

	protected function createComponentGrid() : Ytnuk\Orm\Grid\Control
	{
		return $this->gridControl->create($this->repository);
	}

	protected function createComponentProduct() : Nette\Application\UI\Multiplier
	{
		return new Nette\Application\UI\Multiplier(
			function ($id) : Ytnuk\Shop\Product\Control {
				$entity = $this->productRepository->getById($id);
				if ($entity instanceof Ytnuk\Shop\Product\Entity) {
					return $this->productControl->create($entity);
				}

				return NULL;
			}
		);
	}
}
