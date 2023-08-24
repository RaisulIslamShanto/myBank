<?php

namespace Modules\BalanceTransfer\Controllers;

use App\Controllers\BaseController;
use Modules\BalanceTransfer\Models\BalanceTransferModel;
use Modules\DebitsLoans\Models\DebtsLoansModel;
use Modules\BankAccount\Models\BankAccountModel;
use Modules\Bank\Models\BankListModel;
use Modules\DebitsLoans\Models\UpdateDebtsModel;
use Modules\DebitsLoans\Models\LendModel;
use Modules\DebitsLoans\Models\DebtsCollectionModel;

class BalanceTransferController extends BaseController{
    public $session,$db;

    public function __construct(){

        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function BalanceTransfer(){
        
       
        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->where('deleted_at', null)->findAll();


        $banklistmodel = new BankListModel();
        $banklist = $banklistmodel->where('deleted_at', null)->findAll();

        $balance = new BalanceTransferModel();
        $getBalance = $balance->findAll();


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

        foreach ($getBalance as $allvalue) {
            $allvalue['bank'] = $myData [$allvalue['from_account']];
            $allvalue['to_bank'] =$myData [$allvalue['to_account_id']];

                $balanceData[]=$allvalue;
                
        }

        return view('Modules\BalanceTransfer\Views\admin\bank\transfer-histories',[
            "getBalance" => $getBalance,
            "accountlist" => $accountlist,
            'data' => $myData,
            // "data2" => $data2,
            "balanceData" => $balanceData,

        ]);
    }



    public function BalanceTransferAdd()
    {
    
        $validation = \Config\Services::validation();
    
        $rules = [
            'FromAccount' => 'required',
            'ToAccount' => 'required',
            'amount' => 'required|numeric',
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
    
    
}
