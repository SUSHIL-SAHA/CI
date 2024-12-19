<?php
$route['admin/faq'] = 'faq/backoffice/faq';
$route['admin/faq/addfaq'] = 'faq/backoffice/faq/addfaq';
$route['admin/faq/faqInsert'] = 'faq/backoffice/faq/faqInsert';
$route['admin/faq/editfaq/(:any)'] = 'faq/backoffice/faq/editfaq/$1';
$route['admin/faq/delete/(:any)'] = 'faq/backoffice/faq/delete/$1';
$route['admin/faq/delete-active-inactive-multiple-faq'] = 'faq/backoffice/faq/delete_active_inactive_multiple_faq';
