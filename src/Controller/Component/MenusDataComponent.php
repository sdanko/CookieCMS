<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Controller\Component;

require_once(ROOT .DS. "Vendor" . DS . "cookie" . DS . "StringConverter.php");

use StringConverter;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Utility\Hash;
use Cake\Core\Configure;

/**
 * CakePHP MenusComponent
 * @author DANKO
 */
class MenusDataComponent extends Component {
    
    public $components = ['Cookie'];

    /**
 * Menus for layout
 *
 * @var string
 * @access public
 */
    public $menusForLayout = array();
    
    public function initialize(array $config) {
            $this->controller = $this->_registry->getController();
            if (isset($this->controller ->Link)) {
                    $this->Link = $this->controller->Link;
            } else {
                    $this->Link = TableRegistry::get('Links');
            }
    }
    
/**
 * Startup
 *
 * @return void
 */
    public function startup(Event $event) {
        if(isset($this->request->params['prefix'])) {
           if ($this->request->params['prefix'] == 'admin')  {
                    return;
            } 
        }
        $this->menus();
    }
    
    /**
 * beforeRender
 *
 * @param object $controller instance of controller
 * @return void
 */
    public function beforeRender(Event $event) {
        $controller = $this->_registry->getController();
        $controller->set('menus_for_layout', $this->menusForLayout);
    }
    
    /**
 * Menus
 *
 * Menus will be available in this variable in views: $menus_for_layout
 *
 * @return void
 */
    public function menus() {
        $menus = array();
        $themeData = $this->Cookie->getThemeData(Configure::read('Site.theme'));
        if (isset($themeData['menus']) && is_array($themeData['menus'])) {
            $menus = Hash::merge($menus, $themeData['menus']);
        }
        $menus = Hash::merge($menus, array_keys($this->controller->BlocksData->blocksData['menus']));

        //$status = $this->Link->status();
        foreach ($menus as $menuAlias) {
            $query = $this->Link->Menus->find('all', [
                  'conditions' => ['Menus.alias' => $menuAlias]
              ]);
            $menu = $query->first();

            if (isset($menu['id'])) {
                    $this->menusForLayout[$menuAlias] = $menu;
                    $findOptions = array(
                            'conditions' => array(
                                    'menu_id' => $menu['id']
                            )
                    );
                    $links = $this->Link->find('threaded', $findOptions)->toArray();
                    $this->menusForLayout[$menuAlias]['threaded'] = $links;
            }
        }
    }
}
