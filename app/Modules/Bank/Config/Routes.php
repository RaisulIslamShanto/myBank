<?php

$routes->group('admin', ['filter' => 'Useraccess'], function ($routes) {

    $routes->get('bank_list', '\Modules\Bank\Controllers\BankController::Bank', ['as' => 'bank_list']);
    $routes->post('bank_list_add', '\Modules\Bank\Controllers\BankController::AddBank', ['as' => 'list_of_bank']);
    $routes->get('bank_list_edit/(:any)', '\Modules\Bank\Controllers\BankController::BankListEdit/$1', ['as' => 'bank_list_edit']);
    $routes->post('bank_list_update/(:any)', '\Modules\Bank\Controllers\BankController::BankListUpdate/$1', ['as' => 'bank_list_Update']);
    $routes->post('bank_list_delete/(:any)', '\Modules\Bank\Controllers\BankController::BankDelete/$1', ['as' => 'bank_delete']);

});