<?php

namespace App\View\Helper;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once(ROOT . DS . "Vendor" . DS . "cookie" . DS . "StringConverter.php");

use StringConverter;
use Cake\View\Helper;
use Cake\Routing\Router;
use Cake\View\View;
use Cake\Event\Event;
use Cake\Event\EventManager;

/**
 * CakePHP TaxonomiesHelper
 * @author DANKO
 */
class TaxonomiesHelper extends Helper {

    var $helpers = array('Html', 'Url');

    public function __construct(View $view, array $config = []) 
    {
        parent::__construct($view, $config);
        $this->_converter = new StringConverter();
        $this->_setupEvents();
    }

    protected function _setupEvents() 
    {
        $events = [
            'filter' => [$this, 'filter']
        ];

        foreach ($events as $callable) {
            EventManager::instance()->on("Helper.Layout.beforeFilter", $callable);
        }
    }

    /**
     * Filter content for Vocabularies
     *
     * Replaces [vocabulary:vocabulary_alias] or [v:vocabulary_alias] with Terms list
     *
     * @param string $content
     * @return string
     */
    public function filter($event) 
    {
        $content = & $event->data['content'];
        preg_match_all('/\[(vocabulary|v):([A-Za-z0-9_\-]*)(.*?)\]/i', $content, $tagMatches);
        for ($i = 0, $ii = count($tagMatches[1]); $i < $ii; $i++) {
            $regex = '/(\S+)=[\'"]?((?:.(?![\'"]?\s+(?:\S+)=|[>\'"]))+.)[\'"]?/i';
            preg_match_all($regex, $tagMatches[3][$i], $attributes);
            $vocabularyAlias = $tagMatches[2][$i];
            $options = array();
            for ($j = 0, $jj = count($attributes[0]); $j < $jj; $j++) {
                $options[$attributes[1][$j]] = $attributes[2][$j];
            }
            $content = str_replace($tagMatches[0][$i], $this->vocabulary($vocabularyAlias, $options), $content);
        }
        return $content;
    }

    /**
     * Show Vocabulary by Alias
     *
     * @param string $vocabularyAlias Vocabulary alias
     * @param array $options (optional)
     * @return string
     */
    public function vocabulary($vocabularyAlias, $options = array())
    {
        $_options = array(
            'tag' => 'ul',
            'tagAttributes' => array(),
            'type' => null,
            'link' => true,
            'controller' => 'Content',
            'action' => 'term',
            'element' => 'Vocabularies/vocabulary'
        );
        $options = array_merge($_options, $options);

        $output = '';
        if (isset($this->_View->viewVars['vocabularies_for_layout'][$vocabularyAlias]['threaded'])) {
            $vocabulary = $this->_View->viewVars['vocabularies_for_layout'][$vocabularyAlias];
            $output .= $this->_View->element($options['element'], array(
                'vocabulary' => $vocabulary,
                'options' => $options,
            ));
        }
        return $output;
    }

    /**
     * Nested Terms
     *
     * @param array   $terms
     * @param array   $options
     * @param integer $depth
     */
    public function nestedTerms($taxonomies, $options, $depth = 1)
    {
        $_options = array();
        $options = array_merge($_options, $options);

        $output = '';
        foreach ($taxonomies as $taxonomy) {
            if ($options['link']) {
                $termAttr = array(
                    'id' => 'term-' . $taxonomy->term->id,
                );
                $termOutput = $this->Html->link($taxonomy->term->title, array(
                    'controller' => $options['controller'],
                    'action' => $options['action'],
                    'type' => $options['type'],
                    'slug' => $taxonomy->term->slug,
                        ), $termAttr);
            } else {
                $termOutput = $taxonomy->term->title;
            }
            if (isset($taxonomy->children) && count($taxonomy->children) > 0) {
                $termOutput .= $this->nestedTerms($taxonomy->children, $options, $depth + 1);
            }
            $termOutput = $this->Html->tag('li', $termOutput);
            $output .= $termOutput;
        }
        if ($output != null) {
            $output = $this->Html->tag($options['tag'], $output, $options['tagAttributes']);
        }

        return $output;
    }

}
