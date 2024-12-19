<?php

$route['login'] = 'login/frontend/login';
$route['admin'] = 'login/backoffice/login';
$route['admin/login'] = 'login/backoffice/login';
$route['admin/login/loginprocess'] = 'login/backoffice/login/loginprocess';
$route['admin/logout'] = 'login/backoffice/login/logout';
$route['admin/forgot-password'] = 'login/backoffice/login/forgotPassword';
$route['admin/resetpassowrd'] = 'login/backoffice/login/resetPassword';
$route['admin/changepassword/(:any)/(:any)/(:any)'] = 'login/backoffice/login/changepassword/$1/$2/$3';
$route['admin/updatepassword'] = 'login/backoffice/login/updatepassword';

// $route['forgot-password'] = 'login/frontend/login/forgotPassword';
// $route['resetpassowrd'] = 'login/frontend/login/resetPassword';
// $route['user/changepassword'] = 'login/frontend/login/changepassword';