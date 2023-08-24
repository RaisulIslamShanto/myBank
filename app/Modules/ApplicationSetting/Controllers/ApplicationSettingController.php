<?php

namespace Modules\ApplicationSetting\Controllers;

use App\Controllers\BaseController;
use Modules\ApplicationSetting\Models\SettingModel;
use Modules\BankAccount\Models\BankAccountModel;
use Modules\Expenses\Models\ExpensesModel;

class ApplicationSettingController extends BaseController{

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
    

    public function ApplicationSetting($pro_id=''){
        if(!empty($pro_id) && is_numeric($pro_id)){
            $this->session->set('rs_property_id',$pro_id);

            if(valid_user($pro_id)==false){
                return redirect()->back();
            }
        }

        $property_id=$this->session->get('rs_property_id');
        $settingmodel = new SettingModel();
        $settingdata = $settingmodel->where('property_id',$property_id)->findAll();

        return view('Modules\ApplicationSetting\Views\admin\bank\application-setting', [

            "settingdata" => $settingdata,
        ]);
    }



    public function SettingUpdate($id)
                {
                    $property_id = $this->session->get('rs_property_id');
                    $validation = \Config\Services::validation();

        $rules = [
            'companyName' => 'required', 
            'phone' => 'required',
            'website' => 'required',
            'address' => 'required',
            'currency' => 'required',
            'page' => 'required',
            'type' => 'required',
           
        ];


        $validation->setRules($rules, [
            'companyName' => [
                'required' => 'Please enter company Name.',
            ],
            'phone' => [
                'required' => 'Please enter phone.',
            ],
            'website' => [
                'required' => 'Please enter account Number.',
            ],
            'address' => [
                'required' => 'Please enter address.',
            ],
            'currency' => [
                'required' => 'Please enter currency.',
            ],
            'page' => [
                'required' => 'Please enter Number of data per page.',
            ],
            'type' => [
                'required' => 'Please enter Registration Type.',
            ],

        ]);

        if (!$this->validate($rules)) {
            $response = [
                'companyName' => [
                    'status' => 'error',
                    'message' => $validation->getError('companyName') ?: '',
                ],
                'phone' => [
                    'status' => 'error',
                    'message' => $validation->getError('phone') ?: '',
                ],
                'website' => [
                    'status' => 'error',
                    'message' => $validation->getError('accountNumber') ?: '',
                ],
                'address' => [
                    'status' => 'error',
                    'message' => $validation->getError('address') ?: '',
                ],
                'currency' => [
                    'status' => 'error',
                    'message' => $validation->getError('currency') ?: '',
                ],
                'page' => [
                    'status' => 'error',
                    'message' => $validation->getError('page') ?: '',
                ],
                'type' => [
                    'status' => 'error',
                    'message' => $validation->getError('type') ?: '',
                ],
            ];
            return json_encode($response);
        }


                    $settingmodel = new SettingModel();
                    $data = $settingmodel->find($id);
                    // echo'<pre>';
                    // print_r($user);
                    // die();
                  
                    if ($this->request->getMethod() === 'post') {
                        $companyName = $this->request->getPost('companyName');
                        $phone = $this->request->getPost('phone');
                        $website = $this->request->getPost('website');
                        $address = $this->request->getPost('address');
                        $currency = $this->request->getPost('currency');
                        $page = $this->request->getPost('page');
                        $type = $this->request->getPost('type');
                      
                        
                        $data = [
                            'company_name' => $companyName,
                            'company_phone' => $phone,
                            'web_site' => $website,
                            'company_address' => $address,
                            'default_currency' => $currency,
                            'Number_of_data_per_page' => $page,
                            'registration_type' => $type,
                            'property_id'         => $property_id
                          
                        ];
                        $settingmodel->update($id, $data);

                        $response = [
                            'success' => true,
                            'message' => 'Data updated successfully.'
                        ];
                        return $this->response->setJSON($response);
                    }
                    $data['getsetting']= $settingmodel->where('property_id',$property_id)->findall();
                    return view('Modules\ApplicationSetting\Views\admin\bank\application-setting', $data);
                }





}
