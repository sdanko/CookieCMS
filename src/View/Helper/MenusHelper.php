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
 * CakePHP MenusHelper
 * @author DANKO
 */
class MenusHelper extends Helper {
    
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
 * Filter content for Menus
 *
 * Replaces [menu:menu_alias] or [m:menu_alias] with Menu list
 *
 * @param string $content
 * @return string
 */
    public function filter($event) 
    {
        $content = & $event->data['content'];
        preg_match_all('/\[(menu|m):([A-Za-z0-9_\-]*)(.*?)\]/i', $content, $tagMatches);
        for ($i = 0, $ii = count($tagMatches[1]); $i < $ii; $i++) 
        {
                $regex = '/(\S+)=[\'"]?((?:.(?![\'"]?\s+(?:\S+)=|[>\'"]))+.)[\'"]?/i';
                preg_match_all($regex, $tagMatches[3][$i], $attributes);
                $menuAlias = $tagMatches[2][$i];
                $options = array();
                for ($j = 0, $jj = count($attributes[0]); $j < $jj; $j++) {
                        $options[$attributes[1][$j]] = $attributes[2][$j];
                }
                $content = str_replace($tagMatches[0][$i], $this->menu($menuAlias, $options), $content);
        }
        return $content;
    }

/**
 * Show Menu by Alias
 *
 * @param string $menuAlias Menu alias
 * @param array $options (optional)
 * @return string
 */
    public function menu($menuAlias, $options = array())
    {
            $_options = array(
                    'tag' => 'ul',
                    'tagAttributes' => array(),
                    'selected' => 'selected',
                    'dropdown' => false,
                    'dropdownClass' => 'sf-menu',
                    'element' => 'Menus/menu',
                    'listed' => 'true',
                    'tagged' => 'true',
                    'linkClass' => ''
            );
            $options = array_merge($_options, $options);
            if (!isset($this->_View->viewVars['menus_for_layout'][$menuAlias])) {
                    return false;
            }
            $menu = $this->_View->viewVars['menus_for_layout'][$menuAlias];
            $output = $this->_View->element($options['element'], array(
                    'menu' => $menu,
                    'options' => $options,
            ));
            return $output;
    }
    
    /**
     * Nested Links
     *
     * @param array $links model output (threaded)
     * @param array $options (optional)
     * @param integer $depth depth level
     * @return string
     */
    public function nestedLinks($links, $options = array(), $depth = 1)
    {
        $_options = array();
        $options = array_merge($_options, $options);
        
        //$linkUrl=array();
        $output = '';
        foreach ($links as $link) {
            $linkAttr = array(
                'id' => 'link-' . $link['id'],
                'title' => $link['title'],
                'class' => $options['linkClass']
            );

            $linkAttr = $this->_mergeLinkParams($link, 'linkAttr', $linkAttr);

            // if link is in the format: controller:contacts/action:view
            if (strstr($link['link'], 'controller:')) {
                $linkUrl = $this->linkStringToArray($link['link']);
            } else {
                 $linkUrl = $link['link'];
            }

            $currentUrl = $this->_View->request->url;
            if (Router::url($linkUrl) == Router::url('/' . $currentUrl)) {
                if (!isset($linkAttr['class'])) {
                    $linkAttr['class'] = '';
                }
                $linkAttr['class'] .= ' ' . $options['selected'];
            }
            
            $linkOutput = $this->Html->link($link['title'], $linkUrl, $linkAttr);
            if (isset($link['children']) && count($link['children']) > 0) {
                $linkOutput .= $this->nestedLinks($link['children'], $options, $depth + 1);
            }
            $liAttr = $this->_mergeLinkParams($link, 'liAttr');
            if($options['listed']=='true') {
                $linkOutput = $this->Html->tag('li', $linkOutput, $liAttr);
            }

            $output .= $linkOutput;
        }
        if ($output != null) {
            $tagAttr = $options['tagAttributes'];
            if ($options['dropdown'] && $depth == 1) {
                $tagAttr['class'] = $options['dropdownClass'];
            }
            if($options['tagged']=='true') {
                 $output = $this->Html->tag($options['tag'], $output, $tagAttr);
            }
           
        }
        
        return $output;
    }
    
    /**
     * Merge Link options retrieved from Params behavior
     *
     * @param array $link Link data
     * @param string $param Parameter name
     * @param array $attributes Default options
     * @return string
     */
    protected function _mergeLinkParams($link, $param, $options = array())
    {
        if (isset($link['Params'][$param])) {
            $options = array_merge($options, $link['Params'][$param]);
        }

        $booleans = array('true', 'false');
        foreach ($options as $key => $val) {
            if ($val == null) {
                unset($options[$key]);
            }
            if (is_string($val) && in_array(strtolower($val), $booleans)) {
                $options[$key] = (bool) $val;
            }
        }

        return $options;
    }
    
    /**
     * Converts strings like controller:abc/action:xyz/ to arrays
     *
     * @param string|array $link link
     * @return array
     * @see Use StringConverter::linkStringToArray()
     */
    public function linkStringToArray($link)
    {
        return $this->_converter->linkStringToArray($link);
    }
    
    /**
     * Converts array into string controller:abc/action:xyz/value1/value2
     *
     * @param array $url link
     * @return array
     * @see StringConverter::urlToLinkString()
     */
    public function urlToLinkString($url)
    {
        return $this->_converter->urlToLinkString($url);
    }

}
