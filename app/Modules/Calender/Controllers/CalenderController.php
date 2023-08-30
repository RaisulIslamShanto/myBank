<?php

namespace Modules\Calender\Controllers;

use App\Controllers\BaseController;
use Modules\Calender\Models\SettingModel;
use Modules\BankAccount\Models\BankAccountModel;
use Modules\Expenses\Models\ExpensesModel;
use Modules\IncomeModule\Models\IncomeModel;

class CalenderController extends BaseController{

    public $session,$db;

    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }


    public function Calendar(){


        $expensesmodel = new ExpensesModel();
        $expenseslist = $expensesmodel->findAll();

        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->findAll();

        $IncomeModel = new IncomeModel;
        $incomelist = $IncomeModel->findAll();
        
        // echo "<pre>";
        // print_r($incometable);
        // die();

        $db = \Config\Database::connect();


      // join query
      

      $query = $db->table('bank_account')
          ->select('account_number,bank_name,incometable.*,categorytable.*')
          
          ->join('bank_list', 'bank_account.bank_name_id = bank_list.id', 'left')
          ->join('incometable', 'bank_account.id = incometable.bankAccount', 'right')
          ->join('categorytable', 'incometable.incomeCategory = categorytable.categoryId', 'left')
          ->get();
      $data = $query->getResultArray();


    //   echo "<pre>";
    //   print_r($data);
    //   die();


    //   end join query


        // for income data only

    //     $incomeandaccounts=[];

    //     foreach ($incomelist as $incomedata){

    //         $incomedata['accountstable'] = $db->table('bank_account')
    //                                         ->where('id',$incomedata['bankAccount'])
    //                                         ->get()
    //                                         ->getRow();
    //                $incomeandaccounts[$incomedata['incomeId']] = $incomedata;                         
    //     }

    //     echo "<pre>";
    //     print_r($incomeandaccounts);
    //     die();

    //     $incomeandaccountsandbank = [];

    //     foreach($incomeandaccounts as $allvalue){

    //         $allvalue['bank'] =  $db->table('bank_list')->where('id',$accountlist['bank_name_id'])->get()->getRow();
    //         $incomeandaccountsandbank[] = $allvalue;
    //   }
        
    //     echo "<pre>";
    //     print_r($incomeandaccountsandbank);
    //     die();

    //     foreach ($accountlist as $bankaccount){
    //         $incomeandaccounts['bank']= $db->table('bank_list')
    //                                          ->where('id',$bankaccount['bank_name_id']) 
    //                                          ->get()
    //                                          ->getRow();
    //             $incomeandaccountsandbank[] = $incomeandaccounts;                            
    //     }

        


        // end of income data only my try

        // copy

        // $myData = [];

        // foreach ($accountlist as $allvalue) {
        //     $allvalue['bank'] = $db->table('bank_list')
        //         ->where('id', $allvalue['bank_name_id'])
        //         ->get()
        //         ->getRow();

        //         $myData[$allvalue['id']]=$allvalue;                
        // }

        // // echo "<pre>";
        // // print_r($myData);
        // // die();

        // $incomeData = [];

        // foreach ($incomelist as $allvalue) {
        //     $allvalue['bank'] = $myData[$allvalue['bankAccount']];

        //         $incomeData[]=$allvalue;
                
        // }

        // echo "<pre>";
        // print_r($incomeData);
        // die();
        // copyend

 // almin expense code

        // $myData = [];

        // foreach ($accountlist as $allvalue) {
        //     $allvalue['bank'] = $db->table('bank_list')
        //         ->where('id', $allvalue['bank_name_id'])
        //         ->get()
        //         ->getRow();

        //         $myData[$allvalue['id']]=$allvalue;                
        // }

        // $calandarData = [];

        // foreach ($expenseslist as $allvalue) {
        //     $allvalue['bank'] = $myData[$allvalue['bank_account']];

        //         $calandarData[] = $allvalue;
                
        // }
        // $events = []; 
    
        // foreach ($expensedata as $expense) {
        //     $events[] = [
        //         'expense_category' => $expense['expense_category'],
        //         "username" => $this->session->get('name'),
        //         'account' => $expense['bank']['account_number'],
        //         'bank' => $expense['bank']['bank']->bank_name,
        //         'amount' => $expense['amount'],
        //         'description' => $expense['description'],
        //         'note' => $expense['note'],
        //         'reference' => $expense['reference'],
        //         'date' => $expense['date'],
                
        //     ];
        // }

//    alamin expense code end
        
            $query = $db->table('bank_account')
            ->select('account_number,bank_name,expenses.*,categorytable.*')
            
            ->join('bank_list', 'bank_account.bank_name_id = bank_list.id', 'left')
            ->join('expenses', 'bank_account.id = expenses.bank_account', 'right')
            ->join('categorytable', 'expenses.expense_category = categorytable.categoryId', 'left')
            ->get();
            $expensedata = $query->getResultArray();

            // echo "<pre>"; print_r($expensedata);die();


        // $incomeData=[];

        // foreach ($incometable as $allvalue) {
        //     $allvalue['bank'] = $myData [$allvalue['bankAccount']];

        //         $incomeData[]=$allvalue;
                
        // }
        //  echo '<pre>';print_r($incomeData);die;

        $events = []; 
    
        foreach ($expensedata as $expense) {
            $events[] = [
                'categoryName' => $expense['categoryName'],
                "username" => $this->session->get('name'),
                'account' => $expense['account_number'],
                'bank' => $expense['bank_name'],
                'amount' => $expense['amount'],
                'description' => $expense['description'],
                'note' => $expense['note'],
                'reference' => $expense['reference'],
                'date' => $expense['date'],
                
            ];
        }


        $incomeevents = [];

        foreach ($data as $income) {

            $incomeevents[] = [
                'categoryName' => $income['categoryName'],
                "username" => $this->session->get('name'),
                'account' => $income['account_number'],
                'bank' => $income['bank_name'],
                'amount' => $income['amount'],
                'description' => $income['description'],
                'note' => $income['note'],
                'reference' => $income['reference'],
                'date' => $income['date'],
                
            ];
        }
    
        // return $this->response->setJSON($events);
        

        return view('Modules\Calender\Views\admin\bank\calendar', [
            "username" => $this->session->get('name'),
            "events" => json_encode($events),
            "incomeevents" => json_encode($incomeevents),
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
