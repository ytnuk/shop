<?php
namespace Ytnuk\Shop\Category;

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
	private $category;

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
		if ( ! $this->category = $this->repository->getById($id)) {
			$this->error();
		}
	}

	public function actionEdit(int $id)
	{
		if ( ! $this->category = $this->repository->getById($id)) {
			$this->error();
		}
	}

	public function renderEdit()
	{
		$this[Ytnuk\Web\Control::NAME][Ytnuk\Menu\Control::NAME][] = 'shop.category.presenter.action.edit';
	}

	protected function createComponentShop() : Ytnuk\Shop\Control
	{
		$shop = parent::createComponentShop();
		if ($this->category) {
			$shop->setCategory($this->category);
		}

		return $shop;
	}

	public function redrawControl(
		string $snippet = NULL,
		bool $redraw = TRUE
	) {
		parent::redrawControl(
			$snippet,
			$redraw
		);
		if ($this->category) {
			$this[Ytnuk\Shop\Control::NAME][Control::NAME]->redrawControl();
		}
	}
}
