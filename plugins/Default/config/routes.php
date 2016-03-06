<?php
use Cake\Routing\Router;

Router::plugin('Default', function ($routes) {
    $routes->fallbacks('InflectedRoute');
});
