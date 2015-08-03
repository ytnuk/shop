<?php
namespace Ytnuk\Shop;

use Kdyby;
use Nette;
use Ytnuk;

/**
 * Class Extension
 *
 * @package Ytnuk\Shop
 */
final class Extension
	extends Nette\DI\CompilerExtension
	implements Ytnuk\Config\Provider
{

	/**
	 * @inheritdoc
	 */
	public function getConfigResources()
	{
		return [
			Ytnuk\Orm\Extension::class => [
				'repositories' => [
					$this->prefix('categoryRepository') => Category\Repository::class,
					$this->prefix('categoryDescriptionRepository') => Category\Description\Repository::class,
					$this->prefix('productRepository') => Product\Repository::class,
					$this->prefix('productDescriptionRepository') => Product\Description\Repository::class,
					$this->prefix('productContentRepository') => Product\Content\Repository::class,
					$this->prefix('productCategoryRepository') => Product\Category\Repository::class,
				],
			],
			Kdyby\Translation\DI\TranslationExtension::class => [
				'dirs' => [
					__DIR__ . '/../../locale',
				],
			],
			'services' => [
				Category\Control\Factory::class,
				Category\Form\Control\Factory::class,
				Product\Control\Factory::class,
				Product\Form\Control\Factory::class,
			],
		];
	}
}
