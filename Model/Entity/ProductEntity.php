<?php

namespace CMS\Model\Entity;

/**
 * @property int $id
 * @property Category $category m:hasOne
 * @property string $title
 * @property string|NULL $description
 * @property string|NULL $content
 * @property int $price
 */
class Product extends \LeanMapper\Entity {
    
}