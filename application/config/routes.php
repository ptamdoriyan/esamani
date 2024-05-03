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
// dash
$route['home'] = 'dash/c_dashboard';

// absen
$route['absen/(:any)/yearly'] = 'dash/c_absen/yearly/$1';
$route['absen/(:any)/monthly'] = 'dash/c_absen/monthly/$1';
$route['absen/(:any)/daily'] = 'dash/c_absen/daily/$1';
$route['absen/change/(:any)'] = 'dash/c_absen/change/$1';
$route['absen/get/(:any)'] = 'dash/c_absen/get/$1';
$route['absen/detail/(:any)'] = 'dash/c_absen/detail/$1';
$route['absen/add_flag']['POST'] = 'dash/c_absen/add_flag';
$route['absen/delete_flag/(:any)/(:num)'] = 'dash/c_absen/delete_flag/$1/$2';

$route['absen/(:any)/monthly_print'] = 'dash/c_absen/monthly_print/$1';
$route['absen/(:any)/daily_print'] = 'dash/c_absen/daily_print/$1';

// pegawai
$route['pegawai'] = 'dash/c_pegawai/index';
$route['pegawai/create'] = 'dash/c_pegawai/create';
$route['pegawai/add']['POST'] = 'dash/c_pegawai/add';
$route['pegawai/detail/(:num)'] = 'dash/c_pegawai/detail/$1';
$route['pegawai/update']['POST'] = 'dash/c_pegawai/update';
$route['pegawai/activate']['POST'] = 'dash/c_pegawai/activate';
$route['pegawai/deactivate']['POST'] = 'dash/c_pegawai/deactivate';

// jabatan
$route['ref/jabatan'] = 'ref/c_jabatan';
$route['ref/jabatan/create'] = 'ref/c_jabatan/create';
$route['ref/jabatan/add']['POST'] = 'ref/c_jabatan/add';
$route['ref/jabatan/detail/(:num)'] = 'ref/c_jabatan/detail/$1';
$route['ref/jabatan/update']['POST'] = 'ref/c_jabatan/update';

// settings
$route['ref/settings'] = 'ref/c_settings';
$route['ref/settings/update']['POST'] = 'ref/c_settings/update';

// libur
$route['ref/libur'] = 'ref/c_libur';
$route['ref/libur/add']['POST'] = 'ref/c_libur/add';
$route['ref/libur/get/(:any)'] = 'ref/c_libur/get/$1';
$route['ref/libur/delete']['POST'] = 'ref/c_libur/delete';

// puasa
$route['ref/puasa'] = 'ref/c_puasa';
$route['ref/puasa/add']['POST'] = 'ref/c_puasa/add';
$route['ref/puasa/get/(:any)'] = 'ref/c_puasa/get/$1';
$route['ref/puasa/delete']['POST'] = 'ref/c_puasa/delete';

// kegiatan
$route['ref/kegiatan'] = 'ref/c_kegiatan';
$route['ref/kegiatan/add']['POST'] = 'ref/c_kegiatan/add';
$route['ref/kegiatan/get/(:any)'] = 'ref/c_kegiatan/get/$1';
$route['ref/kegiatan/delete']['POST'] = 'ref/c_kegiatan/delete';

// auth
// $route['api']['POST'] = 'api/push';
$route['login'] = 'auth/c_login';
$route['logout'] = 'auth/c_login/logout';
$route['validate'] = 'auth/c_login/validate';

$route['auth/users'] = 'auth/c_users';
$route['auth/users/create'] = 'auth/c_users/create';
$route['auth/users/add']['POST'] = 'auth/c_users/add';
$route['auth/users/detail/(:num)'] = 'auth/c_users/detail/$1';
$route['auth/users/update']['POST'] = 'auth/c_users/update';
$route['auth/users/profile'] = 'auth/c_users/profile';
$route['auth/users/profile/update_profile']['POST'] = 'auth/c_users/update_profile';
$route['auth/users/profile/update_password']['POST'] = 'auth/c_users/update_password';

$route['auth/roles'] = 'auth/c_roles';
$route['auth/roles/create'] = 'auth/c_roles/create';
$route['auth/roles/add']['POST'] = 'auth/c_roles/add';
$route['auth/roles/detail/(:num)'] = 'auth/c_roles/detail/$1';
$route['auth/roles/update']['POST'] = 'auth/c_roles/update';
$route['auth/roles/has_permissions/(:num)'] = 'auth/c_roles/permissions/$1';
$route['auth/roles/permissions/update']['POST']  = 'auth/c_roles/permissions_update';

$route['auth/permissions'] = 'auth/c_permissions';
$route['auth/permissions/create'] = 'auth/c_permissions/create';
$route['auth/permissions/add']['POST'] = 'auth/c_permissions/add';
$route['auth/permissions/detail/(:num)'] = 'auth/c_permissions/detail/$1';
$route['auth/permissions/update']['POST'] = 'auth/c_permissions/update';

// api
$route['api/push']['POST'] = 'api/push';





$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
