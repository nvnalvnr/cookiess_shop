<?php

// =====================
// AUTH
// =====================
$routes['GET']['auth/login'] = 'AuthController@loginForm';
$routes['POST']['auth/login'] = 'AuthController@login';
$routes['GET']['auth/register'] = 'AuthController@registerForm';
$routes['POST']['auth/register'] = 'AuthController@register';
$routes['GET']['auth/logout'] = 'AuthController@logout';


// =====================
// DASHBOARD
// =====================
$routes['GET']['dashboard'] = 'DashboardController@index';


// =====================
// PRODUCT / CATALOG
// =====================
$routes['GET']['catalog'] = 'CatalogController@index';
$routes['GET']['product/show'] = 'ProductController@show';


// =====================
// ORDER
// =====================
$routes['GET']['order/form'] = 'OrderController@form';
$routes['POST']['order/store'] = 'OrderController@store';
$routes['GET']['my-orders'] = 'OrderController@myOrders';


// =====================
// DEFAULT (optional)
// =====================
$routes['GET'][''] = 'AuthController@loginForm';