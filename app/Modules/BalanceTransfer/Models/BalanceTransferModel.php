<?php

namespace Modules\BalanceTransfer\Models;

use CodeIgniter\Model;


class BalanceTransferModel extends Model{
    protected $DBGroup              = 'default';
    protected $table                = 'balance_transfer';
    protected $primaryKey           = 'id';

    protected $allowedFields = ['from_account','to_account_id','amount','transfer_date', 'note',];
}