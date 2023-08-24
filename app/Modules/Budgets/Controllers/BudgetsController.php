<?php

namespace Modules\Budgets\Controllers;

use App\Controllers\BaseController;
use Modules\Bank\Models\BankListModel;
use Modules\Budgets\Models\BudgetsModel;
use Modules\BankAccount\Models\BankAccountModel;
use Modules\CategoryModule\Models\Categorymodel;

class BudgetsController extends BaseController{

    public $session,$db;

    public function __construct(){
        // parent::__construct();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    public function Budgets(){

        $budgetsModel = new BudgetsModel();
        $budgetslist = $budgetsModel->findAll();
        // echo '<pre>';print_r($budgetslist);die;

        $bankaccount = new BankAccountModel();
        $accountlist = $bankaccount->findAll();

        $banklistmodel = new BankListModel();
        $banklist = $banklistmodel->findAll();

        $Categorymodel = new Categorymodel;
        $Categorytable = $Categorymodel->findAll();

        // echo '<pre>';
        // print_r($Categorytable);
        // die();

        $db = \Config\Database::connect();
        $myData = [];

        foreach ($accountlist as $allvalue) {
            $allvalue['bank'] = $db->table('bank_list')
                ->where('id', $allvalue['bank_name_id'])
                ->get()
                ->getRow();
        

                $myData[]=$allvalue;
                
        }


        return view('Modules\Budgets\Views\admin\bank\budgets_list', [
            "accountlist" => $accountlist,
            "banklist" => $banklist,
            "data" => $myData,
            "budgetslist" => $budgetslist,
            "Categorytable" => $Categorytable,
        ]);
    }




    public function BudgetsAdd(){

        $property_id = $this->session->get('rs_property_id');

        $validation = \Config\Services::validation();

        $rules = [
            'budgetName' => 'required', 
            'Amount' => 'required|numeric',
            'Category' => 'required',
            'Startdate' => 'required',
            'Enddate' => 'required',
           
        ];


        $validation->setRules($rules, [
            'budgetName' => [
                'required' => 'Please enter budget Name.',
            ],
            'Amount' => [
                'required' => 'Please enter Amount.',
            ],
            'Category' => [
                'required' => 'Please enter Category.',
            ],
            'Startdate' => [
                'required' => 'Please enter Start date.',
            ],
            'Enddate' => [
                'required' => 'Please enter End date.',
            ],


        ]);

        if (!$this->validate($rules)) {
            $response = [
                'budgetName' => [
                    'status' => 'error',
                    'message' => $validation->getError('budgetName') ?: '',
                ],
                'Amount' => [
                    'status' => 'error',
                    'message' => $validation->getError('Amount') ?: '',
                ],
                'Category' => [
                    'status' => 'error',
                    'message' => $validation->getError('Category') ?: '',
                ],
                'Startdate' => [
                    'status' => 'error',
                    'message' => $validation->getError('Startdate') ?: '',
                ],
                'Enddate' => [
                    'status' => 'error',
                    'message' => $validation->getError('Enddate') ?: '',
                ],
            ];
            return json_encode($response);
        }

        $budgetsModel = new BudgetsModel();
        $data = array();
        $budgetsData = [
                        'budget_name' => $this->request->getVar('budgetName'),
                        'budget_amount' => $this->request->getVar('Amount'),
                        'expense_categories' => $this->request->getVar('Category'),
                        'start_date' => $this->request->getVar('Startdate'),
                        'end_date' => $this->request->getVar('Enddate'),
                    ];


                $budgetsModel->insert($budgetsData);
            
            $res = $budgetsModel->findAll();

            $response = [
                'success' => [
                    'status' => 'ok',
                    'message' => 'Data inserted successfully.',
                ],
            ];
            return json_encode($response);

            $data['getbudgets'] = $budgetsModel->findAll();
            return view('Modules\Budgets\Views\admin\bank\budgets-list', $data);

    }



    public function BudgetsListEdit($id)
    {
        
        $budgetsModel = new BudgetsModel();
        $data = $budgetsModel->find($id);

      $data['geteditbud']= $budgetsModel->findall();
      return $this->response->setJSON($data);


    }


    public function BudgetsListUpdate($id)
                {

                    $validation = \Config\Services::validation();

                    $rules = [
                        'budgetName' => 'required', 
                        'Amount' => 'required|numeric',
                        'Category' => 'required',
                        'Startdate' => 'required',
                        'Enddate' => 'required',
                       
                    ];
            
            
                    $validation->setRules($rules, [
                        'budgetName' => [
                            'required' => 'Please enter budget Name.',
                        ],
                        'Amount' => [
                            'required' => 'Please enter Amount.',
                        ],
                        'Category' => [
                            'required' => 'Please enter Category.',
                        ],
                        'Startdate' => [
                            'required' => 'Please enter Start date.',
                        ],
                        'Enddate' => [
                            'required' => 'Please enter End date.',
                        ],
            
            
                    ]);
            
                    if (!$this->validate($rules)) {
                        $response = [
                            'budgetName' => [
                                'status' => 'error',
                                'message' => $validation->getError('budgetName') ?: '',
                            ],
                            'Amount' => [
                                'status' => 'error',
                                'message' => $validation->getError('Amount') ?: '',
                            ],
                            'Category' => [
                                'status' => 'error',
                                'message' => $validation->getError('Category') ?: '',
                            ],
                            'Startdate' => [
                                'status' => 'error',
                                'message' => $validation->getError('Startdate') ?: '',
                            ],
                            'Enddate' => [
                                'status' => 'error',
                                'message' => $validation->getError('Enddate') ?: '',
                            ],
                        ];
                        return json_encode($response);
                    }
                    $budgetsModel = new BudgetsModel();
                    $data = $budgetsModel->find($id);
 
                  
                    if ($this->request->getMethod() === 'post') {
                        $budgetName = $this->request->getPost('budgetName');
                        $Amount = $this->request->getPost('Amount');
                        $Category = $this->request->getPost('Category');
                        $Startdate = $this->request->getPost('Startdate');
                        $Enddate = $this->request->getPost('Enddate');
        
                        $data = [
                            'budget_name' => $budgetName,
                            'update_amount' => $Amount,
                            'expense_categories' => $Category,
                            'start_date' => $Startdate,
                            'end_date' => $Enddate,

                          
                        ];
                        $budgetsModel->update($id, $data);

                        $response = [
                            'success' => true,
                            'message' => 'Data updated successfully.'
                        ];
                        return $this->response->setJSON($response);
                    }
                    $data['getbudgetlist']= $budgetsModel->findall();
                    return view('Modules\Budgets\Views\admin\bank\budgets-list', $data);
                }




    public function BudgetsDelete($id)
    {

        $budgetsModel = new BudgetsModel();
        $data = $budgetsModel->find($id);
        

        if ($data) {
            $budgetsModel->delete($id);

            $response = [
                'success' => true,
                'message' => 'Bank Account deleted successfully.'
            ];
        } 
     return $this->response->setJSON($response);

     $data['getbudgets']= $budgetsModel->findall();
     return view('Modules\Budgets\Views\admin\bank\budgets_list',$data);
    }

}
