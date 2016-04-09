<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ContentTypesVocabulary Entity.
 *
 * @property int $id
 * @property int $content_type_id
 * @property \App\Model\Entity\ContentType $content_type
 * @property int $vocabulary_id
 * @property \App\Model\Entity\Vocabulary $vocabulary
 */
class ContentTypesVocabulary extends Entity
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
