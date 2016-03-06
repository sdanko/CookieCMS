<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Link Entity.
 */
class Link extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'parent_id' => true,
        'menu_id' => true,
        'link' => true,
        'title' => true,
        'parent_link' => true,
        'menu' => true,
        'child_links' => true,
    ];
}
