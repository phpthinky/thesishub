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

$route['excel/(:any)'] = 'excel/$1';
$route['excel'] = 'excel';

$route['backup/(:any)'] = 'backup/$1';
$route['backup'] = 'backup';


$route['statistics/(:any)/(:any)'] = 'statistics/$1/$2';
$route['statistics/(:any)'] = 'statistics/$1';
$route['statistics'] = 'statistics';


$route['setting/(:any)/(:any)'] = 'setting/$1/$2';
$route['setting/(:any)'] = 'setting/$1';
$route['setting'] = 'setting';

$route['pdf/(:any)/(:any)'] = 'Fpdf_test/$1/$2';
$route['pdf/(:any)'] = 'Fpdf_test/$1';
$route['pdf'] = 'Fpdf_test';

$route['file/(:any)/(:any)'] = 'file/$1/$2';
$route['file/(:any)'] = 'file/$1';
$route['file'] = 'file';

$route['reports/(:any)/(:any)/(:any)'] = 'reports/$1/$2/$3';
$route['reports/(:any)/(:any)'] = 'reports/$1/$2';
$route['reports/(:any)'] = 'reports/$1';
$route['reports'] = 'reports';


$route['t/(:any)/(:any)/(:any)'] = 'thesis/$1/$2/$3';
$route['t/(:any)/(:any)'] = 'thesis/$1/$2';
$route['t/(:any)'] = 'thesis/$1';
$route['thesis'] = 'thesis';

$route['m/(:any)'] = 'messages/$1';
$route['messages'] = 'messages';

$route['u/(:any)'] = 'users/$1';
$route['users'] = 'users';


$route['accounts/(:any)/(:any)/(:any)'] = 'accounts/$1/$2/$3';
$route['accounts/(:any)/(:any)'] = 'accounts/$1/$2';
$route['accounts/(:any)'] = 'accounts/$1';
$route['accounts'] = 'accounts';

$route['user/(:any)/(:any)/(:any)'] = 'user/$1/$2/$3';
$route['user/(:any)/(:any)'] = 'user/$1/$2';
$route['user/(:any)'] = 'user/$1';
$route['user'] = 'user';


$route['a/(:any)'] = 'access/$1';
$route['access'] = 'access';

$route['s/(:any)'] = 'settings/$1';
$route['settings'] = 'settings';

$route['faq/(:any)'] = 'help/$1';
$route['faq'] = 'help';

$route['post/(:any)/(:any)/(:any)/(:any)'] = 'post/$1/$2/$3/$4';
$route['post/(:any)/(:any)/(:any)'] = 'post/$1/$2/$3';
$route['post/(:any)/(:any)'] = 'post/$1/$2';
$route['post/(:any)'] = 'post/$1';
$route['post'] = 'post';

$route['posts/(:any)/(:any)'] = 'posts/$1/$2';
$route['posts/(:any)'] = 'posts/$1';
$route['posts'] = 'posts';

$route['g/(:any)'] = 'group/$1';
$route['group'] = 'group';

$route['ex/(:any)'] = 'example/$1';
$route['example'] = 'example';

$route['counter/(:any)'] = 'counter/$1';
$route['counter'] = 'counter';

$route['d/(:any)'] = 'dashboard/$1';
$route['dashboard'] = 'dashboard';
$route['slideshow'] = 'slideshow';

$route['ie/(:any)/(:any)'] = 'home/ie/$1/$3';
$route['(:any)/(:any)/(:any)/(:any)/(:any)'] = 'home/$1/$2/$3/$4/$5';
$route['(:any)/(:any)/(:any)/(:any)'] = 'home/$1/$2/$3/$4';
$route['(:any)/(:any)/(:any)'] = 'home/$1/$2/$3';
$route['(:any)/(:any)'] = 'home/$1/$2';
$route['(:any)'] = 'home/$1';
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
