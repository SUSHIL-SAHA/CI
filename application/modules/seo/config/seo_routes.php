<?php

$route['admin/seo/default-home'] = 'seo/backoffice/seo/default_home';
$route['admin/seo/updatehomedefault'] = 'seo/backoffice/seo/update_default_home';
$route['admin/seo/title-meta'] = 'seo/backoffice/seo/title_meta';
$route['admin/seo/title-meta/(:any)'] = 'seo/backoffice/seo/title_meta/$1';
$route['admin/seo/title-meta-add'] = 'seo/backoffice/seo/title_meta_add';
$route['admin/seo/title-meta-insert'] = 'seo/backoffice/seo/title_meta_insert';
$route['admin/seo/multiple-delete-active-inactive'] = 'seo/backoffice/seo/multiple_delete_active_inactive';
$route['admin/seo/title-meta-edit/(:num)'] = 'seo/backoffice/seo/title_meta_edit/$1';
$route['admin/seo/search-meta-title'] = 'seo/backoffice/seo/search_meta_title';
