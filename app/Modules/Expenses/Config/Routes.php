<?php

$routes->group('admin', ['filter' => 'Useraccess'], function ($routes) {

    $routes->get('expenses_list', '\Modules\Expenses\Controllers\ExpensesController::Expenses', ['as' => 'expenses_list']);
    $routes->add('expenses_add', '\Modules\Expenses\Controllers\ExpensesController::AddExpenses', ['as' => 'expenses_data']);
    $routes->add('expenses_list_edit/(:any)', '\Modules\Expenses\Controllers\ExpensesController::ExpensesListEdit/$1', ['as' => 'expenses_list_edit']);
    $routes->post('expenses_list_update/(:any)', '\Modules\Expenses\Controllers\ExpensesController::UpdateExpenses/$1', ['as' => 'expenses_list_update']);
    $routes->post('expenses_delete/(:any)', '\Modules\Expenses\Controllers\ExpensesController::ExpensesDelete/$1', ['as' => 'expenses_delete']);


});