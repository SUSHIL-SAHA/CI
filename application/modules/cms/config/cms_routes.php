<?php

$route['admin/cms/pages'] = 'cms/backoffice/cms';
$route['admin/cms/pages/(:any)'] = 'cms/backoffice/cms/index/$1';
$route['admin/cms/add'] = 'cms/backoffice/cms/add';
$route['admin/cms/alterCMSPages'] = 'cms/backoffice/cms/alterCMSPages';
$route['admin/cms/EditCMSPages/(:any)'] = 'cms/backoffice/cms/addEditCMSPages/$1';
$route['admin/cms/delete/(:any)'] = 'cms/backoffice/cms/delete/$1';
$route['admin/cms/delete-active-inactive-multiple-page'] = 'cms/backoffice/cms/delete_active_inactive_multiple_page';
$route['admin/cms/delete-active-inactive-multiple-custom-field'] = 'cms/backoffice/cms/delete_active_inactive_multiple_custom_field';

$route['admin/cms/custom-fields'] = 'cms/backoffice/cms/customFields';
$route['admin/cms/custom-fields/(:any)'] = 'cms/backoffice/cms/customFields/$1';
$route['admin/cms/add-custom-field'] = 'cms/backoffice/cms/addCustomField';
$route['admin/cms/EditCustomField/(:any)'] = 'cms/backoffice/cms/EditCustomField/$1';
$route['admin/cms/alterCustomField'] = 'cms/backoffice/cms/alterCustomField';
$route['admin/cms/deleteCustomField/(:any)'] = 'cms/backoffice/cms/deleteCustomField/$1';
$route['admin/cms/deleteCmsImage'] = 'cms/backoffice/cms/deleteCmsImage';



$route['home']='cms/frontoffice/cms/index';
$route['product/(:any)']='cms/frontoffice/cms/product/$1';
$route['about-us']='cms/frontoffice/cms/aboutus';
$route['categoryId_data']='cms/frontoffice/cms/categoryId_data';
$route['service/(:any)']='cms/frontoffice/cms/service_details/$1';
$route['contact-us']='cms/frontoffice/cms/contact';
$route['faq']='cms/frontoffice/cms/faq';
$route['error']='cms/frontoffice/cms/error';
$route['form']='cms/frontoffice/cms/form';
$route['service-insert']='cms/frontoffice/cms/service_insert';
$route['testimonials']='cms/frontoffice/cms/testimonials';
$route['blogs']='cms/frontoffice/cms/blogs';
$route['blogs/(:any)']='cms/frontoffice/cms/inner_blogs/$1';
$route['location/(:any)']='cms/frontoffice/cms/location/$1';
$route['location/(:any)/(:any)']='cms/frontoffice/cms/location_details/$1/$2';
$route['singel_product/(:any)']='cms/frontoffice/cms/singel_product/$1';
$route['get-cart-data']='cms/frontoffice/cms/get_cart_data';
$route['remove-cart-data/(:any)']='cms/frontoffice/cms/remove_cart_data/$1';
$route['remove-all-cart-data']='cms/frontoffice/cms/remove_all_cart_data';
$route['calculator']='cms/frontoffice/cms/calculator';
$route['inquiry-form']='cms/frontoffice/cms/inquiry_form';

$route['contact-us/thank-you']='cms/frontoffice/cms/thank_you';
$route['inquiry-form/thank-you']='cms/frontoffice/cms/thank_you';

// Payment Route
$route['pay_order/(:any)']='cms/frontoffice/cms/payment_page/$1';
$route['pay_via'] = 'cms/frontoffice/cms/pay_via';
$route['paypal_ipn'] = 'cms/frontoffice/cms/paypal_ipn';
$route['paypal_success'] = 'cms/frontoffice/cms/paypal_success';
