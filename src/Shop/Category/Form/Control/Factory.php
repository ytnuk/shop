<?php
namespace Ytnuk\Shop\Category\Form\Control;

use Ytnuk;

interface Factory
{

	public function create(Ytnuk\Shop\Category\Entity $category) : Ytnuk\Shop\Category\Form\Control;
}
