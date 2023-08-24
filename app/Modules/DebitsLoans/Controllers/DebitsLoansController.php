<?php

namespace Modules\DebitsLoans\Controllers;

use App\Controllers\BaseController;
use Modules\BalanceTransfer\Models\BalanceTransferModel;
use Modules\DebitsLoans\Models\DebtsLoansModel;
use Modules\BankAccount\Models\BankAccountModel;
use Modules\Bank\Models\BankListModel;
use Modules\DebitsLoans\Models\UpdateDebtsModel;
use Modules\DebitsLoans\Models\LendModel;
use Modules\DebitsLoans\Models\DebtsCollectionModel;

class DebitsLoansController extends BaseController{
    public $session,$db;

    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }


    public function DebtsLoans(){
        
        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->where('deleted_at', null)->findAll();

        $debts = new DebtsLoansModel();
        $getDebts = $debts->findAll();

      // echo '<pre>';
        // print_r($debtsData);
        // die;

        $db = \Config\Database::connect();
        $myData = [];

        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();
        


                $myData[]=$allvalue;
                
        }

        $debtsData = [];

        foreach ($getDebts as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_account'])
                ->get()
                ->getRow();

                $debtsData[]=$allvalue;
                
        }

        // echo '<pre>';
        // print_r($debtsData);
        // die;


        return view('Modules\DebitsLoans\Views\admin\bank\debts-loans', [
            "getDebts" => $getDebts,
            "accountlist" => $accountlist,
            "data" => $myData,
            "debtsData" => $debtsData,
        ]);
    }




    public function AddDebtsLoans()
    {
    
        $validation = \Config\Services::validation();
    
        $rules = [
            'amount' => 'required|numeric', 
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


     return view('Modules\DebitsLoans\Views\admin\bank\debts-loans',$data);
    }





    public function DebtsEdit($id)
    {

        $lendmodel = new LendModel();
        $lend = $lendmodel->findAll();

        $debts = new DebtsLoansModel();
        $data2 = $debts->find($id);
    
        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->findAll();

        $getDebts = $debts->findAll();

        $UpdateDebts = new UpdateDebtsModel();
        $UpdateDebtslist = $UpdateDebts->findAll();

        
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
     

                $balanceData[]=$allvalue;
                
        }

   

        $data['getdebts']= $debts->findall();
        return view('Modules\DebitsLoans\Views\admin\bank\manage-debts',[
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

   
    }



    public function AddLend($id)
     {

        $validation = \Config\Services::validation();
    
        $rules = [
            'amount' => 'required|numeric',
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
    
        $data['getLend'] = $lendmodel->findAll();
        return view('Modules\DebitsLoans\Views\admin\bank\manage-debts', $data);
    }
    



    
    public function AddDebtsCollection($id) {
        $validation = \Config\Services::validation();
    
        $rules = [
            'amount' => 'required|numeric',
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

        ];
    


        $lendmodel->insert($DebtsCollectionData);
        $res = $lendmodel->findAll();
    
        $response = [
            'success' => [
                'status' => 'ok',
                'message' => 'Data inserted successfully.',
            ],
        ];
        return json_encode($response);
    
        $data['getDebtsCollection'] = $lendmodel->findAll();
        return view('Modules\DebitsLoans\Views\admin\bank\manage-debts', $data);
    }
    
    
}
