<?php
namespace Ytnuk\Shop\Category\Control;

use Ytnuk;

interface Factory
{

	public function create(Ytnuk\Shop\Category\Entity $category) : Ytnuk\Shop\Category\Control;
}
