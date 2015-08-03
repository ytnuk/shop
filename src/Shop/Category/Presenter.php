<?php
namespace Ytnuk\Shop\Category;

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
	private $category;

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
		if ( ! $this->category = $this->repository->getById($id)) {
			$this->error();
		}
	}

	/**
	 * @param $id
	 *
	 * @throws Nette\Application\BadRequestException
	 */
	public function actionEdit($id)
	{
		if ( ! $this->category = $this->repository->getById($id)) {
			$this->error();
		}
	}

	public function renderEdit()
	{
		$this[Ytnuk\Web\Control::class][Ytnuk\Menu\Control::class][] = 'shop.category.presenter.action.edit';
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
		if ($this->category) {
			$this[Control::class]->redrawControl();
		}
	}

	/**
	 * @return Control
	 */
	protected function createComponentYtnukShopCategoryControl()
	{
		return $this->control->create($this->category ? : new Entity);
	}
}
