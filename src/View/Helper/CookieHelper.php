<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;
use Cake\View\UrlHelper;

class CookieHelper extends Helper {

    var $helpers = array('Html', 'Url');

    public function adminMenus($menus, $options = array(), $depth = 0) {
        $options = Hash::merge(array(
                    'type' => 'sidebar',
                    'children' => true,
                    'htmlAttributes' => array(
                        'class' => 'nav navbar-nav',
                    ),
                        ), $options);


        $sidebar = $options['type'] === 'sidebar';
        $htmlAttributes = $options['htmlAttributes'];
        $out = null;
        $sorted = Hash::sort($menus, '{s}.weight', 'ASC');


        foreach ($sorted as $menu) {
            if (isset($menu['separator'])) {
                $liOptions['class'] = 'divider';
                $out .= $this->Html->tag('li', null, $liOptions);
                continue;
            }

            $title = '';
            if ($menu['icon'] === false) {
                
            } else {
                $title .= '<i class="'. $menu['icon'] . '"></i> ';
            }

            $title .= $menu['title'];

            $children = '';
            if (!empty($menu['children'])) {
                $childClass = '';
                if ($sidebar) {
                    $children = $this->adminSidebarChildren($menu['children'], $menu['url'], array(
                        'type' => $options['type'],
                        'children' => true,
                        'htmlAttributes' => array('class' => $childClass),
                            ), $depth + 1);
                } else {
                    $menu['htmlAttributes']['class'] = ' dropdown';
                    if ($depth == 0) {
                        $childClass = 'dropdown-menu';
                    }

                    $children = $this->adminMenus($menu['children'], array(
                        'type' => $options['type'],
                        'children' => true,
                        'htmlAttributes' => array('class' => $childClass),
                            ), $depth + 1);
                }
            }
            //$menu['htmlAttributes']['class'] .= ' sidebar-item';

            $menuUrl = $this->Url->build($menu['url']);
            $liOptions = array();
            if ($menuUrl == env('REQUEST_URI')) {
//				if (isset($menu['htmlAttributes']['class'])) {
//					$menu['htmlAttributes']['class'] .= ' active';
//				} else {
//					$menu['htmlAttributes']['class'] = 'active';
//				}

                $liOptions['class'] = "active";
//                              $title .= ' <span class="sr-only">(current)</span>';
            }

            if (!$sidebar && !empty($children)) {
                if ($depth == 0) {
                    $title .= ' <b class="caret"></b>';
                }
                $menu['htmlAttributes']['class'] = 'dropdown-toggle';
                $menu['htmlAttributes']['data-toggle'] = 'dropdown';
            }

            if ($sidebar && !empty($children)) {
                if ($depth == 0) {
                    $title .= ' <span class="caret"></span>';
                }
                $menu['htmlAttributes']['data-toggle'] = 'collapse';
            }

            if (isset($menu['before'])) {
                $title = $menu['before'] . $title;
            }

            if (isset($menu['after'])) {
                $title = $title . $menu['after'];
            }

            $menu['htmlAttributes']['escape'] = false;
            $link = $this->Html->link($title, $menu['url'], $menu['htmlAttributes']);


//			if ($sidebar && !empty($children) && $depth > 0) {
//				$liOptions['class'] = ' dropdown-submenu';
//			}
            if (!$sidebar && !empty($children)) {
                if ($depth > 0) {
                    $liOptions['class'] = ' dropdown-submenu';
                } else {
                    $liOptions['class'] = ' dropdown';
                }
            }

            if ($sidebar && !empty($children)) {
                $liOptions['class'] = ' panel panel-default';
                $liOptions['id'] = 'dropdown';
            }

            $out .= $this->Html->tag('li', $link . $children, $liOptions);
        }

        if (!$sidebar && $depth > 0) {
            $htmlAttributes['class'] = 'dropdown-menu';
        }

        if (!$sidebar && $depth == 0) {
            return $out;
        }

        return $this->Html->tag('ul', $out, $htmlAttributes);
    }

    public function adminSidebarChildren($menus, $href, $options = array(), $depth = 0) {
        $htmlAttributes = $options['htmlAttributes'];
        $out = null;
        $sorted = Hash::sort($menus, '{s}.weight', 'ASC');

        foreach ($sorted as $menu) {
            $title = '';

            $title .= $menu['title'];

            //$menu['htmlAttributes']['class'] .= ' sidebar-item';

            $menuUrl = $this->Url->build($menu['url']);
            $liOptions = array();
            
            $menuUrl = $this->Url->build($menu['url']);
            if ($menuUrl == env('REQUEST_URI')) {
                $liOptions['class'] = "active";
            }

            if (isset($menu['before'])) {
                $title = $menu['before'] . $title;
            }

            if (isset($menu['after'])) {
                $title = $title . $menu['after'];
            }

            $menu['htmlAttributes']['escape'] = false;
            $link = $this->Html->link($title, $menu['url'], $menu['htmlAttributes']);


            $out .= $this->Html->tag('li', $link, $liOptions);
        }

        $htmlAttributes['class'] = 'nav navbar-nav';

        $ul = $this->Html->tag('ul', $out, $htmlAttributes);

        $div = $this->Html->tag('div', $ul, ['class' => 'panel-body']);

        return $this->Html->tag('div', $div, ['class' => 'panel-collapse collapse', 'id' => str_replace('#', '', $href)]);
    }

}
