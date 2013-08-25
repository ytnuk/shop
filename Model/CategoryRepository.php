<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepository;
use CMS\Component\Menu\MenuControl;
use Nette\Database\SelectionFactory;

final class CategoryRepository extends BaseRepository {

    /**
     * @var MenuControl 
     */
    private $menu;

    public function __construct(SelectionFactory $db, MenuControl $menu) {
        parent::__construct($db);
        $this->menu = $menu;
    }

    public function getCategory($id) {
        return $this->table()->get($id);
    }

    /**
     * @return int[]
     */
    public function getCategoriesIds() {
        $selection = $this->table()->fetchAll();
        return array_keys($selection);
    }

    /**
     * @param int[] $nodes
     * @return int[]
     */
    public function getIdsOfCategoriesInNodes($nodes) {
        $selection = $this->table()->where('node_id', $nodes)->fetchAll();
        return array_keys($selection);
    }

}