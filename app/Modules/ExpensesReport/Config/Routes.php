<?php

$routes->group('admin', ['filter' => 'Useraccess'], function ($routes) {
    
    $routes->get('expenses_report', '\Modules\ExpensesReport\Controllers\ExpensesReportController::ExpensesReport', ['as' => 'expenses_report']);
    $routes->post('filterexpense', '\Modules\ExpensesReport\Controllers\ExpensesReportController::filterexpense', ['as' => 'filterexpense']);

    // $routes->post('expenses_report_filter', '\Modules\ExpensesReport\Controllers\ExpensesReportController::ExpensesReportFilter', ['as' => 'expenses_report_filter']);

});