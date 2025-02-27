<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/apioilprice', 'APIOilController::index');

$routes->get('/bangchak', 'BangchakController::index');
$routes->get('/bangchakprice', 'BangchakController::price');
$routes->post('/bangchak/getPricesByDate', 'BangchakController::getPricesByDate');
$routes->get('/bangchak/fetch', 'BangchakController::fetchToTable');