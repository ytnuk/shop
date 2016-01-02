<?php
namespace Ytnuk\Shop\Category;

use Nette;
use Ytnuk;

final class Repository
	extends Ytnuk\Orm\Repository
	implements Ytnuk\Web\Domain\Router\Filter\Out
{

	public static function getEntityClassNames() : array
	{
		return [
			Entity::class,
		];
	}

	public function filterOut(
		array $params,
		array & $dependencies = []
	) : array
	{
		if ($params['presenter'] === 'Shop:Category:Presenter' && $id = $params['id'] ?? NULL) {
			if ($entity = $this->getById($id)) {
				if ($entity instanceof Ytnuk\Cache\Provider) {
					$dependencies = array_merge_recursive($dependencies, [
						Nette\Caching\Cache::TAGS => $entity->getCacheTags(),
					]);
				}
				$params['slug'] = Nette\Utils\Strings::webalize($entity);
			}
		}

		return $params;
	}
}
