<?php

$route['admin/plugins'] = 'plugins/backoffice/plugins';
$route['admin/plugins/create-plugin'] = 'plugins/backoffice/plugins/create_plugin';
$route['admin/plugins/insert-plugin'] = 'plugins/backoffice/plugins/insert_plugin';
$route['admin/plugins/edit-plugin/(:any)'] = 'plugins/backoffice/plugins/edit_plugin/$1';
$route['admin/plugins/delete-active-inactive-multiple-plugins'] = 'plugins/backoffice/plugins/delete_active_inactive_multiple_plugins';
$route['admin/plugins/sub-plugin-list/(:any)'] = 'plugins/backoffice/plugins/sub_plugin_list/$1';
$route['admin/plugins/create-sub-plugin/(:any)'] = 'plugins/backoffice/plugins/create_sub_plugin/$1';
$route['admin/plugins/edit-sub-plugin/(:any)'] = 'plugins/backoffice/plugins/edit_sub_plugin/$1';
$route['admin/plugins/insert-sub-plugin'] = 'plugins/backoffice/plugins/insert_sub_plugin';
$route['admin/sub-plugins/delete-active-inactive-multiple-sub-plugins'] = 'plugins/backoffice/plugins/delete_active_inactive_multiple_sub_plugins';