<?php
$route['admin/adminusers'] = 'adminusers/backoffice/adminusers';
$route['admin/adminusers/adduser'] = 'adminusers/backoffice/adminusers/addUsers';
$route['admin/adminusers/adduseraction'] = 'adminusers/backoffice/adminusers/addUsersAction';
$route['admin/adminusers/edituser/(:any)'] = 'adminusers/backoffice/adminusers/editUsers/$1';
$route['admin/adminusers/deleteuser/(:any)'] = 'adminusers/backoffice/adminusers/deleteUser/$1';

$route['admin/adminusers/generatepassword'] = 'adminusers/backoffice/adminusers/passwordsuggestionuser';
$route['admin/adminusers/generatepasswordaction'] = 'adminusers/backoffice/adminusers/passwordsuggestionuseraction';

$route['admin/adminusers/adduserrole'] = 'adminusers/backoffice/adminusers/addUsersRole';
$route['admin/adminusers/userrole'] = 'adminusers/backoffice/adminusers/UsersRole';
$route['admin/adminusers/addrole'] = 'adminusers/backoffice/adminusers/addrole';
$route['admin/adminusers/userrole/edit/(:any)'] = 'adminusers/backoffice/adminusers/alterUsersRole/$1';
$route['admin/adminusers/userrole/actionallrole'] = 'adminusers/backoffice/adminusers/massalterUsersRole';
$route['admin/adminusers/deleterole/(:any)'] = 'adminusers/backoffice/adminusers/deleteRole/$1';
$route['admin/adminusers/delete-active-inactive-multiple-user'] = 'adminusers/backoffice/adminusers/delete_active_inactive_multiple_user';
$route['admin/adminusers/delete-active-inactive-multiple-user-role'] = 'adminusers/backoffice/adminusers/delete_active_inactive_multiple_user_role';


