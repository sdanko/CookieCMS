<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Node Entity.
 *
 * @property int $id
 * @property int $content_id
 * @property \App\Model\Entity\Content $content
 * @property string $title
 * @property string $label
 * @property string $description
 * @property int $workflow_id
 * @property \App\Model\Entity\Workflow $workflow
 * @property int $node_type_id
 * @property \App\Model\Entity\NodeType $node_type
 * @property int $node_status_id
 * @property \App\Model\Entity\NodeStatus $node_status
 * @property bool $first
 * @property bool $last
 * @property int $level
 * @property \App\Model\Entity\NodeJob[] $node_jobs
 */
class Node extends Entity
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
