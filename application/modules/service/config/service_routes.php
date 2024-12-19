<?php

$route['admin/service/servicecategory'] = 'service/backoffice/service/category_list';
$route['admin/service/servicecategory/(:any)'] = 'service/backoffice/service/category_list/$1';

$route['admin/service/category-add'] = 'service/backoffice/service/category_add';
$route['admin/service/categoryInsert'] = 'service/backoffice/service/categoryInsert';
$route['admin/service/service-category-edit/(:any)'] = 'service/backoffice/service/service_category_edit/$1';
$route['admin/service/service-category-delete/(:any)'] = 'service/backoffice/service/service_category_delete/$1';
$route['admin/service/delete-active-inactive-multiple-category'] = 'service/backoffice/service/delete_active_inactive_multiple_category';

$route['admin/service/allservice'] = 'service/backoffice/service';
$route['admin/service/allservice/(:any)'] = 'service/backoffice/service/index/$1';
$route['admin/service/service-add'] = 'service/backoffice/service/service_add';
$route['admin/service/serviceInsert'] = 'service/backoffice/service/serviceInsert';
$route['admin/service/service-edit/(:any)'] = 'service/backoffice/service/service_edit/$1';
$route['admin/service/service-delete/(:any)'] = 'service/backoffice/service/service_delete/$1';
$route['admin/service/delete-active-inactive-multiple-service'] = 'service/backoffice/service/delete_active_inactive_multiple_service';
$route['admin/service/get-parent-category'] = 'service/backoffice/service/get_parent_category';
$route['admin/service/is-home-service'] = 'service/backoffice/service/is_home_service';
$route['admin/service/servicegalleryInsert'] = 'service/backoffice/service/servicegalleryInsert';
$route['admin/service/service-gallery-image-delete/(:any)/(:any)'] = 'service/backoffice/service/service_gallery_image_delete/$1/$2';

$route['admin/service/service-inquiry'] = 'service/backoffice/service/service_inquiry';
$route['admin/service/service-inquiry/(:any)'] = 'service/backoffice/service/service_inquiry/$1';
$route['admin/service/service-inquiry-details/(:any)'] = 'service/backoffice/service/service_inquiry_details/$1';
$route['admin/service/delete-active-inactive-multiple-service-inquiry'] = 'service/backoffice/service/delete_active_inactive_multiple_service_inquiry';
$route['admin/service/delete-service-inquiry/(:any)'] = 'service/backoffice/service/delete_service_inquiry/$1';
$route['admin/service/is-home-featured-service'] = 'service/backoffice/service/is_home_featured_service';

$route['admin/service/vehicle-inquiry'] = 'service/backoffice/service/vehicle_inquiry';
$route['admin/service/vehicle-inquiry/(:any)'] = 'service/backoffice/service/vehicle-inquiry/$1';
$route['admin/service/vehicle-inquiry-details/(:any)'] = 'service/backoffice/service/vehicle_inquiry_details/$1';
$route['admin/service/delete-active-inactive-multiple-vehicle-inquiry'] = 'service/backoffice/service/delete_active_inactive_multiple_vehicle_inquiry';
$route['admin/service/delete-vehicle-inquiry/(:any)'] = 'service/backoffice/service/delete_vehicle_inquiry/$1';

$route['admin/service/sand-email/(:any)'] = 'service/backoffice/service/sand_email/$1';
$route['admin/service/send_quotation'] = 'service/backoffice/service/sendQuotation';
$route['admin/service/testpdf'] = 'service/backoffice/service/testPDF';