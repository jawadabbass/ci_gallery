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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['gallery'] = 'gallery/index';
$route['gallery/(:num)'] = 'gallery/index/$1';
$route['gallery/(:num)/(:num)'] = 'gallery/index/$1/$2';

$route['add-image'] = 'gallery/add_image';
$route['edit-image/(:num)'] = 'gallery/edit_image/$1';
$route['remove-image/(:num)'] = 'gallery/delete_image/$1';
$route['image-details/(:num)'] = 'gallery/show_image/$1';

$route['about-us'] = 'cms/about_us';
$route['contact-us'] = 'cms/contact_us';
$route['terms-conditions'] = 'cms/terms_conditions';

$route['user-dashboard'] = 'site_user/dashboard';
$route['login'] = 'site_user/login';
$route['logout'] = 'site_user/logout';
$route['register'] = 'site_user/register';
$route['update-profile'] = 'site_user/update_profile';

/**********************************/
/*********   Admin Routs   ********/
/**********************************/
$route['admin/login'] = 'admin/admin_user/login';
$route['admin/logout'] = 'admin/admin_user/logout';
$route['admin/profile'] = 'admin/admin_user/update_profile';

$route['admin/categories'] = 'admin/category/index';
$route['admin/add-category'] = 'admin/category/add_category';
$route['admin/edit-category/(:num)'] = 'admin/category/edit_category/$1';
$route['admin/delete-category'] = 'admin/category/delete_category';

$route['admin/gallery-images'] = 'admin/gallery/index';
$route['admin/delete-image'] = 'admin/gallery/delete_image';
$route['admin/update-image-status'] = 'admin/gallery/update_status';

$route['admin/site-users'] = 'admin/site_user/index';
$route['admin/delete-site-user'] = 'admin/site_user/delete_site_user';
$route['admin/update-site-user-status-ajax'] = 'admin/site_user/update_status_ajax';

$route['admin/list-site-users'] = 'admin/site_user/list_site_users';
$route['admin/list-site-users/(:num)'] = 'admin/site_user/list_site_users/$1';
$route['admin/list-site-users/(:num)/(:num)'] = 'admin/site_user/list_site_users/$1/$2';
$route['admin/remove-site-user/(:num)'] = 'admin/site_user/remove_site_user/$1';
$route['admin/update-site-user-status/(:num)/(:any)'] = 'admin/site_user/update_status/$1/$2';