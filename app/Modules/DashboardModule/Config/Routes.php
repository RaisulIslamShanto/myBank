
<?php

$routes->group('admin', ['filter' => 'Useraccess'], function ($routes) {
    
    $routes->get('dashboard', '\Modules\DashboardModule\Controllers\DashboardController::dashboard', ['as' => 'dashboard']);
    // $routes->get('dashboard/(:any)', '\Modules\DashboardModule\Controllers\DashboardController::testdashboard/$1', ['as' => 'dashboard/(:any)']);
    $routes->post('savecategory', '\Modules\DashboardModule\Controllers\DashboardController::savecategory', ['as' => 'savecategory']);
   
      
   
});
 
 
