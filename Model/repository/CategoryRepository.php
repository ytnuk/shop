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
    protected $name = 'shop_category';

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
    public function getIdsOfParentNodes() {
        $selection = $this->table()->fetchPairs('node_id');
        return array_keys($selection);
    }

    public function insertCategory(array $data) {
        return $this->table()->insert($data);
    }

    public function updateCategory($category, array $data) {
        return $category->update($data);
    }

    public function removeCategory($page) {
        return $page->delete();
    }

}
