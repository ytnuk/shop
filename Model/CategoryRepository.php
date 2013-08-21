<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepositoryLM;
use Nette\Utils\Strings;

final class CategoryRepository extends BaseRepositoryLM {

    /**
     * @inject
     * @var \CMS\Component\Menu\MenuControl 
     */
    public $menu;

    public function getCategory($id) {
        return $this->find($id);
    }

    /**
     * @return int[]
     */
    public function getCategoriesIds() {
        $selection = $this->connection->select('id')->from($this->getTable())->fetchAssoc('id');
        return array_keys($selection);
    }

    /**
     * 
     * @param int[] $nodes
     * @return int[]
     */
    public function getIdsOfCategoriesInNodes($nodes) {
        $selection = $this->connection->select('id')->from($this->getTable())->where('node_id IN (%i)', $nodes)->fetchAssoc('id');
        return array_keys($selection);
    }

}