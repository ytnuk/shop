<?php

namespace CMS\Shop\Model;

use CMS\Model\BaseRepository as Repository;
use Nette\Database\SelectionFactory;
use Nette\Database\Table;
use Nette\Utils\Strings;
use CMS\Menu\Component\Menu\MenuFactory;
use CMS\Menu\Component\Menu\MenuControl;

final class CategoryRepository extends Repository {

    /**
     * @var MenuControl 
     */
    private $menu;

    /**
     * 
     * @param Database $db
     * @param NodeRepository $menu
     */
    public function __construct(SelectionFactory $db, MenuFactory $menu) {
        parent::__construct($db);
        $this->menu = $menu->create();
    }

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