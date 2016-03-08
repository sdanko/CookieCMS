<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RolesUser Entity.
 */
class RolesUser extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'role' => true,
        'user' => true,
    ];
}
