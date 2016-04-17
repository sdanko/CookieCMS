<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Taxonomy Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \App\Model\Entity\Taxonomy $parent_taxonomy
 * @property int $term_id
 * @property \App\Model\Entity\Term $term
 * @property int $vocabulary_id
 * @property \App\Model\Entity\Vocabulary $vocabulary
 * @property int $lft
 * @property int $rght
 * @property \App\Model\Entity\Taxonomy[] $child_taxonomies
 */
class Taxonomy extends Entity
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
