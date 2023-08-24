<?php

namespace Modules\DebitsLoans\Models;

use CodeIgniter\Model;


class DebtsLoansModel extends Model{
    protected $DBGroup              = 'default';
    protected $table                = 'add_debts_loans';
    protected $primaryKey           = 'id';

    protected $allowedFields = ['amount','bank_account','select_type','person','date','note',];
}