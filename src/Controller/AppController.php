<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Event\Event;
use Cake\Controller\Controller;
use Cake\Utility\Inflector;
use Cake\I18n\I18n;
use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\I18n\Time;
use \Ceeram\Blame\Controller\BlameTrait;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Traits
     */
    use BlameTrait;
    
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        $this->loadComponent('Flash');
         
       /* $this->loadComponent('Auth', [
               'authorize' => ['Controller'],
               'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password'
                        ],
                        'scope' => ['Users.active' => true],
                        'contain' => ['Roles']
                    ]
                ],
               'loginRedirect' => [
                   'controller' => 'Home',
                   'action' => 'index'
               ],
               'logoutRedirect' => [
                   'controller' => 'Users',
                   'action' => 'login'
               ]
           ]); */
        
         $this->loadComponent('Auth', [
                'loginAction' => [
                    'controller' => 'Users',
                    'action' => 'login'
                ],
				'loginRedirect' => [
                   'controller' => 'Home',
                   'action' => 'index'
				],
                'authError' => 'Did you really think you are allowed to see that?',
                'authenticate' => [
                    'Form' => [
                        'fields' => [
                            'username' => 'email',
                            'password' => 'password'
                        ],
                        'scope' => ['Users.active' => true],
                        'contain' => ['Roles']
                    ]
                ],
                'authorize' => [
                    'TinyAuth.Tiny' => [
                        'roleColumn' => 'role_id',
                        'rolesTable' => 'Roles',
                        'multiRole' => true,
                        'pivotTable' => 'roles_users',
                        'superAdminRole' => null,
                        'authorizeByPrefix' => false,
                        'prefixes' => [],
                        'allowUser' => false,
                        'adminPrefix' => null,
                        'autoClearCache' => true
                    ] 
                ]
            ]
        );
        
        $this->loadComponent('Cookie');
        $this->loadComponent('BlocksData');
        $this->loadComponent('MenusData');
    }
    
    public function beforeFilter(Event $event) 
    {
        parent::beforeFilter($event);
        
        if ((isset( $this->request->params['prefix']) && ( $this->request->params['prefix'] == 'admin'))) 
        {
            //I18n::locale('bs');
            Time::setToStringFormat(Configure::read('Writing.date_time_format'));
            $this->viewBuilder()->theme('Admin');
            //$this->theme  = 'Admin';
            $this->set('title_for_layout', 'Cookie Dashboard');
            $this->set('form_templates', Configure::read('Templates'));
            
            if($this->request->controller!='Home')
            {
                $this->set('breadcrumbs',$this->buildCrumbs());
            }
        }
        else {
            $this->Auth->allow();
            $this->viewBuilder()->theme(Configure::read('Site.theme'));
            //$this->theme  = Configure::read('Site.theme');
        }
    }
    
 /*    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['role']) && $user['role']['title'] === 'Administrator') {
            return true;
        }
        
        // Default deny
        return false;
    } */
    
    public function buildCrumbs()
    {
        $action = $this->request->action;
        $controller = $this->request->controller;
             
        $crumbs = array();
        $crumbs [0] ['text'] = preg_replace('/(?<!\ )[A-Z]/', ' $0', $controller);
        $crumbs [0] ['link'] = ['controller' => $controller, 'action' => 'index'];
        
        if($action!='index')
        {
            $crumbs [1] ['text'] = _(Inflector::humanize($action));
            $crumbs [1] ['link'] = ['controller' => $controller, 'action' => $action]; 
        }
        
        return $crumbs;
    }
}
