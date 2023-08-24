<?php

$routes->group('admin', ['filter' => 'Useraccess'], function ($routes) {


    $routes->get('account_list', '\Modules\BankAccount\Controllers\BankAccountController::index', ['as' => 'account_list']);
    $routes->post('bank_account_add', '\Modules\BankAccount\Controllers\BankAccountController::AddBankAccount', ['as' => 'account_data']);
    $routes->get('account_list_edit/(:any)', '\Modules\BankAccount\Controllers\BankAccountController::AccountListEdit/$1', ['as' => 'account_list_edit']);
    $routes->post('account_list_update/(:any)', '\Modules\BankAccount\Controllers\BankAccountController::AccountListUpdate/$1', ['as' => 'bank_account_list_Update']);
    $routes->post('bank_account_delete/(:any)', '\Modules\BankAccount\Controllers\BankAccountController::AccountDelete/$1', ['as' => 'bank_account_delete']);

});