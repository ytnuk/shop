<?php
namespace Ytnuk\Shop\Product\Form;

use Nette;
use Nextras;
use Ytnuk;

final class Container
	extends Ytnuk\Orm\Form\Container
{

	/**
	 * @var Ytnuk\Shop\Product\Entity
	 */
	private $entity;

	/**
	 * @var Ytnuk\Shop\Product\Repository
	 */
	private $repository;

	public function __construct(
		Ytnuk\Shop\Product\Entity $entity,
		Ytnuk\Shop\Product\Repository $repository
	) {
		parent::__construct(
			$entity,
			$repository
		);
		$this->entity = $entity;
		$this->repository = $repository;
	}

	protected function attached($form)
	{
		parent::attached($form);
		unset($this['link']);
	}

	public function setValues(
		$values,
		$erase = FALSE
	) : Ytnuk\Orm\Form\Container
	{
		$link = $this->entity->link;
		$link->module = 'Shop:Product';
		$container = parent::setValues(
			$values,
			$erase
		);
		if ( ! $link->parameters->get()->getBy(['key' => $key = current($this->repository->getEntityMetadata()->getPrimaryKey())])) {
			$linkParameter = new Ytnuk\Link\Parameter\Entity;
			$linkParameter->key = $key;
			$linkParameter->value = $this->entity->getPersistedId() ? : $this->repository->persist(
				$this->entity
			)->getPersistedId();
			$link->parameters->add($linkParameter);
		}

		return $container;
	}

	protected function addPropertyDescription(Nextras\Orm\Entity\Reflection\PropertyMetadata $metadata)
	{
		return $this->addPropertyOneHasOne(
			$metadata,
			TRUE
		);
	}
}
