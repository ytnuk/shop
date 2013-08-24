<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepository;

final class CategoryRepository extends BaseRepository {

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
        $rows = $this->connection->select('id')->from($this->getTable())->fetchAssoc('id');

        return array_keys($rows);
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