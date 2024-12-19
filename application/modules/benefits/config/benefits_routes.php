<?php
$route['admin/benefits'] = 'benefits/backoffice/benefits';
$route['admin/benefits/addbenefits'] = 'benefits/backoffice/benefits/addbenefits';
$route['admin/benefits/benefitsInsert'] = 'benefits/backoffice/benefits/benefitsInsert';
$route['admin/benefits/editbenefits/(:any)'] = 'benefits/backoffice/benefits/editbenefits/$1';
$route['admin/benefits/delete/(:any)'] = 'benefits/backoffice/benefits/delete/$1';
$route['admin/benefits/delete-active-inactive-multiple-benefits'] = 'benefits/backoffice/benefits/delete_active_inactive_multiple_benefits';
