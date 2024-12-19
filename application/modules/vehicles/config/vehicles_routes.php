<?php
$route["admin/vehicles/vehicles-list"] = "vehicles/backoffice/vehicles/listVehicles";
$route["admin/vehicles/add"] = "vehicles/backoffice/vehicles/add_view";
$route["admin/vehicles/edit/(:any)"] = "vehicles/backoffice/vehicles/edit_view/$1";
$route["admin/vehicles/alterVehicle"] = "vehicles/backoffice/vehicles/alter_vehicle";
$route["admin/vehicles/delete/(:any)"] = "vehicles/backoffice/vehicles/deleteVehicle/$1";
?>
