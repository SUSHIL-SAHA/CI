<?php
// name of the module to display 
$config['module_name']['login'] = 'Login';
// For admin sub users. 
    // ALL = This module has all user permission
    // REQUIRED = This module need to add permission while creating sib admin user
    // ADMIN = This module is only for super admin and no sub admin will get the permission to access
$config['permission']['login'] = 'ALL';