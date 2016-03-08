<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContentType Entity.
 */
class ContentType extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'description' => true,
        'alias' => true,
    ];
}
