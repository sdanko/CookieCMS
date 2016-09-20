<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NodeType Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $config
 * @property \App\Model\Entity\Node[] $nodes
 */
class NodeType extends Entity
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
