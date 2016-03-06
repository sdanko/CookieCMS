<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Region Entity.
 */
class Region extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'alias' => true,
        'active' => true,
        'blocks' => true,
    ];
}
