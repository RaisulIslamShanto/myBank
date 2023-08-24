<?php

namespace Modules\Bank\Controllers;

use App\Controllers\BaseController;
use Modules\Bank\Models\BalanceTransferModel;
use Modules\Bank\Models\DebtsLoansModel;
use Modules\Bank\Models\BankAccountModel;
use Modules\Bank\Models\BankListModel;
use Modules\Bank\Models\UpdateDebtsModel;
use Modules\Bank\Models\LendModel;
use Modules\Bank\Models\DebtsCollectionModel;

class BalanceTransferController extends BaseController{
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
    public function BalanceTransfer($pro_id=''){
        if(!empty($pro_id) && is_numeric($pro_id)){
            $this->session->set('rs_property_id',$pro_id);

            if(valid_user($pro_id)==false){
                return redirect()->back();
            }


        }
        $property_id=$this->session->get('rs_property_id');

        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->where('property_id',$property_id)->findAll();

        // echo '<pre>'; print_r($accountlist); die;

        $balance = new BalanceTransferModel();
        $getBalance = $balance->where('property_id', $property_id)->findAll();
// echo '<pre>'; print_r($getBalance); die;
        
        $banklistmodel = new BankListModel();
        $banklist = $banklistmodel->where('property_id',$property_id)->findAll();

        // echo '<pre>'; print_r($getBalance); die;

        // $builder = $balance->select('balance_transfer.*, bank_account.*')
        // ->join('bank_account', 'balance_transfer.id = bank_account.id', 'left');

        // $data= $builder->get()->getResultArray();

        // echo '<pre>'; print_r($data); die;


        $db = \Config\Database::connect();
        $myData = [];

        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();

                $myData[$allvalue['id']]=$allvalue;
                
        }

// echo '<pre>';
// print_r($myData);
// die();



        $db = \Config\Database::connect();
        $balanceData = [];

        foreach ($getBalance as $allvalue) {
            $allvalue['bank'] = $myData [$allvalue['from_account']];
            $allvalue['to_bank'] =$myData [$allvalue['to_account_id']];

                $balanceData[]=$allvalue;
                
        }

// echo '<pre>';
// print_r($balanceData);
// die();

                    // $query = $bankaccount->db->table('bank_account')
                    // ->select('bank_account.*, bank_list.bank_name, balance_transfer.amount as transfer_amount')
                    // ->join('bank_list', 'bank_list.id = bank_account.bank_name_id', 'left')
                    // ->join('balance_transfer', 'balance_transfer.to_account_id = bank_account.id', 'left')
                    // ->get();

                    // $data2['accounts'] = $query->getResult();
                    // echo '<pre>'; print_r($data2);  die;        


        return view('Modules\Bank\Views\admin\bank\transfer-histories', [
            "getBalance" => $getBalance,
            "accountlist" => $accountlist,
            'data' => $myData,
            // "data2" => $data2,
            "balanceData" => $balanceData,

        ]);
    }



    public function BalanceTransferAdd()
    {
        $property_id = $this->session->get('rs_property_id');
    
        $validation = \Config\Services::validation();
    
        $rules = [
            'FromAccount' => 'required',
            'ToAccount' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'note' => 'required',
        ];
    
        $validation->setRules($rules, [
            'FromAccount' => [
                'required' => 'Please enter From Account.',
            ],
            'ToAccount' => [
                'required' => 'Please enter To Account.',
            ],
            'amount' => [
                'required' => 'Please enter amount.',
            ],
            'date' => [
                'required' => 'Please enter date.',
            ],
            'note' => [
                'required' => 'Please enter note.',
            ],
        ]);
    
        if (!$this->validate($rules)) {
            $response = [
                'FromAccount' => [
                    'status' => 'error',
                    'message' => $validation->getError('FromAccount') ?: '',
                ],
                'ToAccount' => [
                    'status' => 'error',
                    'message' => $validation->getError('ToAccount') ?: '',
                ],
                'amount' => [
                    'status' => 'error',
                    'message' => $validation->getError('amount') ?: '',
                ],
                'date' => [
                    'status' => 'error',
                    'message' => $validation->getError('date') ?: '',
                ],
                'note' => [
                    'status' => 'error',
                    'message' => $validation->getError('note') ?: '',
                ],
            ];
            return json_encode($response);
        }
    
        $balanceTransferModel = new BalanceTransferModel();
        $bankAccountModel = new BankAccountModel();
    
        $fromAccountId = $this->request->getVar('FromAccount');
        $toAccountId = $this->request->getVar('ToAccount');
        $amount = $this->request->getVar('amount');
    
        $fromAccount = $bankAccountModel->find($fromAccountId);
        $toAccount = $bankAccountModel->find($toAccountId);
    
        if (!$fromAccount || !$toAccount) {
            $response = [
                'error' => [
                    'status' => 'error',
                    'message' => 'Invalid source or destination account.',
                ],
            ];
            return json_encode($response);
        }
    
        if ($fromAccount['initial_balance'] >= $amount) {

            $balanceData = [
                'from_account' => $fromAccountId,
                'to_account_id' => $toAccountId,
                'amount' => $amount,
                'transfer_date' => $this->request->getVar('date'),
                'note' => $this->request->getVar('note'),
                'property_id' => $property_id,
            ];
    
            $balanceTransferModel->insert($balanceData);
    
            $newBalanceFrom = $fromAccount['initial_balance'] - $amount;
            $bankAccountModel->update($fromAccountId, ['initial_balance' => $newBalanceFrom]);
    
            $newBalanceTo = $toAccount['initial_balance'] + $amount;
            $bankAccountModel->update($toAccountId, ['initial_balance' => $newBalanceTo]);
    
            $response = [
                'success' => [
                    'status' => 'ok',
                    'message' => 'Transfer successful.',
                ],
            ];
            return json_encode($response);
        } else {
            $response = [
                'error' => [
                    'status' => 'error',
                    'message' => 'You Do not have enough balance in your account.',
                ],
            ];
            return json_encode($response);
        }
    }
    



    public function DebtsLoans($pro_id=''){
        if(!empty($pro_id) && is_numeric($pro_id)){
            $this->session->set('rs_property_id',$pro_id);

            if(valid_user($pro_id)==false){
                return redirect()->back();
            }


        }
        $property_id=$this->session->get('rs_property_id');

        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->where('property_id',$property_id)->findAll();

        $debts = new DebtsLoansModel();
        $getDebts = $debts->where('property_id',$property_id)->findAll();


        $db = \Config\Database::connect();
        $myData = [];

        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();
        
            // $allvalue['to_bank'] = $db->table('bank_account')
            //     ->where('id', $allvalue['to_account_id'])
            //     ->get()
            //     ->getRow();

                $myData[]=$allvalue;
                
        }

        $debtsData = [];

        foreach ($getDebts as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_account'])
                ->get()
                ->getRow();
        
            // $allvalue['to_bank'] = $db->table('bank_account')
            //     ->where('id', $allvalue['to_account_id'])
            //     ->get()
            //     ->getRow();

                $debtsData[]=$allvalue;
                
        }

// echo '<pre>';
//         print_r($debtsData);
//         die();


        // $db = \Config\Database::connect();
        // $myData = [];

        // foreach ($getDebts as $allvalue) {
        //     $allvalue['bank'] = $db->table('bank_account')
        //         ->where('id', $allvalue['bank_account'])
        //         ->get()
        //         ->getRow();
        
        //     // $allvalue['to_bank'] = $db->table('bank_account')
        //     //     ->where('id', $allvalue['to_account_id'])
        //     //     ->get()
        //     //     ->getRow();

        //         $myData[]=$allvalue;
                
        // }
        // echo '<pre>';
        // print_r($myData);
        // die();


        return view('Modules\Bank\Views\admin\bank\debts-loans', [
            "getDebts" => $getDebts,
            "accountlist" => $accountlist,
            "data" => $myData,
            "debtsData" => $debtsData,
        ]);
    }




    public function AddDebtsLoans()
    {
        $property_id = $this->session->get('rs_property_id');
    
        $validation = \Config\Services::validation();
    
        $rules = [
            'amount' => 'required', 
            'BankAccount' => 'required',
            'Type' => 'required',
            'Person' => 'required',
            'date' => 'required',
            'note' => 'required',  
        ];
    
        $validation->setRules($rules, [
            'amount' => [
                'required' => 'Please enter amount.',
            ],
            'BankAccount' => [
                'required' => 'Please enter Bank Account.',
            ],
            'Type' => [
                'required' => 'Please enter type.',
            ],
            'Person' => [
                'required' => 'Please enter person.',
            ],
            'date' => [
                'required' => 'Please enter date.',
            ],
            'note' => [
                'required' => 'Please enter note.',
            ],
        ]);
    
        if (!$this->validate($rules)) {
            $response = [
                'amount' => [
                    'status' => 'error',
                    'message' => $validation->getError('amount') ?: '',
                ],
                'BankAccount' => [
                    'status' => 'error',
                    'message' => $validation->getError('BankAccount') ?: '',
                ],
                'Type' => [
                    'status' => 'error',
                    'message' => $validation->getError('Type') ?: '',
                ],
                'Person' => [
                    'status' => 'error',
                    'message' => $validation->getError('Person') ?: '',
                ],
                'date' => [
                    'status' => 'error',
                    'message' => $validation->getError('date') ?: '',
                ],
                'note' => [
                    'status' => 'error',
                    'message' => $validation->getError('note') ?: '',
                ],
            ];
            return json_encode($response);
        }
    
        $debtsLoansModel = new DebtsLoansModel();
        $bankAccountModel = new BankAccountModel();
    
        $amount = $this->request->getVar('amount');
        $bankAccountId = $this->request->getVar('BankAccount');
    

        $bankAccount = $bankAccountModel->find($bankAccountId);
    
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

            $debtsLoansData = [
                'amount' => $amount,
                'bank_account' => $bankAccountId,
                'select_type' => $this->request->getVar('Type'),
                'person' => $this->request->getVar('Person'),
                'date' => $this->request->getVar('date'),
                'note' => $this->request->getVar('note'),
                'property_id' => $property_id,
            ];
    
            $debtsLoansModel->insert($debtsLoansData);
    
            $newBalance = $bankAccount['initial_balance'] - $amount;
            $bankAccountModel->update($bankAccountId, ['initial_balance' => $newBalance]);
    
            $response = [
                'success' => [
                    'status' => 'ok',
                    'message' => 'Debt added successfully.',
                ],
            ];
            return json_encode($response);
        } else {
            $response = [
                'error' => [
                    'status' => 'error',
                    'message' => 'Not enough balance in Your bank account.',
                ],
            ];
            return json_encode($response);
        }
    }
    


    public function DebtsDelete($id)
    {
        $property_id=$this->session->get('rs_property_id');
        $debts = new DebtsLoansModel();
        $data = $debts->find($id);
  
        if ($data) {
            $debts->delete($id);

            $response = [
                'success' => true,
                'message' => 'debts deleted successfully.'
            ];
        } 
     return $this->response->setJSON($response);


     return view('Modules\Bank\Views\admin\bank\debts-loans',$data);
    }





    public function DebtsEdit($id)
    {

        $lendmodel = new LendModel();
        $lend = $lendmodel->findAll();
        //   echo '<pre>';
        // print_r($lend);
        // die;

        $property_id=$this->session->get('rs_property_id');
        $debts = new DebtsLoansModel();
        $data2 = $debts->find($id);
        // echo '<pre>';
        // print_r($data2);
        // die;
        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->where('property_id',$property_id)->findAll();

        $getDebts = $debts->where('property_id',$property_id)->findAll();

        $UpdateDebts = new UpdateDebtsModel();
        $UpdateDebtslist = $UpdateDebts->where('property_id',$property_id)->findAll();

        
        $db = \Config\Database::connect();
        $myData = [];

        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();

                $myData[$allvalue['id']]=$allvalue;
                
        }


        $db = \Config\Database::connect();
        $balanceData = [];

        foreach ($lend as $allvalue) {
            $allvalue['bank'] = $myData [$allvalue['bank_account']];
            // $allvalue['to_bank'] =$myData [$allvalue['to_account_id']];

                $balanceData[]=$allvalue;
                
        }

   
        // echo '<pre>';print_r($balanceData);die;

        $data['getdebts']= $debts->where('property_id',$property_id)->findall();
        return view('Modules\Bank\Views\admin\bank\manage-debts',[
            "username" => $this->session->get('name'),
            "getDebts" => $getDebts,
            "accountlist" => $accountlist,
             "data" =>$myData,
            // "debtsData" => $debtsData,
            "data2"=> $data2,
            "lend" => $lend,
            "balanceData" => $balanceData,
            // "UpdateDebtslist" => $UpdateDebtslist,
        ]);

        // return view('Admin_Template/edit_CRM', [
        //     'data' => $data,
            
        // ]);

    }



    public function AddLend($id)
     {
        $property_id = $this->session->get('rs_property_id');
        $validation = \Config\Services::validation();
    
        $rules = [
            'amount' => 'required',
            'BankAccount' => 'required', 
            'date' => 'required',             
        ];
        $validation->setRules($rules, [
            'amount' => [
                'required' => 'Please enter amount.',
            ],
            'BankAccount' => [
                'required' => 'Please enter Bank Account.',
            ],
            'date' => [
                'required' => 'Please enter date.',
            ],
        ]);

        if (!$this->validate($rules)) {
            $response = [
                'amount' => [
                    'status' => 'error',
                    'message' => $validation->getError('amount') ?: '',
                ],
                'BankAccount' => [
                    'status' => 'error',
                    'message' => $validation->getError('BankAccount') ?: '',
                ],
                'date' => [
                    'status' => 'error',
                    'message' => $validation->getError('date') ?: '',
                ],
            ];
            return json_encode($response);
        }
    
        $lendmodel = new LendModel();
        $bankAccountModel = new BankAccountModel(); 
        $data = array();
        
        $amount = $this->request->getVar('amount');
        $bankAccountId = $this->request->getVar('BankAccount');
        
        $bankAccount = $bankAccountModel->find($bankAccountId);
    
        if (!$bankAccount || $bankAccount['initial_balance'] < $amount) {
            $response = [
                'error' => [
                    'status' => 'error',
                    'message' => 'Insufficient balance in the selected bank account.',
                ],
            ];
            return json_encode($response);
        }
    
        $newBalance = $bankAccount['initial_balance'] - $amount;
        $bankAccountModel->update($bankAccountId, ['initial_balance' => $newBalance]);
    
        $lendData = [
            'amount'    => $amount,
            'bank_account'    => $bankAccountId,
            'date'    => $this->request->getVar('date'),
            'type' => $this->request->getVar('lend'),
            'property_id' => $property_id
        ];
    
        $lendmodel->insert($lendData);
        $res = $lendmodel->findAll();
    
        $response = [
            'success' => [
                'status' => 'ok',
                'message' => 'Data inserted successfully.',
            ],
        ];
        return json_encode($response);
    
        $data['getLend'] = $lendmodel->where('property_id', $property_id)->findAll();
        return view('Modules\Bank\Views\admin\bank\manage-debts', $data);
    }
    



    
    public function AddDebtsCollection($id) {
        $property_id = $this->session->get('rs_property_id');
        $validation = \Config\Services::validation();
    
        $rules = [
            'amount' => 'required',
            'BankAccount' => 'required', 
            'date' => 'required',             
        ];
        $validation->setRules($rules, [
            'amount' => [
                'required' => 'Please enter amount.',
            ],
            'BankAccount' => [
                'required' => 'Please enter Bank Account.',
            ],
            'date' => [
                'required' => 'Please enter date.',
            ],
        ]);

        if (!$this->validate($rules)) {
            $response = [
                'amount' => [
                    'status' => 'error',
                    'message' => $validation->getError('amount') ?: '',
                ],
                'BankAccount' => [
                    'status' => 'error',
                    'message' => $validation->getError('BankAccount') ?: '',
                ],
                'date' => [
                    'status' => 'error',
                    'message' => $validation->getError('date') ?: '',
                ],
            ];
            return json_encode($response);
        }
    
        // $DebtsCollectionmodel = new DebtsCollectionModel();
        $lendmodel = new LendModel();
        $bankAccountModel = new BankAccountModel(); 
        $data = array();
        
        $amount = $this->request->getVar('amount');
        $bankAccountId = $this->request->getVar('BankAccount');
        

        $bankAccount = $bankAccountModel->find($bankAccountId);
    
        if (!$bankAccount) {
            $response = [
                'error' => [
                    'status' => 'error',
                    'message' => 'Selected bank account not found.',
                ],
            ];
            return json_encode($response);
        }
    
  
        $newBalance = $bankAccount['initial_balance'] - $amount;
        $bankAccountModel->update($bankAccountId, ['initial_balance' => $newBalance]);
    
        $DebtsCollectionData = [
            'amount'    => $amount,
            'bank_account'    => $bankAccountId,
            'date'    => $this->request->getVar('date'),
            'type'    => $this->request->getVar('depts'),
            'property_id' => $property_id
        ];
    
        // $DebtsCollectionmodel->insert($DebtsCollectionData);
        // $res = $DebtsCollectionmodel->findAll();

        $lendmodel->insert($DebtsCollectionData);
        $res = $lendmodel->findAll();
    
        $response = [
            'success' => [
                'status' => 'ok',
                'message' => 'Data inserted successfully.',
            ],
        ];
        return json_encode($response);
    
        $data['getDebtsCollection'] = $lendmodel->where('property_id', $property_id)->findAll();
        return view('Modules\Bank\Views\admin\bank\manage-debts', $data);
    }
    
    
}
