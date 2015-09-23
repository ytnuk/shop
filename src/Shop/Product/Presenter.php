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
	private $product;

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
		if ( ! $this->product = $this->repository->getById($id)) {
			$this->error();
		} elseif ($category = $this->product->category) {
			$this[Ytnuk\Web\Control::NAME][Ytnuk\Menu\Control::NAME][] = $category->menu;
		}
		$this[Ytnuk\Web\Control::NAME][Ytnuk\Menu\Control::NAME][] = $this->product->title;
	}

	public function actionEdit(int $id)
	{
		if ( ! $this->product = $this->repository->getById($id)) {
			$this->error();
		}
	}

	public function renderEdit()
	{
		$this[Ytnuk\Web\Control::NAME][Ytnuk\Menu\Control::NAME][] = 'shop.product.presenter.action.edit';
	}

	protected function createComponentShop() : Ytnuk\Shop\Control
	{
		$shop = parent::createComponentShop();
		if ($this->product) {
			$shop->setProduct($this->product);
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
		if ($this->product) {
			$this[Ytnuk\Shop\Control::NAME][Control::NAME]->redrawControl();
		}
	}
}
