<?php

namespace App\Model\Behavior;

use Cake\ORM\Behavior;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP Behavior
 * @author Danko
 */
class CommentableBehavior extends Behavior {

    public function initialize(array $config)
    {
        $this->_setupRelationships();
    }
    
    protected function _setupRelationships()
    {
	  $this->_table->hasMany('Comments', [
            'foreignKey' => 'foreign_key',
            'dependent' => true,
            'conditions' => [
                'model' => $this->_table->alias(),
                'status' => (bool)1,
            ]
        ]);	
    }
    
    public function addComment(Model $Model, $data, $options = array())
    {
        if (!isset($Model->id)) {
                throw new UnexpectedValueException('Id is not set');
        }
        return $Model->Comment->add($data, $Model->alias, $Model->id, $options);
    }

}
