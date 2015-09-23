<?php
namespace Ytnuk\Shop\Application;

use Ytnuk;

abstract class Presenter
	extends Ytnuk\Web\Application\Presenter
{

	/**
	 * @var Ytnuk\Shop\Control\Factory
	 */
	private $control;

	public function injectShop(Ytnuk\Shop\Control\Factory $control)
	{
		$this->control = $control;
	}

	protected function createComponentShop() : Ytnuk\Shop\Control
	{
		return $this->control->create();
	}
}
