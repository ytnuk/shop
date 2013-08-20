<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepository;
use Nette\Database\Table;
use Nette\Utils\Strings;

final class CategoryRepository extends BaseRepository {

    /**
     * @inject
     * @var \CMS\Component\Menu\MenuControl 
     */
    public $menu;

    /**
     * 
     * @param int $id
     * @return Table\ActiveRow
     */
    public function getCategory($id) {
        return $this->table()->get($id);
    }

    public function getCategoriesIds() {
        return array_keys($this->table()->fetchPairs('id'));
    }

    public function getCategoriesInNodes($nodes) {
        return array_keys($this->table()->where('node_id', $nodes)->fetchPairs('id'));
    }

    /**
     * 
     * @param string $title
     * @return int
     */
    public function filterIn($title) {
        $id = substr($title, strrpos($title, '/') + 1);
        return $id;
    }

    /**
     * 
     * @param int $id
     * @return string
     */
    public function filterOut($id) {
        $category = $this->getCategory($id);
        return Strings::webalize($category->node->title) . '/' . $id;
    }

}