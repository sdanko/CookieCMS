<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NodeFlow Entity.
 *
 * @property int $id
 * @property int $node_edge_id
 * @property \App\Model\Entity\NodeEdge $node_edge
 * @property int $node_job_id
 * @property \App\Model\Entity\NodeJob $node_job
 */
class NodeFlow extends Entity
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
