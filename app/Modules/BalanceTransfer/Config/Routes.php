<?php

$routes->group('admin', ['filter' => 'Useraccess'], function ($routes) {


    $routes->get('balance_transfer_list', '\Modules\BalanceTransfer\Controllers\BalanceTransferController::BalanceTransfer', ['as' => 'balance_list']);
    $routes->post('balance_transfer_add', '\Modules\BalanceTransfer\Controllers\BalanceTransferController::BalanceTransferAdd', ['as' => 'balance_transfer_data']);
   
});