<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContentType Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $alias
 * @property bool $format_show_author
 * @property bool $format_show_date
 * @property \App\Model\Entity\Content[] $content
 * @property \App\Model\Entity\Vocabulary[] $vocabularies
 */
class ContentType extends Entity
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
