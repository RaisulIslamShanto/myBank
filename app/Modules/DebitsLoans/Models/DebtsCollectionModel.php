<?php

namespace Modules\DebitsLoans\Models;

use CodeIgniter\Model;


class DebtsCollectionModel extends Model{
    protected $DBGroup              = 'default';
    protected $table                = 'debts_collection';
    protected $primaryKey           = 'id';

    protected $allowedFields = ['amount','bank_account','date',];
}