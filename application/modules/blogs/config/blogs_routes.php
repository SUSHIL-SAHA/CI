<?php
$route['admin/blogs'] = 'blogs/backoffice/blogs';
$route['admin/blogs/addblogs'] = 'blogs/backoffice/blogs/addblogs';
$route['admin/blogs/blogsInsert'] = 'blogs/backoffice/blogs/blogsInsert';
$route['admin/blogs/editblogs/(:any)'] = 'blogs/backoffice/blogs/editblogs/$1';
$route['admin/blogs/delete/(:any)'] = 'blogs/backoffice/blogs/delete/$1';
$route['admin/blogs/delete-active-inactive-multiple-blogs'] = 'blogs/backoffice/blogs/delete_active_inactive_multiple_blogs';
