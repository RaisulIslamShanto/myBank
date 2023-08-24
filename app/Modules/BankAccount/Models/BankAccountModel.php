<?php

namespace Modules\BankAccount\Models;

use CodeIgniter\Model;


class BankAccountModel extends Model{
    protected $DBGroup              = 'default';
    protected $table                = 'bank_account';
    protected $primaryKey           = 'id';

    protected $allowedFields = ['user_name','account_holders_name','bank_name_id','account_number', 'initial_balance','deleted_at',];

    public function softDelete($id) {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->update($id, $data);
    }
}

