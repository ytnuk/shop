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
			$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = $category->menu;
		}
		$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = $this->product->title;
	}

	public function actionEdit(int $id)
	{
		if ( ! $this->product = $this->repository->getById($id)) {
			$this->error();
		}
	}

	public function renderEdit()
	{
		$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = 'shop.product.presenter.action.edit';
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
			$this[Control::class]->redrawControl();
		}
	}

	protected function createComponentYtnukShopProductControl() : Control
	{
		return $this->control->create($this->product ? : new Entity);
	}
}
