<?php
namespace Ytnuk\Shop\Product;

use Nette;
use Ytnuk;

final class Presenter
	extends Ytnuk\Shop\Application\Presenter
{

	/**
	 * @var Repository
	 */
	private $repository;

	/**
	 * @var Control\Factory
	 */
	private $control;

	/**
	 * @var Entity
	 */
	private $entity;

	public function __construct(
		Repository $repository,
		Control\Factory $control
	) {
		parent::__construct();
		$this->repository = $repository;
		$this->control = $control;
	}

	public function actionView(int $id)
	{
		if ( ! $this->entity = $this->repository->getById($id)) {
			$this->error();
		} elseif ($category = $this->entity->category) {
			$this['web']['menu'][] = $category->menu;
		}
		$this['web']['menu'][] = $this->entity->title;
	}

	public function actionEdit(int $id)
	{
		if ( ! $this->entity = $this->repository->getById($id)) {
			$this->error();
		}
	}

	public function renderEdit()
	{
		$this['web']['menu'][] = 'shop.product.presenter.action.edit';
	}

	protected function createComponentShop() : Ytnuk\Shop\Control
	{
		$shop = parent::createComponentShop();
		if ($this->entity) {
			$shop->setProduct($this->entity);
		}

		return $shop;
	}
}
