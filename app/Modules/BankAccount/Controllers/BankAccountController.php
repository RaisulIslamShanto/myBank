<?php

namespace Modules\BankAccount\Controllers;

use App\Controllers\BaseController;
use Modules\Bank\Models\BankListModel;
use Modules\BankAccount\Models\BankAccountModel;
use Modules\ApplicationSetting\Models\SettingModel;

class BankAccountController extends BaseController{

    public $session,$db;

    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }


    public function index(){
       

        $bankaccount = new BankAccountModel();
        // $accountlist = $bankaccount->findAll();
        $accountlist = $bankaccount->where('deleted_at', null)->findAll();

        // echo '<pre>';
        // print_r($accountlist);
        // die();

        $banklistmodel = new BankListModel();
        $banklist = $banklistmodel->where('deleted_at', null)->findAll();



        $settingmodel = new SettingModel();
        $settingdata = $settingmodel->findAll();

        $db = \Config\Database::connect();
        $myData = [];

        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();
        
                $myData[]=$allvalue;
                
        }
        // echo '<pre>';
        // print_r($myData);
        // die();

        return view('Modules\BankAccount\Views\admin\bank\bank-account', [
            "username" => $this->session->get('name'),
            "accountlist" => $accountlist,
            "banklist" => $banklist,
            "data" => $myData,
            "settingdata" => $settingdata,
        ]);
    }


    public function AddBankAccount(){


        $validation = \Config\Services::validation();

        $rules = [
            'holderName' => 'required', 
            'BankName' => 'required',
            'accountNumber' => 'required',
            'InitialBalance' => 'required|numeric',
           
        ];

        $validation->setRules($rules, [
            'holderName' => [
                'required' => 'Please enter holder Name.',
            ],
            'BankName' => [
                'required' => 'Please enter Bank Name.',
            ],
            'accountNumber' => [
                'required' => 'Please enter account Number.',
            ],
            'InitialBalance' => [
                'required' => 'Please enter Initial Balance.',
                'numeric' => 'Please enter Only Number.',
            ],

        ]);

        if (!$this->validate($rules)) {
            $response = [
                'holderName' => [
                    'status' => 'error',
                    'message' => $validation->getError('holderName') ?: '',
                ],
                'BankName' => [
                    'status' => 'error',
                    'message' => $validation->getError('BankName') ?: '',
                ],
                'accountNumber' => [
                    'status' => 'error',
                    'message' => $validation->getError('accountNumber') ?: '',
                ],
                'InitialBalance' => [
                    'status' => 'error',
                    'message' => $validation->getError('InitialBalance') ?: '',
                ],
            ];
            return json_encode($response);
        }

        $bankaccount = new BankAccountModel();
        $data = array();
        $bankAccountData = [
                        'account_holders_name' => $this->request->getVar('holderName'),
                        'bank_name_id' => $this->request->getVar('BankName'),
                        'account_number' => $this->request->getVar('accountNumber'),
                        'initial_balance' => $this->request->getVar('InitialBalance'),
                    ];


                $bankaccount->insert($bankAccountData);
            
            $res = $bankaccount->findAll();

            $response = [
                'success' => [
                    'status' => 'ok',
                    'message' => 'Data inserted successfully.',
                ],
            ];
            return json_encode($response);

            $data['getBankAccount'] = $bankaccount->findAll();
            return view('Modules\BankAccount\Views\admin\bank\bank-account', $data);

    }



    public function AccountListEdit($id)
    {
        
        $bankaccount = new BankAccountModel();
        $data = $bankaccount->find($id);


      $data['getAcclist']= $bankaccount->findall();
      return $this->response->setJSON($data);


    }


    public function AccountListUpdate($id)
                {

                    $validation = \Config\Services::validation();

        $rules = [
            'holderName' => 'required', 
            'BankName' => 'required',
            'accountNumber' => 'required',
            'InitialBalance' => 'required|numeric',
           
        ];


        $validation->setRules($rules, [
            'holderName' => [
                'required' => 'Please enter holder Name.',
            ],
            'BankName' => [
                'required' => 'Please enter Bank Name.',
            ],
            'accountNumber' => [
                'required' => 'Please enter account Number.',
            ],
            'InitialBalance' => [
                'required' => 'Please enter Initial Balance.',
            ],

        ]);

        if (!$this->validate($rules)) {
            $response = [
                'holderName' => [
                    'status' => 'error',
                    'message' => $validation->getError('holderName') ?: '',
                ],
                'BankName' => [
                    'status' => 'error',
                    'message' => $validation->getError('BankName') ?: '',
                ],
                'accountNumber' => [
                    'status' => 'error',
                    'message' => $validation->getError('accountNumber') ?: '',
                ],
                'InitialBalance' => [
                    'status' => 'error',
                    'message' => $validation->getError('InitialBalance') ?: '',
                ],
            ];
            return json_encode($response);
        }
                    $bankaccount = new BankAccountModel();
                    $data = $bankaccount->find($id);

                    if ($this->request->getMethod() === 'post') {
                        $holderName = $this->request->getPost('holderName');
                        $BankName = $this->request->getPost('BankName');
                        $accountNumber = $this->request->getPost('accountNumber');
                        $InitialBalance = $this->request->getPost('InitialBalance');
                      
                        
                        $data = [
                            'account_holders_name' => $holderName,
                            'bank_name_id' => $BankName,
                            'account_number' => $accountNumber,
                            'initial_balance' => $InitialBalance,
                          
                        ];
                        $bankaccount->update($id, $data);

                        $response = [
                            'success' => true,
                            'message' => 'Data updated successfully.'
                        ];
                        return $this->response->setJSON($response);
                    }
                    $data['getBanklist']= $bankaccount->findall();
                    return view('Modules\BankAccount\Views\admin\bank\bank-list', $data);
                }




    public function AccountDelete($id)
    {
     
        $bankaccount = new BankAccountModel();
        $data = $bankaccount->find($id);
        

        if ($data) {
            $bankaccount->delete($id);

            $response = [
                'success' => true,
                'message' => 'Bank Account deleted successfully.'
            ];
        } 
     return $this->response->setJSON($response);

    }


   

    

}
