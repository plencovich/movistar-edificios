<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'errors/error_404';
$route['translate_uri_dashes'] = FALSE;

$route['403'] = 'errors/error_403';

// Backend
$route['acceso']['GET'] = 'auth/access_get';
$route['recuperar']['GET'] = 'auth/recovery_get';
$route['reiniciar/(:any)']['GET'] = 'auth/reset_get/$1';
$route['registro']['GET'] = 'auth/register_get';
$route['salir'] = 'auth/logout';

$route['check/(:any)']['POST'] = 'auth/validate_post/$1';
$route['check/(:any)/(:any)']['POST'] = 'auth/validate_post/$1/$2';

$route['usuarios/(:any)']['GET'] = 'users/main_get/$1';
$route['usuarios/(:any)/edit/(:any)']['GET'] = 'users/sheet_get/$1/$2';
$route['usuarios/(:any)/(:any)']['GET'] = 'users/sheet_get/$1';
$route['usuarios/(:any)/(:any)']['POST'] = 'users/sheet_post/$1/$2';

$route['perfil']['GET'] = 'profile/action_get';
$route['perfil']['POST'] = 'profile/action_post';

$route['listado']['GET'] = 'buildings/list_get';
$route['listado']['POST'] = 'buildings/list_post';

$route['ajax/city/list/(:any)']['POST'] = 'auth/city_list_post/$1';
$route['ajax/city-region/list/(:any)']['POST'] = 'buildings/city_region_list_post/$1';
$route['ajax/street/list/(:any)']['POST'] = 'buildings/street_list_post/$1';

$route['(:any)']['GET'] = 'buildings/sheet_get/$1';
$route['(:any)/(:any)']['GET'] = 'buildings/sheet_get/$1/$2';
$route['(:any)']['POST'] = 'buildings/sheet_post/$1';
