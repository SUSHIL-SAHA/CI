<?php

$route['admin/communication/communicationsettings'] = 'communication/backoffice/communication/setting';
$route['admin/communication/settinginsert'] = 'communication/backoffice/communication/settinginsert';
$route['admin/communication/content'] = 'communication/backoffice/communication/content';
$route['admin/communication/content-add'] = 'communication/backoffice/communication/content_add';
$route['admin/communication/contentinsert'] = 'communication/backoffice/communication/contentinsert';

$route['admin/communication/communication-active-inactive'] = 'communication/backoffice/communication/communication_active_inactive';
$route['admin/communication/contentedit/(:any)'] = 'communication/backoffice/communication/content_edit/$1';

$route['admin/communication/contact-mail'] = 'communication/backoffice/communication/contact_mail';
$route['admin/communication/contact-mail/(:any)'] = 'communication/backoffice/communication/contact_mail/$1';
$route['admin/communication/mailedit/(:any)'] = 'communication/backoffice/communication/mail_view/$1';
$route['admin/communication/communication-read-unread'] = 'communication/backoffice/communication/contact_read_unread';
$route['admin/communication/mailfilter'] = 'communication/backoffice/communication/mailfilter';

$route['admin/communication/delete-active-inactive-multiple-communication'] = 'communication/backoffice/communication/communication_active_inactive';

