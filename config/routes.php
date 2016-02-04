<?php

use Lib\Core\Route;
use App\Controllers;

$route = new Route();

// $route->get('/', function () {
//     return 'index';
// });

$route->get('/', 'PageController@getIndex');
$route->get('/404', 'ErrorController@notFound');

$route->get('/post/create', 'PostController@create');
$route->post('/post/create', 'PostController@store');
$route->get('/post/show', 'PostController@show');
$route->get('/post/edit', 'PostController@edit');
$route->post('/post/update', 'PostController@update');
$route->get('/post/delete', 'PostController@destroy');

$route->get('/about', 'PageController@getAbout');

