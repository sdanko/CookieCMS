<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Contacts',
    ['path' => '/contacts'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
