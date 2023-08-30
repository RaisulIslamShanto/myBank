<?php

namespace Modules\DashboardModule\Controllers;

// use Modules\Demo\Models\Demomodel;
// use Modules\Demo\Models\Blogmodel;
use App\Controllers\BaseController;
use Modules\BalanceTransfer\Models\BalanceTransferModel;
use Modules\DebitsLoans\Models\DebtsLoansModel;
use Modules\BankAccount\Models\BankAccountModel;
use Modules\Bank\Models\BankListModel; 
use Modules\DebitsLoans\Models\UpdateDebtsModel;
use Modules\DebitsLoans\Models\LendModel;
use Modules\Budgets\Models\BudgetsModel;
use Modules\DashboardModule\Models\Dashboardmodel;
use Modules\BankModule\Models\BankModel;
use Modules\ApplicationSetting\Models\SettingModel;

 
class DashboardController extends BaseController{

    public $session,$db;

    public function __construct(){
        // parent::__construct();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    /**
     * This method index shows Floor list of a property.
     * Method - get
     */
    public function dashboard(){

        // $BankModel = new BankModel;

        // $bankacc = $BankModel->findAll();
        $settingmodel = new SettingModel();
        $settingdata = $settingmodel->where('id',1)->findAll();
        // echo "<pre>";
        // print_r($settingdata);die();
        $currency = $settingdata[0]['default_currency'];

        // var_dump($currency);die();
        // print_r($currency);die();

        $db = \Config\Database::connect(); 

        $query = $db->table('bank_list'); 
        $rowCount = $query->countAllResults();

        $query = $db->table('incometable'); 
        $query->selectSum('amount')->where('MONTH(date)', date('m'))->where('YEAR(date)', date('Y'));
        $income = $query->get()->getRow();
        $totalAmount = $income->amount;

        // var_dump($totalAmount);die();

        $query = $db->table('expenses'); 
        $query->selectSum('amount');
        $expense = $query->get()->getRow();

        $totalexpense = $expense->amount;

        $totalAmountBalance = $totalAmount-$totalexpense;

        $query = $db->table('lend'); 
        $query->selectSum('amount');
        $lend = $query->get()->getRow();

        $totallend = $lend->amount;

        $query = $db->table('lend'); 
        $query->selectSum('amount');
        $borrow = $query->get()->getRow();

        $totalborrow = $borrow->amount;

        // balance transfer

        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->findAll();

        // echo '<pre>'; print_r($accountlist); die;

        $balance = new BalanceTransferModel();
        $getBalance = $balance->findAll();

        // echo '<pre>'; print_r($getBalance); die;
        
        $banklistmodel = new BankListModel();
        $banklist = $banklistmodel->findAll();

        // for budget table show

        $BudgetsModel = new BudgetsModel();
        $budgetlist = $BudgetsModel->findAll();

        //  echo '<pre>'; print_r($budgetlist); die;

        // for balance transfer table show
        $query = $db->table('balance_transfer'); 
        $balance = $query->get()->getResultArray();

        $db = \Config\Database::connect();
        // $myData = [];


        $myData = [];

        foreach ($accountlist as $allvalue) {
            $allvalue['banktable']=$db->table('bank_list')
                ->where('id',$allvalue['bank_name_id'])
                ->get()
                ->getRow();

                $myData[$allvalue['id']]=$allvalue;
                
        }


        $balanceData = [];

        foreach ($getBalance as $allvalue) {

            $allvalue['from_bank'] = $myData [$allvalue['from_account']];
            $allvalue['to_bank'] = $myData [$allvalue['to_account_id']];

            $balanceData[]=$allvalue;
                
        }
        
        $query = $bankaccount->db->table('bank_account')
        ->select('bank_account.*, bank_list.bank_name, balance_transfer.amount as transfer_amount')
        ->join('bank_list', 'bank_list.id = bank_account.bank_name_id', 'left')
        ->join('balance_transfer', 'balance_transfer.to_account_id = bank_account.id', 'left')
        ->get();

        $data2['accounts'] = $query->getResult();

        // $query = $db->table('balance_transfer')
        //             ->select('balance_transfer.*,bank_account.*,banklist.*')
        //             ->join('bank_account','balance_transfer.from_account=bank_account.id','left')
        //             ->join('bank_list','balance_transfer')
        //             ->join('categorytable', 'incometable.incomeCategory = categorytable.categoryId', 'left');
        
        // for pie chart

        $query = $db->table('expenses')
                    ->select('expenses.*,categorytable.*')
                    ->join('categorytable','expenses.expense_category = categorytable.categoryId');
                    
        $pievalue = $query->get()->getResultArray();
     
        // echo '<pre>'; print_r($pievalue);die;
        
        return view('Modules\DashboardModule\Views\admin\dashboardpage',[
            'bankaccount' =>$rowCount,
            'income'=>$totalAmount,
            'balance'=>$balance,
            'expense'=>$totalexpense,
            'totalAmountBalance'=>$totalAmountBalance,
            'totallend'=>$totallend,
            'totalborrow'=>$totalborrow, 
            'chartvalue'=>$pievalue,
            'budgetlist'=>$budgetlist,
            'balanceData'=>$balanceData, 
            'currency'=>$currency
    ]);

    }

    public function countRows()
    {
        $db = \Config\Database::connect(); 

        $query = $db->table('banktable'); 
        $rowCount = $query->countAllResults();

        // echo "Total number of rows in the bank table: " . $rowCount;
    }



    public function savecategory(){

        $data = [
   
            'categoryName'=>$this->request->getPost('categoryName'),
            'categoryType'=>$this->request->getPost('categoryType')

           ];
           
            //    echo'<pre>';
            //    print_r($data);
            //    die();

            $Categorymodel = new Categorymodel;
            $Categorymodel->insert($data);
            
           
        

        return $this->response->setJSON(['status' => 'success', 'message' => 'File inserted successfully.']);
    //     return view('Modules\CategoryModule\Views\admin\categorypage');

    }
    public function deletecat($id)
    {

        $Categorymodel = new Categorymodel;
        $catdeleted = $Categorymodel->delete($id);
        
        
        return redirect()->to('admin/categorypage')->with('status', 'success');
        // return view('Modules\CategoryModule\Views\admin\categorypage',['cattable'=>$cattable]);
        
    }
    public function editcat()
    {
        
        $id  = $this->request->getPost('id');

        $Categorymodel = new Categorymodel();
        $data = $Categorymodel->where('categoryId',$id)->findAll();

        // print_r($data);
        // die();
    
        return json_encode($data);

        // return view('variantcategory/editCategory', ['catdata'=>$data,'menuValue'=>$menuValue,'homepageValue'=>$homepageValue]); 
       
    }
    
    public function updatecat($id)
    {
       
     $Categorymodel = new Categorymodel;
     $catrow = $Categorymodel->find($id);

     $data = [
   
        'categoryName'=>$this->request->getPost('categoryName'),
        'categoryType'=>$this->request->getPost('categoryType')

       ]; 

       // print_r($data);
        // die();
        $Categorymodel->update($id,$data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Form updated successfully.']);
       
    }

    
}
