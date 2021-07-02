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
$route['default_controller'] = "auth/index";	
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['forgot_password']	    				= 'auth/forgot_password';
$route['account/activate/(:any)/(:any)']	    = 'auth/activate/$1/$2';
$route['account/reset_password/(:any)/(:any)']	= 'auth/reset_password/$1/$2';

$route['admin'] = 'admin/dashboard';
$route['login'] = 'auth/index';
$route['logout'] = 'auth/logout';

#$route['admin/reports/(.*)']	    = 'reports/$1';

$route['admin/([a-zA-Z0-9_-]+)']	    = '$1/$1/index';
$route['admin/([a-zA-Z0-9_-]+)/(.*)']	    = '$1/$1/$2/';
//$route['admin/([a-zA-Z0-9_-]+)/(:any)/(:any)']	    = '$1/admin/$2/$3';

// $route['date_change'] = 'admin/date_to_np_new/index';
// $route['date_change'] = 'admin/date_to_np_new/update_date';

$route['sales_dashboard'] = 'admin/dashboard/sales_dashboard';
$route['sales_dashboard_new'] = 'admin/dashboard/sales_dashboard_new';
$route['logistic_dashboard'] = 'admin/dashboard/logistic_dashboard';
$route['logistic_dashboard/(:any)'] = 'admin/dashboard/logistic_dashboard/$1';
$route['dealer_dashboard'] = 'admin/dashboard/dashboard_dealer';
$route['marketing_dashboard'] = 'admin/dashboard/marketing_dashboard';
$route['management_dashboard'] = 'admin/dashboard/management_dashboard';
$route['spareparts_dashboard'] = 'admin/dashboard/spareparts_dashboard';

