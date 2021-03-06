<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('DashedRoute');

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    //$routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
	 $routes->connect('/', ['controller' => 'Content', 'action' => 'promoted']);
	 $routes->connect('/:type', ['controller' => 'Content', 'action' => 'promoted'], ['pass' => ['type']]);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    //$routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
	Router::connect('/content/view/:type/:slug',
	  ['controller' => 'Content', 'action' => 'view'],
	  ['pass' => ['type','slug']]
	);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

Router::prefix('admin', function ($routes) {
	 $routes->extensions(['json']);
    // All routes here will be prefixed with `/admin`
    // And have the prefix => admin route element added.
    $routes->fallbacks('InflectedRoute'); 
    $routes->connect('/', ['controller' => 'Home', 'action' => 'index'], ['routeClass' => 'InflectedRoute']);
	
	$routes->connect(
        '/home/setLocale/:locale', 
        ['controller' => 'Home', 'action' => 'setLocale'],
        [
            'pass' => ['locale',]
        ]
    );
	
	$routes->connect(
        '/links/:menuId', 
        ['controller' => 'Links', 'action' => 'index'],
        [
            'pass' => ['menuId',]
        ]
    );

	$routes->connect(
        '/links/add/:menuId', 
        ['controller' => 'Links', 'action' => 'add'],
        [
            'pass' => ['menuId',]
        ]
    );
	
	$routes->connect(
        '/blocks/:regionId', 
        ['controller' => 'Blocks', 'action' => 'index'],
        [
            'pass' => ['regionId',]
        ]
    );

	$routes->connect(
        '/blocks/add/:regionId', 
        ['controller' => 'Blocks', 'action' => 'add'],
        [
            'pass' => ['regionId',]
        ]
    );
	
	$routes->connect(
        '/links/searchLinks/', 
        ['controller' => 'Links', 'action' => 'searchLinks', '_ext' => 'json']
    );
	
	$routes->connect(
        '/rolesusers/:userId', 
        ['controller' => 'RolesUsers', 'action' => 'index'],
        [
            'pass' => ['userId',]
        ]
    );
	
	$routes->connect(
        '/content/add/:typeAlias', 
        ['controller' => 'Content', 'action' => 'add'],
        [
            'pass' => ['typeAlias',]
        ]
    );
	
	$routes->connect(
        '/content/getComments/', 
        ['controller' => 'Content', 'action' => 'getComments', '_ext' => 'json']
    );
	
	$routes->connect(
        '/content/submitComment/', 
        ['controller' => 'Content', 'action' => 'submitComment', '_ext' => 'json']
    );
	
	$routes->connect(
        '/content/getNodes/', 
        ['controller' => 'Content', 'action' => 'getNodes', '_ext' => 'json']
    );
	
	$routes->connect(
        '/terms/:vocabularyId', 
        ['controller' => 'Terms', 'action' => 'index'],
        [
            'pass' => ['vocabularyId',]
        ]
    );
	
	
	$routes->connect(
        '/terms/add/:vocabularyId', 
        ['controller' => 'Terms', 'action' => 'add'],
        [
            'pass' => ['vocabularyId',]
        ]
    );
	
	$routes->connect(
        '/terms/edit/:id/:vocabularyId', 
        ['controller' => 'Terms', 'action' => 'edit'],
        [
            'pass' => ['id','vocabularyId']
        ]
    );
	
	$routes->connect(
        '/terms/delete/:id/:vocabularyId', 
        ['controller' => 'Terms', 'action' => 'delete'],
        [
            'pass' => ['id','vocabularyId']
        ]
    );
    
    $routes->connect(
        '/users/searchUsers/', 
        ['controller' => 'Users', 'action' => 'searchUsers', '_ext' => 'json']
    );

});


/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();

