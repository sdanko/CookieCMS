<?php

namespace App\View\Helper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Cake\View\Helper;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Utility\Hash;

class SearchHelper extends Helper {

    public function search($options = array())
    {
            $_options = array(
                    'class' => '',
                    'placeholder' => 'Search',
                    'element' => 'Search/search',
            );
            $options = array_merge($_options, $options);

            $output = $this->_View->element($options['element'], array(
                    'options' => $options
            ));
            return $output;
    }

}
