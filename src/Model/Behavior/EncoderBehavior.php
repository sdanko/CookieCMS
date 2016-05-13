<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Behavior;

use Cake\ORM\Behavior;

/**
 * CakePHP EncoderBehavior
 * @author DANKO
 */
class EncoderBehavior extends Behavior {

    public function encodeData($data, $options = array())
    {
        $_options = array(
            'json' => false,
            'trim' => true,
        );
        $options = array_merge($_options, $options);

        if (is_array($data) && count($data) > 0) {
            // trim
            if ($options['trim']) {
                $elements = array();
                foreach ($data as $id => $d) {
                    $d = trim($d);
                    if ($d != '') {
                        $elements[$id] = '"' . $d . '"';
                    }
                }
            } else {
                $elements = $data;
            }

            // encode
            if (count($elements) > 0) {
                if ($options['json']) {
                    $output = json_encode($elements);
                } else {
                    $output = '[' . implode(',', $elements) . ']';
                }
            } else {
                $output = '';
            }
        } else {
            $output = '';
        }

        return $output;
    }

    public function decodeData($data) 
    {
        if ($data == '') {
            $output = '';
        } else {
            $output = json_decode($data, true);
        }

        return $output;
    }

}
