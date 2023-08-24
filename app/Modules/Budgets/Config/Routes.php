<?php

$routes->group('admin', ['filter' => 'Useraccess'], function ($routes) {

    $routes->get('budgets_list', '\Modules\Budgets\Controllers\BudgetsController::Budgets', ['as' => 'budgets_list']);
    $routes->post('budgets_list_add', '\Modules\Budgets\Controllers\BudgetsController::BudgetsAdd', ['as' => 'list_of_budgets']);
    $routes->get('budgets_list_edit/(:any)', '\Modules\Budgets\Controllers\BudgetsController::BudgetsListEdit/$1', ['as' => 'budgets_list_edit']);
    $routes->post('budgets_list_update/(:any)', '\Modules\Budgets\Controllers\BudgetsController::BudgetsListUpdate/$1', ['as' => 'budgets_list_Update']);
    $routes->post('budgets_list_delete/(:any)', '\Modules\Budgets\Controllers\BudgetsController::BudgetsDelete/$1', ['as' => 'budgets_delete']);

    $routes->get('expense_report', '\Modules\Budgets\Controllers\BudgetsController::ExpenseReport', ['as' => 'expense_report']);

});