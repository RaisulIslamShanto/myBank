<?php

namespace Modules\DebitsLoans\Models;

use CodeIgniter\Model;


class LendModel extends Model{
    protected $DBGroup              = 'default';
    protected $table                = 'lend';
    protected $primaryKey           = 'id';

    protected $allowedFields = ['amount','bank_account','date','type',];
}