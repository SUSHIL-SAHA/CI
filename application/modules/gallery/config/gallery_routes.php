<?php
$route['admin/gallery'] = 'gallery/backoffice/gallery';
$route['admin/gallery/addgallery'] = 'gallery/backoffice/gallery/addgallery';
$route['admin/gallery/galleryInsert'] = 'gallery/backoffice/gallery/galleryInsert';
$route['admin/gallery/editgallery/(:any)'] = 'gallery/backoffice/gallery/editgallery/$1';
$route['admin/gallery/delete/(:any)'] = 'gallery/backoffice/gallery/delete/$1';
$route['admin/gallery/delete-active-inactive-multiple-img'] = 'gallery/backoffice/gallery/delete_active_inactive_multiple_gallery_banner';
