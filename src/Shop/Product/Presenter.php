<?php
namespace Ytnuk\Shop\Product;

use Nette;
use Ytnuk;

/**
 * Class Presenter
 *
 * @package Ytnuk\Shop
 */
final class Presenter
	extends Ytnuk\Shop\Presenter
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

	/**
	 * @param Repository $repository
	 * @param Control\Factory $control
	 */
	public function __construct(
		Repository $repository,
		Control\Factory $control
	) {
		parent::__construct();
		$this->repository = $repository;
		$this->control = $control;
	}

	/**
	 * @param int $id
	 *
	 * @throws \Nette\Application\BadRequestException
	 */
	public function actionView($id)
	{
		if ( ! $this->product = $this->repository->getById($id)) {
			$this->error();
		} elseif ($category = $this->product->category) {
			$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = $category->menu;
		}
		$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = $this->product->title;
	}

	/**
	 * @param $id
	 *
	 * @throws Nette\Application\BadRequestException
	 */
	public function actionEdit($id)
	{
		if ( ! $this->product = $this->repository->getById($id)) {
			$this->error();
		}
	}

	public function renderEdit()
	{
		$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = 'shop.product.presenter.action.edit';
	}

	/**
	 * @inheritdoc
	 */
	public function redrawControl(
		$snippet = NULL,
		$redraw = TRUE
	) {
		parent::redrawControl(
			$snippet,
			$redraw
		);
		if ($this->product) {
			$this[Control::class]->redrawControl();
		}
	}

	/**
	 * @return Control
	 */
	protected function createComponentYtnukShopProductControl()
	{
		return $this->control->create($this->product ? : new Entity);
	}
}
