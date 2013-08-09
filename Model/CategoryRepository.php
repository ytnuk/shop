<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepository as Repository;
use Nette\Database\Table;
use Nette\Utils\Strings;

final class CategoryRepository extends Repository {

    /**
     * @inject
     * @var CMS\Menu\Component\Menu\MenuControl 
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