<?php

namespace App\Controller\Component;

require_once(ROOT . DS . "Vendor" . DS . "cookie" . DS . "CookieNav.php");

use Cake\Controller;
use Cake\Controller\Component;
use CookieNav;
use Cake\Event\Event;
use Cake\Core\Plugin;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Hash;

class CookieComponent extends Component {

    public $components = ['Auth'];

    public function startup(Event $event) {

        if ((isset($this->request->params['prefix']) && ( $this->request->params['prefix'] == 'admin'))) {
            $this->_adminMenus();
        }
    }

    protected function _adminMenus() {
        CookieNav::add('top-left', 'site', array(
            'title' => 'Visit website',
            'url' => '/',
            'weight' => 0,
            'htmlAttributes' => array(
                'target' => '_blank',
            ),
        ));

        $user = $this->Auth->user();
        $gravatarUrl = '<img src="//www.gravatar.com/avatar/d41d8cd98f00b204e9800998ecf8427e?s=23" class="img-rounded"></img>';
        CookieNav::add('top-right', 'user', array(
            'icon' => false,
            'title' => $user['email'],
            'before' => $gravatarUrl,
            'url' => '#',
            'children' => array(
                'profile' => array(
                    'title' => 'Profile',
                    'icon' => 'user',
                    'url' => '/'
                ),
                'separator-1' => array(
                    'separator' => true,
                ),
                'logout' => array(
                    'icon' => 'off',
                    'title' => 'Logout',
                    'url' => array(
                        'controller' => 'Users',
                        'action' => 'logout'
                    ),
                ),
            ),
        ));

        CookieNav::add('sidebar', 'content', array(
            'icon' => false,
            'title' => '<span class="glyphicon glyphicon-book"></span>' . __d('admin', 'Content'),
            'url' => '#dropdown-content',
            'children' => array(
                'content' => array(
                    'title' =>  __d('admin', 'Content'),
                    'url' => array(
                        'controller' => 'Content',
                        'action' => 'types'
                    ),
                ),
                'content-types' => array(
                    'title' => __d('admin', 'Content Types'),
                    'url' => array(
                        'controller' => 'ContentTypes',
                        'action' => 'index'
                    ),
                ),
            ),
        ));

        CookieNav::add('sidebar', 'layout', array(
            'icon' => false,
            'title' => '<span class="glyphicon glyphicon-edit"></span>' . __d('admin', 'Layout'),
            'url' => '#dropdown-layout',
            'children' => array(
                'blocks' => array(
                    'title' =>  __d('admin', 'Blocks'),
                    'url' => array(
                        'controller' => 'Blocks',
                        'action' => 'index'
                    ),
                ),
                'regions' => array(
                    'title' => __d('admin', 'Regions'),
                    'url' => array(
                        'controller' => 'Regions',
                        'action' => 'index'
                    ),
                ),
                'themes' => array(
                    'title' =>  __d('admin', 'Themes'),
                    'url' => array(
                        'controller' => 'Themes',
                        'action' => 'index'
                    ),
                )
            )
        ));
        
        CookieNav::add('sidebar', 'menus', array(
            'icon' => false,
            'title' => '<span class="glyphicon glyphicon-list-alt"></span>' . __d('admin', 'Menus'),
            'url' => array(
                        'controller' => 'Menus',
                        'action' => 'index'
                    )
        ));
        
        CookieNav::add('sidebar', 'settings', array(
            'icon' => false,
            'title' => '<span class="glyphicon glyphicon-wrench"></span>' . __d('admin', 'Settings'),
            'url' => array(
                        'controller' => 'Settings',
                        'action' => 'index'
                    )
        ));
        
        CookieNav::add('sidebar', 'users', array(
            'icon' => false,
            'title' => '<span class="glyphicon glyphicon-user"></span>' . __d('admin', 'Users'),
            'url' => '#dropdown-users',
            'children' => array(
                'users' => array(
                    'title' =>  __d('admin', 'Users'),
                    'url' => array(
                        'controller' => 'Users',
                        'action' => 'index'
                    ),
                ),
                'roles' => array(
                    'title' =>  __d('admin', 'Roles'),
                    'url' => array(
                        'controller' => 'Roles',
                        'action' => 'index'
                    ),
                )
            )
        ));
        
         CookieNav::add('sidebar', 'taxonomy', array(
            'icon' => false,
            'title' => '<span class="glyphicon glyphicon-book"></span>' . __d('admin', 'Taxonomy'),
            'url' => '#dropdown-taxonomy',
            'children' => array(
                'Vocabulary' => array(
                    'title' =>  __d('admin', 'Vocabulary'),
                    'url' => array(
                        'controller' => 'Vocabularies',
                        'action' => 'index'
                    ),
                )
            )
        ));
    }
    
    public function getThemeData($alias = null) {
        $themeData = array(
            'name' => $alias,
            'regions' => array(),
            'screenshot' => null,
            'settings' => array(
                'css' => array(
                    'columnFull' => 'span12',
                    'columnLeft' => 'span8',
                    'columnRight' => 'span4',
                    'container' => 'container-fluid',
                    'dashboardFull' => 'span12',
                    'dashboardLeft' => 'span6',
                    'dashboardRight' => 'span6',
                    'dashboardClass' => 'sortable-column',
                    'formInput' => 'input-block-level',
                    'imageClass' => '',
                    'row' => 'row-fluid',
                    'tableClass' => 'table',
                    'thumbnailClass' => 'img-polaroid',
                )
            ),
        );

        if ($alias == null || $alias == 'default') {
            $folder = Plugin::path('Default') . 'config';
        } else {
            $folder = Plugin::path($alias) . 'config';
        }
        
        $this->folder = new Folder($folder);
        $configFolderContent = $this->folder->read();

        if (in_array('theme.json', $configFolderContent['1'])) {
            $path=$this->folder->path;
            $themeJson = $path . DS . 'theme.json';

            $contents = file_get_contents($themeJson);
            $json = json_decode($contents, true);
  
            if ($json === null) {
                    $json = array();
            }
            else {
                $themeData = Hash::merge($themeData, $json);
            }            
        }
        
        return $themeData;
    }

}
