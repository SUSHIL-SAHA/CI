<?php
// name of the module to display 
$config['module_name']['banner'] = 'Banner Management';

//$config['module_name']['banner']['inn'] = "Inner Banner List";

$config['innerpages']['banner'] = array(
    'homebanner'=>'Home Banner List',
    'innerbanner'=>'Inner Banner List'
);
//$config['module_name']['banner']['innerbanner'] = 'Inner Banner List';
// For admin sub users. 
    // ALL = This module has all user permission
    // REQUIRED = This module need to add permission while creating sib admin user
    // ADMIN = This module is only for super admin and no sub admin will get the permission to access
$config['permission']['banner'] = 'REQUIRED';