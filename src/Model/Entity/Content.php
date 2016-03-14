<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Content Entity.
 *
 * @property int $id
 * @property string $title
 * @property int $content_type_id
 * @property \App\Model\Entity\ContentType $content_type
 * @property bool $active
 * @property string $slug
 * @property string $body
 * @property bool $promote
 * @property \Cake\I18n\Time $publish_start
 * @property \Cake\I18n\Time $publish_end
 * @property \Cake\I18n\Time $created
 * @property int $created_by
 * @property \Cake\I18n\Time $modified
 * @property int $modified_by
 */
class Content extends Entity
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
