<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\Event\EventManager;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Core\Exception\Exception;
use Cake\ORM\Query;
use Cake\I18n\Time;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP Behavior
 * @author Danko
 */
class PublishableBehavior extends Behavior {

    public function beforeFind(Event $event, Query $query, ArrayObject $options)
    {
        $published = isset($options['published']) ? isset($options['published']) : false;
        
        if ($published && $this->_table->hasField('publish_start') && 
                    $this->_table->hasField('publish_end')){
            $date = Time::now();

           $query->where([
               'publish_start <= ' => $date,
               'OR' => [
                'publish_end >= ' => $date,
                'publish_end is NULL'
                ]
           ]);
        }       
    }

}
