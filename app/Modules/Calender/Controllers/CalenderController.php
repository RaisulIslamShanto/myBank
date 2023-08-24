<?php

namespace Modules\Calender\Controllers;

use App\Controllers\BaseController;
use Modules\Calender\Models\SettingModel;
use Modules\BankAccount\Models\BankAccountModel;
use Modules\Expenses\Models\ExpensesModel;
use Modules\IncomeModule\Models\IncomeModel;
use Modules\CategoryModule\Models\Categorymodel;

class CalenderController extends BaseController{

    public $session,$db;

    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }


    public function Calendar(){

        $Categorymodel = new Categorymodel;
        $Categorytable = $Categorymodel->findAll();
        
        $expensesmodel = new ExpensesModel();
        $expenseslist = $expensesmodel->findAll();

        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->findAll();

        $IncomeModel = new IncomeModel;
        $incometable = $IncomeModel->findAll();
        

        $db = \Config\Database::connect();
        $myData = [];

        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();

                $myData[$allvalue['id']]=$allvalue;                
        }

        $calandarData = [];

        foreach ($expenseslist as $allvalue) {
            $allvalue['bank'] = $myData [$allvalue['bank_account']];
                $calandarData[]=$allvalue;
                
        }
        $incomeData=[];

        foreach ($incometable as $allvalue) {
            $allvalue['bank'] = $myData [$allvalue['bankAccount']];

                $incomeData[]=$allvalue;
                
        }
        //  echo '<pre>';print_r($incomeData);die;

        // $inevents = []; 
    
        // foreach ($incomeData as $income) {
        //     $events[] = [
        //         'expense_category' => $income['expense_category'],
        //         "username" => $this->session->get('name'),
        //         'account' => $income['bank']['account_number'],
        //         'bank' => $income['bank']['bank']->bank_name,
        //         'amount' => $income['amount'],
        //         'description' => $income['description'],
        //         'note' => $income['note'],
        //         'reference' => $income['reference'],
        //         'date' => $income['date'],
                
        //     ];
        // }

        $events = []; 
    
        foreach ($calandarData as $expense) {
            $events[] = [
                'expense_category' => $expense['expense_category'],
                "username" => $this->session->get('name'),
                'account' => $expense['bank']['account_number'],
                'bank' => $expense['bank']['bank']->bank_name,
                'amount' => $expense['amount'],
                'description' => $expense['description'],
                'note' => $expense['note'],
                'reference' => $expense['reference'],
                'date' => $expense['date'],
                
            ];
        }

    
        // return $this->response->setJSON($events);
        

        return view('Modules\Calender\Views\admin\bank\calendar', [
            "username" => $this->session->get('name'),
            "events" => json_encode($events),

        ]);
    }
    

    // public function CalendarData()
    // {

    //     $expensesmodel = new ExpensesModel();
    //     $expenseslist = $expensesmodel->findAll();

    //     $bankaccount = new BankAccountModel();
    //     $accountlist = $bankaccount->findAll();

    //     $IncomeModel = new IncomeModel;
    //     $incometable = $IncomeModel->findAll();
        

    //     $db = \Config\Database::connect();
    //     $myData = [];

    //     foreach ($accountlist as $allvalue) {
    //         $allvalue['bank'] = $db->table('bank_list')
    //             ->where('id', $allvalue['bank_name_id'])
    //             ->get()
    //             ->getRow();

    //             $myData[$allvalue['id']]=$allvalue;                
    //     }

    //     $calandarData = [];

    //     foreach ($expenseslist as $allvalue) {
    //         $allvalue['bank'] = $myData [$allvalue['bank_account']];

    //             $calandarData[]=$allvalue;
                
    //     }
    //     $incomeData=[];

    //     foreach ($incometable as $allvalue) {
    //         $allvalue['bank'] = $myData [$allvalue['bankAccount']];

    //             $incomeData[]=$allvalue;
                
    //     }
    //     //  echo '<pre>';print_r($incomeData);die;

    //     $events = []; 
    
    //     foreach ($calandarData as $expense) {
    //         $events[] = [
    //             'expense_category' => $expense['expense_category'],
    //             "username" => $this->session->get('name'),
    //             'account' => $expense['bank']['account_number'],
    //             'bank' => $expense['bank']['bank']->bank_name,
    //             'amount' => $expense['amount'],
    //             'description' => $expense['description'],
    //             'note' => $expense['note'],
    //             'reference' => $expense['reference'],
    //             'date' => $expense['date'],
                
    //         ];
    //     }

    
    //     return $this->response->setJSON($events);
        
    // }
  


}
