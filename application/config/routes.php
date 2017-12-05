<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
/*
$route['test'] = 'test';

$route['counter'] = 'counter';
$route['counter/(:any)'] = 'counter/$1';

$route['post'] = 'post';
$route['p/(:any)'] = 'post/$1';

$route['files'] = 'files';
$route['files/(:any)'] = 'files/$1';

$route['admin'] = 'administration';
$route['u/(:any)'] = 'administration/$1';

$route['message'] = 'message';
$route['m/(:any)'] = 'message/$1';
$route['dashboard'] = 'dashboard';
$route['d/(:any)'] = 'dashboard/$1';

$route['default_controller'] = 'home';
$route['(:any)'] = 'home/$1';
$route['(:any)/(:any)'] = 'home/$1/$2';
*/




$route['t/(:any)'] = 'thesis/$1';
$route['thesis'] = 'thesis';

$route['m/(:any)'] = 'messages/$1';
$route['messages'] = 'messages';

$route['u/(:any)'] = 'users/$1';
$route['users'] = 'users';

$route['search/(:any)'] = 'search/$1';
$route['search'] = 'search';

$route['a/(:any)'] = 'access/$1';
$route['access'] = 'access';

$route['s/(:any)'] = 'settings/$1';
$route['settings'] = 'settings';

$route['faq/(:any)'] = 'help/$1';
$route['faq'] = 'help';

$route['post/(:any)/(:any)'] = 'post/$1';
$route['post/(:any)'] = 'post/$1';
$route['post'] = 'post';


$route['g/(:any)'] = 'group/$1';
$route['group'] = 'group';

$route['ex/(:any)'] = 'example/$1';
$route['example'] = 'example';

$route['counter/(:any)'] = 'counter/$1';
$route['counter'] = 'counter';

$route['d/(:any)'] = 'dashboard/$1';
$route['dashboard'] = 'dashboard';

$route['ie/(:any)/(:any)'] = 'home/ie/$1/$3';
$route['(:any)'] = 'home/$1';
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
