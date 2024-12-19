<?php
$route['admin/testimonial'] = 'testimonial/backoffice/testimonial';
$route["admin/testimonial/add"] = "testimonial/backoffice/testimonial/Testimonial_add";
$route['admin/testimonial/testimonialInsert'] = 'testimonial/backoffice/testimonial/testimonialInsert';
$route['admin/testimonial/testimonialdelete/(:any)'] = 'testimonial/backoffice/testimonial/testimonial_delete/$1';
$route['admin/testimonial/testimonial-edit/(:any)'] = 'testimonial/backoffice/testimonial/testimonial_edit/$1';
$route['admin/testimonial/delete-active-inactive-multiple-testimonial'] = 'testimonial/backoffice/testimonial/delete_active_inactive_multiple_testimonial';
$route['admin/testimonial/is-home-featured-testimonial'] = 'testimonial/backoffice/testimonial/is_home_featured_testimonial';
?> 