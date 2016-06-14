<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Block Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string $body
 * @property bool $show_title
 * @property int $region_id
 * @property \App\Model\Entity\Region $region
 * @property bool $active
 * @property string $element
 * @property string $class
 * @property int $position
 */
class Block extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
