<?php
namespace Ytnuk\Shop\Category\Form;

use Nette;
use Nextras;
use Ytnuk;

/**
 * Class Container
 *
 * @package Ytnuk\Shop
 */
final class Container
	extends Ytnuk\Orm\Form\Container
{

	/**
	 * @var \Ytnuk\Shop\Category\Entity
	 */
	private $entity;

	/**
	 * @var \Ytnuk\Shop\Category\Repository
	 */
	private $repository;

	/**
	 * @inheritDoc
	 */
	public function __construct(
		Ytnuk\Shop\Category\Entity $entity,
		Ytnuk\Shop\Category\Repository $repository
	) {
		parent::__construct(
			$entity,
			$repository
		);
		$this->entity = $entity;
		$this->repository = $repository;
	}

	/**
	 * @inheritdoc
	 */
	public function setValues(
		$values,
		$erase = FALSE
	) {
		$container = parent::setValues(
			$values,
			$erase
		);
		$link = $this->entity->menu->link;
		$link->module = 'Shop:Category';
		if ( ! $link->parameters->get()->getBy(['key' => 'id'])) {
			$linkParameter = new Ytnuk\Link\Parameter\Entity;
			$linkParameter->key = 'id';
			$linkParameter->value = $this->entity->getPersistedId() ? : $this->repository->persist(
				$this->entity
			)->getPersistedId();
			$link->parameters->add($linkParameter);
		}

		return $container;
	}

	/**
	 * @inheritdoc
	 */
	protected function attached($form)
	{
		parent::attached($form);
		unset($this['menu']['link']);
	}

	/**
	 * @param Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata
	 *
	 * @return Nette\Forms\Container
	 */
	protected function addPropertyDescription(Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata)
	{
		return $this->addPropertyOneHasOneDirected(
			$metadata,
			TRUE
		);
	}
}
