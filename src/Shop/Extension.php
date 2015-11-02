<?php
namespace Ytnuk\Shop;

use Kdyby;
use Nette;
use Ytnuk;

final class Extension
	extends Nette\DI\CompilerExtension
	implements Ytnuk\Orm\Provider, Kdyby\Translation\DI\ITranslationProvider
{

	public function loadConfiguration()
	{
		parent::loadConfiguration();
		$builder = $this->getContainerBuilder();
		$builder->addDefinition($this->prefix('control'))->setImplement(Control\Factory::class);
		$builder->addDefinition($this->prefix('category.control'))->setImplement(Category\Control\Factory::class);
		$builder->addDefinition($this->prefix('category.form.control'))->setImplement(Category\Form\Control\Factory::class);
		$builder->addDefinition($this->prefix('product.control'))->setImplement(Product\Control\Factory::class);
		$builder->addDefinition($this->prefix('product.form.control'))->setImplement(Product\Form\Control\Factory::class);
	}

	public function getTranslationResources() : array
	{
		return [
			__DIR__ . '/../../locale',
		];
	}

	public function getOrmResources() : array
	{
		return [
			'repositories' => [
				$this->prefix('categoryRepository') => Category\Repository::class,
				$this->prefix('categoryDescriptionRepository') => Category\Description\Repository::class,
				$this->prefix('productRepository') => Product\Repository::class,
				$this->prefix('productDescriptionRepository') => Product\Description\Repository::class,
				$this->prefix('productContentRepository') => Product\Content\Repository::class,
				$this->prefix('productCategoryRepository') => Product\Category\Repository::class,
			],
		];
	}
}
