<?php
namespace Ytnuk\Shop\Category;

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
	 * @var Repository
	 */
	private $repository;

	public function __construct(
		Entity $category,
		Form\Control\Factory $formControl,
		Ytnuk\Orm\Grid\Control\Factory $gridControl,
		Repository $repository
	) {
		parent::__construct($category);
		$this->category = $category;
		$this->formControl = $formControl;
		$this->gridControl = $gridControl;
		$this->repository = $repository;
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
			'products' => $this[Ytnuk\Orm\Pagination\Control::class]['products']->getCollection(),
		];
	}

	protected function getViews() : array
	{
		return [
			'view' => function () {
				return [
					$this->category,
					$this[Ytnuk\Orm\Pagination\Control::class]['products'],
				];
			},
		] + parent::getViews();
	}

	protected function createComponentYtnukOrmFormControl() : Form\Control
	{
		return $this->formControl->create($this->category);
	}

	protected function createComponentYtnukGridControl() : Ytnuk\Orm\Grid\Control
	{
		return $this->gridControl->create($this->repository);
	}
}
