<?php

namespace Modules\ExpensesReport\Controllers;

use App\Controllers\BaseController;
use Modules\BalanceTransfer\Models\BalanceTransferModel;
use Modules\BalanceTransfer\Models\DebtsLoansModel;
use Modules\BankAccount\Models\BankAccountModel;
use Modules\Expenses\Models\ExpensesModel;
use Modules\CategoryModule\Models\Categorymodel;

class ExpensesReportController extends BaseController{
    public $session,$db;

    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }


    public function ExpensesReport(){
      
 

        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->findAll();

        $balance = new BalanceTransferModel();
        $getBalance = $balance->findAll();

        $expensesmodel = new ExpensesModel();
        $expenseslist = $expensesmodel->findAll();
  
        $db = \Config\Database::connect();
        $myData = [];

        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();


                $myData[]=$allvalue;
                
        }


        $db = \Config\Database::connect();
        $balanceData = [];

        foreach ($getBalance as $allvalue) {



            $allvalue['bank'] = $db->table('bank_account')
                ->where('id', $allvalue['from_account'])
                ->get()
                ->getRow();
        
            $allvalue['to_bank'] = $db->table('bank_account')
                ->where('id', $allvalue['to_account_id'])
                ->get()
                ->getRow();

                $balanceData[]=$allvalue;
                
        }


        return view('Modules\ExpensesReport\Views\admin\bank\expenses-report', [
            "username" => $this->session->get('name'),
            // "getBalance" => $getBalance,
            // "accountlist" => $accountlist,
            'data' => $myData,
            // "balanceData" => $balanceData,
            "expenseslist" => $expenseslist,

        ]);
    }


    public function ExpensesReportFilter()
{
    $expensesmodel = new ExpensesModel();
    $expenseslist = $expensesmodel->findAll();

    if ($this->request->getMethod() === 'post') {
        $start_date = $this->request->getPost('from');
        $end_date = $this->request->getPost('to');

        $db = \Config\Database::connect(); 

        $query = $db->table('expenses')
           
            ->where("date >= '$start_date'")
            ->where("date <= '$end_date'")
            ->get();

        $filterdata['expensesList'] = $query->getResultArray();
 

        return view('Modules\ExpensesReport\Views\admin\bank\expenses-report', [
            "filterdata" => $filterdata,
            "username" => $this->session->get('name'),
            "expenseslist" => $expenseslist,
        ]);
    }
}


    
}
