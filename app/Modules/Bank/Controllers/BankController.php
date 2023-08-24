<?php

namespace Modules\Bank\Controllers;

use App\Controllers\BaseController;
use Modules\Bank\Models\BankListModel;
use Modules\Bank\Models\BankAccountModel;


class BankController extends BaseController{

    public $session,$db;

    public function __construct(){
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    /**
     * This method index shows Floor list of a property.
     * Method - get
     */
    public function Bank(){
        // if(!empty($pro_id) && is_numeric($pro_id)){
        //     $this->session->set('rs_property_id',$pro_id);

        //     if(valid_user($pro_id)==false){
        //         return redirect()->back();
        //     }
        // }

        // $property_id=$this->session->get('rs_property_id');

        $banklistmodel = new BankListModel();
        $banklist = $banklistmodel->findAll();

        // $data['getBank'] = $banklistmodel->where('property_id', $property_id)->findAll();
        return view('Modules\Bank\Views\admin\bank\bank-list', [

            "banklist" => $banklist,
        ]);
    }



    public function AddBank(){

        $validation = \Config\Services::validation();

        $rules = [
            'BankName' => 'required',            
        ];
        $validation->setRules($rules, [
            'BankName' => [
                'required' => 'Please enter Bank Name.',
            ],
        ]);

        if (!$this->validate($rules)) {
            $response = [
                'BankName' => [
                    'status' => 'error',
                    'message' => $validation->getError('BankName') ?: '',
                ],
            ];
            return json_encode($response);
        }

        $banklistmodel = new BankListModel();
        $data = array();
        $BankData = [
                        'bank_name'    => $this->request->getVar('BankName'),

                    ];

                $banklistmodel->insert($BankData);
                $res = $banklistmodel->findAll();

            $response = [
                'success' => [
                    'status' => 'ok',
                    'message' => 'Data inserted successfully.',
                ],
            ];
            return json_encode($response);

            $data['getBank'] = $banklistmodel->findAll();
            return view('Modules\Bank\Views\admin\bank\bank-list', $data);


    }



    public function BankListEdit($id)
    {

        $banklistmodel = new BankListModel();
        $data = $banklistmodel->find($id);


      $data['getBanklist']= $banklistmodel->findall();
      return $this->response->setJSON($data);

    }




    public function BankListUpdate($id)
                {

                    $validation = \Config\Services::validation();
            
                    $rules = [
                        'BankName' => 'required',            
                    ];
                    $validation->setRules($rules, [
                        'BankName' => [
                            'required' => 'Please enter Bank Name.',
                        ],
                    ]);
            
                    if (!$this->validate($rules)) {
                        $response = [
                            'BankName' => [
                                'status' => 'error',
                                'message' => $validation->getError('BankName') ?: '',
                            ],
                        ];
                        return json_encode($response);
                    }
                    $banklistmodel = new BankListModel();
                    $data = $banklistmodel->find($id);

                    if ($this->request->getMethod() === 'post') {
                        $name = $this->request->getPost('BankName');
                      
                        
                        $data = [
                            'bank_name' => $name,
                        ];
                        $banklistmodel->update($id, $data);

                        $response = [
                            'success' => true,
                            'message' => 'Data updated successfully.'
                        ];
                        return $this->response->setJSON($response);
                    }
                    $data['getBanklist']= $banklistmodel->findall();
                    return view('Modules\Bank\Views\admin\bank\bank-list', $data);
                }



    public function BankDelete($id)
    {
        $banklistmodel = new BankListModel();
        $data = $banklistmodel->find($id);
        

        if ($data) {
            $banklistmodel->delete($id);

            $response = [
                'success' => true,
                'message' => 'Bank deleted successfully.'
            ];
        } 
     return $this->response->setJSON($response);

     $data['getBanklist']= $banklistmodel->findall();
     return view('Modules\Bank\Views\admin\bank\bank-list',$data);
    }


}
