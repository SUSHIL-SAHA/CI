<?php

$route['admin/product/productcategory'] = 'product/backoffice/product/category_list';
$route['admin/product/productcategory/(:any)'] = 'product/backoffice/product/category_list/$1';

$route['admin/product/category-add'] = 'product/backoffice/product/category_add';
$route['admin/product/categoryInsert'] = 'product/backoffice/product/categoryInsert';
$route['admin/product/product-category-edit/(:any)'] = 'product/backoffice/product/product_category_edit/$1';
$route['admin/product/product-category-delete/(:any)'] = 'product/backoffice/product/product_category_delete/$1';
$route['admin/product/delete-active-inactive-multiple-category'] = 'product/backoffice/product/delete_active_inactive_multiple_category';

$route['admin/product/allproduct'] = 'product/backoffice/product';
$route['admin/product/allproduct/(:any)'] = 'product/backoffice/product/index/$1';
$route['admin/product/product-add'] = 'product/backoffice/product/product_add';
$route['admin/product/productInsert'] = 'product/backoffice/product/productInsert';
$route['admin/product/product-edit/(:any)'] = 'product/backoffice/product/product_edit/$1';
$route['admin/product/product-delete/(:any)'] = 'product/backoffice/product/product_delete/$1';
$route['admin/product/delete-active-inactive-multiple-product'] = 'product/backoffice/product/delete_active_inactive_multiple_product';