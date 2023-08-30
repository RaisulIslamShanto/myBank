<?php

namespace Modules\Expenses\Controllers;

use App\Controllers\BaseController;
// use Modules\CategoryModule\Models\CategoryModel;
use Modules\BalanceTransfer\Models\BalanceTransferModel;
use Modules\BalanceTransfer\Models\DebtsLoansModel;
use Modules\BankAccount\Models\BankAccountModel;
use Modules\Expenses\Models\ExpensesModel;
use Modules\CategoryModule\Models\CategoryModel;

class ExpensesController extends BaseController{

    
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
    public function Expenses(){
       


        $bankaccount = new BankAccountModel();
        // $accountlist = $bankaccount->findAll();
        $accountlist = $bankaccount->where('deleted_at', null)->findAll();

        $balance = new BalanceTransferModel();
        $getBalance = $balance->findAll();

        $expensesmodel = new ExpensesModel();
        $expenseslist = $expensesmodel->findAll();

       

        $CategoryModel = new CategoryModel();
        $Categorytable = $CategoryModel
        ->like('categoryType', 'expense')
        ->findAll();
        // $Categorytable = $Categorymodel->findAll();

        // echo"<pre>"; print_r($Categorytable);die();

        $db = \Config\Database::connect();

        $query = $db->table('expenses')
        ->select('expenses.*,categoryName,account_number')
        ->join('categorytable', 'expenses.expense_category = categorytable.categoryId', 'left')
        ->join('bank_account', 'expenses.bank_account = bank_account.id', 'left')
        ->get();
        $expensedata = $query->getResultArray();

        // echo"<pre>";print_r($expensedata);die();


// alamin code

        $myData = [];
        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();
        

                $myData[]=$allvalue;
                
        }

        $myexpData = [];

        foreach ($expenseslist as $allvalue) {
            $allvalue['exp'] = $db->table('bank_account')
                ->where('id', $allvalue['bank_account'])
                ->get()
                ->getRow();


                $myexpData[]=$allvalue;
                
        }
        // alamin code end
       
        // echo"<pre>";print_r($myexpData);die();

        return view('Modules\Expenses\Views\admin\bank\expenses-list', [
            "username" => $this->session->get('name'),
            'data' => $myData,
            "expenseslist" => $expenseslist,
            "myexpData" => $myexpData,
            "Categorytable"=> $Categorytable,
            "getBalance" => $getBalance,
            "accountlist" => $accountlist,
            "expensedata" => $expensedata

        ]);
    }




    public function AddExpenses()
    {
    
        $Categorymodel = new Categorymodel;
        $Categorytable = $Categorymodel->findAll();
    
        $expensesmodel = new ExpensesModel();
        $expenseslist = $expensesmodel->findAll();
    
        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->where('deleted_at', null)->findAll();
    
        $balance = new BalanceTransferModel();
        $getBalance = $balance->findAll();
    
        $db = \Config\Database::connect();
        $myData = [];
    
        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();
            $myData[] = $allvalue;
        }

        // echo '<pre>';
        // print_r($myData);
        // die;

        $myexpData = [];

        foreach ($expenseslist as $allvalue) {
            $allvalue['exp'] = $db->table('bank_account')
                ->where('id', $allvalue['bank_account'])
                ->get()
                ->getRow();
        
                $myexpData[]=$allvalue;
                
        }
    
        if ($this->request->getMethod() == 'post') {
            $attchFile = $this->request->getFile('Attachment');
            $newName = '';
    
            if ($attchFile->isValid() && !$attchFile->hasMoved()) {
                $newName = $attchFile->getRandomName();
                $attchFile->move(ROOTPATH . 'public/expensesAttachment', $newName);
            }
    
            $expensesData = [
                'expense_category' => $this->request->getVar('Category'),
                'bank_account' => $this->request->getVar('ToAccount'),
                'amount' => $this->request->getVar('Amount'),
                'reference' => $this->request->getVar('Reference'),
                'description' => $this->request->getVar('Description'),
                'note' => $this->request->getVar('note'),
                'add_attachment' => $newName,
                'date' => $this->request->getVar('date'),
            ];
    
            $bankAccountId = $this->request->getVar('ToAccount');
            $amount = $this->request->getVar('Amount');
    
            $bankAccount = $bankaccount->find($bankAccountId);
    
            if (!$bankAccount) {
                $response = [
                    'error' => [
                        'status' => 'error',
                        'message' => 'Invalid bank account.',
                    ],
                ];
                return json_encode($response);
            }
    
            if ($bankAccount['initial_balance'] >= $amount) {
    
                $res = $expensesmodel->insert($expensesData);

                $response = [
                    'success' => [
                        'status' => 'ok',
                        'message' => 'Data inserted successfully.',
                    ],
                ];
                return json_encode($response);

    
                if ($res) {
                    $newBalance = $bankAccount['initial_balance'] - $amount;
                    $bankaccount->update($bankAccountId, ['initial_balance' => $newBalance]);
    
                    $expdata['getexp'] = $expensesmodel->findAll();
                    return view('Modules\Expenses\Views\admin\bank\expense-list', [
                        "username" => $this->session->get('name'),
                        'data' => $myData,
                        "expenseslist" => $expenseslist,
                        "myexpData" => $myexpData,
                    ]);
                }
            } else {

                $response = [
                    'error' => [
                        'status' => 'error',
                        'message' => 'Insufficient balance in the bank account.',
                    ],
                ];
                return json_encode($response);
            }
        }
    
        $data['getexpenses'] = $expensesmodel->findAll();
        return view('Modules\Expenses\Views\admin\bank\add-expenses', [
            "username" => $this->session->get('name'),
            "getBalance" => $getBalance,
            "accountlist" => $accountlist,
            'data' => $myData,
            "expenseslist" => $expenseslist,
            "Categorytable" => $Categorytable,
        ]);
    }


    public function ExpensesListEdit()
    {

        $id = $this->request->getGET('id');

        $CategoryModel = new CategoryModel();

        $expnseCategories = $CategoryModel
            ->like('categoryType', 'expense')
            ->findAll();

        $Categorymodel = new Categorymodel;
        $Categorytable = $Categorymodel->findAll();

        $expensesmodel = new ExpensesModel();
        $expenseslist = $expensesmodel->find([$id]);
    
        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->where('deleted_at', null)->findAll();

        $db = \Config\Database::connect();
        $expData = [];

        foreach ($expenseslist as $allvalue) {
            $allvalue['cat'] = $db->table('categorytable')
                ->where('categoryId ', $allvalue['expense_category'])
                ->get()
                ->getRow();
                $expData[]=$allvalue;
                
        }

        // echo '<pre>';print_r($expData);die;

        $db = \Config\Database::connect();
        $myData = [];

        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();
                $myData[]=$allvalue;
                
        }

        $data['expensedata'] = $expensesmodel->where('id', $id)->findAll();

        // echo"<pre>"; print_r($data); die();

        $alldata=[
            // 'data' => $myData,
            // "expenseslist" => $expenseslist,
            // "Categorytable" => $Categorytable,
            // "expData" => $expData,
            "editexpenses"=>$data

        ];

        return json_encode($data);

        // return view('Modules\Expenses\Views\admin\bank\expenses-list', [
        //     // "accountlist" => $accountlist,
        //     'data' => $myData,
        //     "expenseslist" => $expenseslist,
        //     "Categorytable" => $Categorytable,
        //     "expData" => $expData,

        // ]);
    }

    public function UpdateExpenses($id)
    {

            $validation = \Config\Services::validation();

            $rules = [
                'Category' => 'required',
                'ToAccount' => 'required',
                'Amount' => 'required|numeric',
                'Reference' => 'required',
                'Description' => 'required',
                'note' => 'required',
                'date' => 'required',
            
            ];


            $validation->setRules($rules, [
                'Category' => [
                    'required' => 'Please enter an Category.',
                ],
                'ToAccount' => [
                    'required' => 'Please enter a Account.',
                ],
                'Amount' => [
                    'required' => 'Please enter Amount.',
                ],
                'Reference' => [
                    'required' => 'Please enter Reference.',
                ],
                'Description' => [
                    'required' => 'Please enter your Description.',
                ],
                'note' => [
                    'required' => 'Please enter note.',
                ],
                'date' => [
                    'required' => 'Please enter your date.',
                ],
            ]);

            if (!$this->validate($rules)) {
                $response = [
                    'Category' => [
                        'status' => 'error',
                        'message' => $validation->getError('Category') ?: '',
                    ],
                    'ToAccount' => [
                        'status' => 'error',
                        'message' => $validation->getError('ToAccount') ?: '',
                    ],
                    'Amount' => [
                        'status' => 'error',
                        'message' => $validation->getError('Amount') ?: '',
                    ],
                    'Reference' => [
                        'status' => 'error',
                        'message' => $validation->getError('Reference') ?: '',
                    ],
                    'Description' => [
                        'status' => 'error',
                        'message' => $validation->getError('Description') ?: '',
                    ],
                    'note' => [
                        'status' => 'error',
                        'message' => $validation->getError('note') ?: '',
                    ],
                    'date' => [
                        'status' => 'error',
                        'message' => $validation->getError('date') ?: '',
                    ],
                ];
                return json_encode($response);
            }

            
            $expensesmodel = new ExpensesModel();
            $expenseslist = $expensesmodel->find([$id]);


        // if ($this->request->getMethod() == 'post') {
        //     $attchFile = $this->request->getFile('Attachment');
        //     $newName = '';
    
        //     if ($attchFile->isValid() && !$attchFile->hasMoved()) {
        //         $newName = $attchFile->getRandomName();
        //         $attchFile->move(ROOTPATH . 'public/expensesAttachment', $newName);
        //     }
    

            if ($this->request->getMethod() === 'post') {
                    $Category = $this->request->getPost('Category');
                    $ToAccount = $this->request->getPost('ToAccount');
                    $Amount = $this->request->getPost('Amount');
                    $Reference = $this->request->getPost('Reference');
                    $Description = $this->request->getPost('Description');
                    $note = $this->request->getPost('note');
                    $date = $this->request->getPost('date');
                
                    $data = [
                        'expense_category' =>$Category,
                        'bank_account' => $ToAccount,
                        'amount' => $Amount,
                        'reference' => $Reference,
                        'description' => $Description,
                        'note' => $note,
                        // 'add_attachment' => $newName,
                        'date' => $date,

                    ];

                    $expensesmodel->update([$id],$data);

                    $response = [
                        'success' => true,
                        'message' => 'Data updated successfully.'
                    ];
                    return $this->response->setJSON($response);
                }
        
        $data = $expensesmodel->find([$id]); 
        return view('Modules\Expenses\Views\admin\bank\expenses-list',$data);
    }



    public function ExpensesDelete($id)
    {

        $expensesmodel = new ExpensesModel();
        $data = $expensesmodel->find($id);

        if ($data) {
            $expensesmodel->delete($id);

            $response = [
                'success' => true,
                'message' => 'Expenses deleted successfully.'
            ];
        } 
     return $this->response->setJSON($response);

     $data['getexp']= $expensesmodel->findall();
     return view('Modules\Expenses\Views\admin\bank\expenses-list',$data);

    }

    
}
