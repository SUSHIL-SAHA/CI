<?php
$route['admin/service-inquiry'] = 'inquiry/backoffice/inquiry/service_inquiry';
$route['admin/service-inquiry/(:any)'] = 'inquiry/backoffice/inquiry/service_inquiry/$1';
$route['admin/inquiry/service-inquiry-details/(:any)'] = 'inquiry/backoffice/inquiry/service_inquiry_details/$1';
$route['admin/inquiry/delete-active-inactive-multiple-service-inquiry'] = 'inquiry/backoffice/inquiry/delete_active_inactive_multiple_service_inquiry';
$route['admin/inquiry/delete-service-inquiry/(:any)'] = 'inquiry/backoffice/inquiry/delete_service_inquiry/$1';


// $route['admin/service/sand-email/(:any)'] = 'service/backoffice/service/sand_email/$1';
$route['admin/inquiry/send_quotation'] = 'inquiry/backoffice/inquiry/sendQuotation';
$route['admin/inquiry/testpdf'] = 'inquiry/backoffice/inquiry/testPDF';