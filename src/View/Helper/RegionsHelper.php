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

/**
 * CakePHP RegionsHelper
 * @author DANKO
 */
class RegionsHelper extends Helper {

    /**
     * Region is empty
     *
     * returns true if Region has no Blocks.
     *
     * @param string $regionAlias Region alias
     * @return boolean
     */
    public function isEmpty($regionAlias) {
        if (isset($this->_View->viewVars['blocks_for_layout'][$regionAlias]) &&
                count($this->_View->viewVars['blocks_for_layout'][$regionAlias]) > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Show Block
     *
     * By default block is rendered using Blocks.block element. If `Block.element` is
     * set and exists, the render process will pass it through given element before wrapping
     * it inside the Blocks.block container. You disable the wrapping by setting
     * `enclosure=false` in the `params` field.
     *
     * @param string $blockAlias Block alias
     * @param array $options
     * @return string
     */
    public function block($blockAlias, $options = array()) {
        $output = '';
        if (!$blockAlias) {
            return $output;
        }
        $options = Hash::merge(array(
                    'elementOptions' => array(),
                        ), $options);
        $elementOptions = $options['elementOptions'];

        $defaultElement = 'Blocks/block';
        $blocks = Hash::combine($this->_View->viewVars['blocks_for_layout'], '{s}.{n}.alias', '{s}.{n}');
        if (!isset($blocks[$blockAlias])) {
            return $output;
        }
        $block = $blocks[$blockAlias];

        $element = $block['element'];
        $exists = $this->_View->elementExists($element);
        $blockOutput = '';

        $event = new Event('Helper.Regions.beforeSetBlock', $this->_View, [
            'content' => &$block['body']
        ]);
        EventManager::instance()->dispatch($event);
        

        if ($exists) {
            $blockOutput = $this->_View->element($element, compact('block'), $elementOptions);
        } else {
            if (!empty($element)) {
                $this->log(sprintf('Missing element `%s` in block `%s` (%s)', $block['element'], $block['alias'], $block['id']
                        ), LOG_WARNING);
            }
            $blockOutput = $this->_View->element($defaultElement, compact('block'), array('ignoreMissing' => true) + $elementOptions);
        }


        $event = new Event('Helper.Regions.afterSetBlock', $this->_View, [
            'content' => &$blockOutput
        ]);
        EventManager::instance()->dispatch($event);

        $output .= $blockOutput;

        return $output;
    }

    /**
     * Show Blocks for a particular Region
     *
     * By default block are rendered using Blocks.block element. If `Block.element` is
     * set and exists, the render process will pass it through given element before wrapping
     * it inside the Blocks.block container. You disable the wrapping by setting
     * `enclosure=false` in the `params` field.
     *
     * @param string $regionAlias Region alias
     * @param array $options
     * @return string
     */
    public function blocks($regionAlias, $options = array()) {
        $output = '';
        if ($this->isEmpty($regionAlias)) {
            return $output;
        }

        $options = Hash::merge(array(
                    'elementOptions' => array(),
                        ), $options);

        $defaultElement = 'Blocks/block';
        $blocks = $this->_View->viewVars['blocks_for_layout'][$regionAlias];
        
        foreach ($blocks as $block) {
            $output .= $this->block($block['alias'], $options);
        }

        return $output;
    }
    
}
