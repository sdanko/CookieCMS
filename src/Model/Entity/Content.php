<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Content Entity.
 */
class Content extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'content_type_id' => true,
        'active' => true,
        'create_date' => true,
        'modified_date' => true,
        'slug' => true,
        'body' => true,
        'promote' => true,
        'publish_start' => true,
        'publish_end' => true,
        'content_type' => true,
    ];
    
//     protected function _getUrl() {
//        $url = array(
//            'controller' => 'content',
//            'action' => 'view',
//            array(
//                'slug' => $this->_properties['slug'],
//                'type' => $this->_properties['content_type']['alias'])
//        );
//        return $url;
//    }

}
