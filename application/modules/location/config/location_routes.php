<?php

$route['admin/location/suburb'] = 'location/backoffice/location/suburb_list';
$route['admin/location/suburb/(:any)'] = 'location/backoffice/location/suburb_list/$1';

$route['admin/location/suburb-add'] = 'location/backoffice/location/suburb_add';
$route['admin/location/suburbInsert'] = 'location/backoffice/location/suburbInsert';
$route['admin/location/suburb-edit/(:any)'] = 'location/backoffice/location/suburb_edit/$1';
$route['admin/location/suburb-delete/(:any)'] = 'location/backoffice/location/suburb_delete/$1';
$route['admin/location/delete-active-inactive-multiple-suburb'] = 'location/backoffice/location/delete_active_inactive_multiple_suburb';

$route['admin/location/locations'] = 'location/backoffice/location';
$route['admin/location/locations/(:any)'] = 'location/backoffice/location/index/$1';
$route['admin/location/locations-add'] = 'location/backoffice/location/locations_add';
$route['admin/location/locationsInsert'] = 'location/backoffice/location/locationsInsert';
$route['admin/location/locations-edit/(:any)'] = 'location/backoffice/location/locations_edit/$1';
$route['admin/location/locations-delete/(:any)'] = 'location/backoffice/location/locations_delete/$1';
$route['admin/location/delete-active-inactive-multiple-locations'] = 'location/backoffice/location/delete_active_inactive_multiple_locations';


$route['admin/location/suburb-category'] = 'location/backoffice/location/suburb_category';
$route['admin/location/suburb-category/(:any)'] = 'location/backoffice/location/suburb_category/$1';

$route['admin/location/category-add'] = 'location/backoffice/location/category_add';
$route['admin/location/categoryInsert'] = 'location/backoffice/location/categoryInsert';
$route['admin/location/category-edit/(:any)'] = 'location/backoffice/location/category_edit/$1';
$route['admin/location/category-delete/(:any)'] = 'location/backoffice/location/category_delete/$1';
$route['admin/location/delete-active-inactive-multiple-category'] = 'location/backoffice/location/delete_active_inactive_multiple_category';



// $route['admin/service/get-parent-category'] = 'service/backoffice/service/get_parent_category';
// $route['admin/service/is-home-service'] = 'service/backoffice/service/is_home_service';
// $route['admin/service/servicegalleryInsert'] = 'service/backoffice/service/servicegalleryInsert';
// $route['admin/service/service-gallery-image-delete/(:any)/(:any)'] = 'service/backoffice/service/service_gallery_image_delete/$1/$2';

// $route['admin/service/service-inquiry'] = 'service/backoffice/service/service_inquiry';
// $route['admin/service/service-inquiry/(:any)'] = 'service/backoffice/service/service_inquiry/$1';
// $route['admin/service/service-inquiry-details/(:any)'] = 'service/backoffice/service/service_inquiry_details/$1';
// $route['admin/service/delete-active-inactive-multiple-service-inquiry'] = 'service/backoffice/service/delete_active_inactive_multiple_service_inquiry';
// $route['admin/service/delete-service-inquiry/(:any)'] = 'service/backoffice/service/delete_service_inquiry/$1';
// $route['admin/service/is-home-featured-service'] =  'service/backoffice/service/is_home_featured_service';