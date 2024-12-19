<?php

$route['admin/banner/homebanner'] = 'banner/backoffice/banner';
$route['admin/banner/addBanner'] = 'banner/backoffice/banner/addBanner';
$route['admin/banner/bannerInsert'] = 'banner/backoffice/banner/bannerInsert';
$route['admin/banner/editbanner/(:any)'] = 'banner/backoffice/banner/editbanner/$1';
$route['admin/banner/delete/(:any)'] = 'banner/backoffice/banner/delete/$1';
$route['admin/banner/delete-active-inactive-multiple-banner'] = 'banner/backoffice/banner/delete_active_inactive_multiple_banner';
$route['admin/banner/innerbanner'] = 'banner/backoffice/banner/inner_banner_list';
$route['admin/banner/innerbanner/(:any)'] = 'banner/backoffice/banner/inner_banner_list/$1';
$route['admin/banner/inner-banner-add'] = 'banner/backoffice/banner/inner_banner_add';
$route['admin/banner/Innerbannerinsert'] = 'banner/backoffice/banner/Innerbannerinsert';
$route['admin/banner/inner-banner-edit/(:any)'] = 'banner/backoffice/banner/inner_banner_edit/$1';
$route['admin/banner/inner-banner-delete/(:any)'] = 'banner/backoffice/banner/inner_banner_delete/$1';
$route['admin/banner/delete-active-inactive-multiple-inner-banner'] = 'banner/backoffice/banner/delete_active_inactive_multiple_inner_banner';
