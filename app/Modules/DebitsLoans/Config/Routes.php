<?php

$routes->group('admin', ['filter' => 'Useraccess'], function ($routes) {

    $routes->get('debts_loans_list', '\Modules\DebitsLoans\Controllers\DebitsLoansController::DebtsLoans', ['as' => 'debts_list']);
    $routes->post('debts_loans_add', '\Modules\DebitsLoans\Controllers\DebitsLoansController::AddDebtsLoans', ['as' => 'debts_loans_data']);
    $routes->post('debts_loans_delete/(:any)', '\Modules\DebitsLoans\Controllers\DebitsLoansController::DebtsDelete/$1', ['as' => 'debts_delete']);
    $routes->get('debts_loans_edit/(:any)', '\Modules\DebitsLoans\Controllers\DebitsLoansController::DebtsEdit/$1', ['as' => 'debts_edit']);

    $routes->post('add_lend/(:any)', '\Modules\DebitsLoans\Controllers\DebitsLoansController::AddLend/$1', ['as' => 'add_lend']);
    $routes->post('debts_collection/(:any)', '\Modules\DebitsLoans\Controllers\DebitsLoansController::AddDebtsCollection/$1', ['as' => 'debts_collection']);

});