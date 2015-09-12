<?php
namespace Ytnuk\Shop\Product;

use Ytnuk;

final class Control
	extends Ytnuk\Orm\Control
{

	/**
	 * @var Entity
	 */
	private $product;

	/**
	 * @var Form\Control\Factory
	 */
	private $formControl;

	/**
	 * @var Ytnuk\Orm\Grid\Control\Factory
	 */
	private $gridControl;

	/**
	 * @var Repository
	 */
	private $repository;

	public function __construct(
		Entity $product,
		Form\Control\Factory $formControl,
		Ytnuk\Orm\Grid\Control\Factory $gridControl,
		Repository $repository
	) {
		parent::__construct($product);
		$this->product = $product;
		$this->formControl = $formControl;
		$this->gridControl = $gridControl;
		$this->repository = $repository;
	}

	protected function startup() : array
	{
		return [
			'product' => $this->product,
		];
	}

	protected function getViews() : array
	{
		return [
			'view' => function () {
				return [
					$this->product,
				];
			},
		] + parent::getViews();
	}

	protected function createComponentYtnukOrmFormControl() : Form\Control
	{
		return $this->formControl->create($this->product);
	}

	protected function createComponentYtnukGridControl() : Ytnuk\Orm\Grid\Control
	{
		return $this->gridControl->create($this->repository);
	}
}
