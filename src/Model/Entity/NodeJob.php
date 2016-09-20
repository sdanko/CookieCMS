<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * NodeJob Entity.
 *
 * @property int $id
 * @property int $node_id
 * @property \App\Model\Entity\Node $node
 * @property string $text
 * @property string $title
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property bool $finished
 * @property int $node_job_type_id
 * @property \App\Model\Entity\NodeJobType $node_job_type
 * @property \App\Model\Entity\NodeFlow[] $node_flows
 */
class NodeJob extends Entity
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
