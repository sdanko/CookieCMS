<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Block Entity.
 */
class Block extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'alias' => true,
        'body' => true,
        'show_title' => true,
        'region_id' => true,
        'active' => true,
        'element' => true,
        'region' => true,
        'class' => true
    ];
}
