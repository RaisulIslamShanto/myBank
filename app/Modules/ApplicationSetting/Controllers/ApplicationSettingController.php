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
    

    public function language(){

        $data['first'] = lang('myCustomLang.first',[],'bangla');
        $data['second'] = lang('myCustomLang.second',[],'bangla');
        $data['third'] = lang('myCustomLang.third',[],'bangla');

        return view('Modules\ApplicationSetting\Views\admin\bank\languagepage',$data);

    }

    public function sidebarbangla(){

        $data['dashboard'] = lang('myCustomLang.dashboard',[],'bangla');
        $data['Manage_Users'] = lang('myCustomLang.Manage_Users',[],'bangla');
        $data['Categories'] = lang('myCustomLang.Categories',[],'bangla');
        $data['Banks'] = lang('myCustomLang.Banks',[],'bangla');
        
        $data['Bank_Accounts'] = lang('myCustomLang.Bank_Accounts',[],'bangla');
        $data['Balance_Transfer'] = lang('myCustomLang.Balance_Transfer',[],'bangla');
        $data['Debts_Loans'] = lang('myCustomLang.Debts_Loans',[],'bangla');
        $data['Incomes'] = lang('myCustomLang.Incomes',[],'bangla');
        $data['Expenses'] = lang('myCustomLang.Expenses',[],'bangla');
        $data['Budgets'] = lang('myCustomLang.Budgets',[],'bangla');
        $data['Income_Report'] = lang('myCustomLang.Income_Report',[],'bangla');
        $data['Expense_Report'] = lang('myCustomLang.Expense_Report',[],'bangla');
        $data['Calendar'] = lang('myCustomLang.Calendar',[],'bangla');
        $data['Set_Goals'] = lang('myCustomLang.Set_Goals',[],'bangla');
        $data['My_Assets'] = lang('myCustomLang.My_Assets',[],'bangla');
        $data['Application_settings'] = lang('myCustomLang.Application_settings',[],'bangla');
       

        return view('Modules\ApplicationSetting\Views\admin\bank\sidebarbangla',$data);

    }

    public function ApplicationSetting($pro_id=''){
        if(!empty($pro_id) && is_numeric($pro_id)){
            $this->session->set('rs_property_id',$pro_id);

            if(valid_user($pro_id)==false){
                return redirect()->back();
            }
        }

        $property_id=$this->session->get('rs_property_id');

        $settingmodel = new SettingModel();
        $settingdata = $settingmodel->where('id',1)->findAll();

        // echo "<pre>";
        // print_r($settingdata);
        // die();

        return view('Modules\ApplicationSetting\Views\admin\bank\application-setting', [

            "settingdata" => $settingdata,
        ]);
    }



    public function SettingUpdate($id)
    {

        // echo 12;
        // print_r($id);
        // die();

        $property_id = $this->session->get('rs_property_id');

        $validation = \Config\Services::validation();

        $rules = [
            'companyName' => 'required', 
            'site' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'timezone' => 'required',
            'language' => 'required',
            'direction' => 'required',
            'address' => 'required',
            'page' => 'required',
            'type' => 'required',
            'currency' => 'required',
            'seperator' => 'required',
            'logo' => 'required',
            'logoLight' => 'required',
            'favicon' => 'required',
            
           
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
                'site' => [
                    'status' => 'error',
                    'message' => $validation->getError('phone') ?: '',
                ],
                'phone' => [
                    'status' => 'error',
                    'message' => $validation->getError('email') ?: '',
                ],
                'email' => [
                    'status' => 'error',
                    'message' => $validation->getError('address') ?: '',
                ],
                'timezone' => [
                    'status' => 'error',
                    'message' => $validation->getError('currency') ?: '',
                ],
                'language' => [
                    'status' => 'error',
                    'message' => $validation->getError('page') ?: '',
                ],
                'direction' => [
                    'status' => 'error',
                    'message' => $validation->getError('type') ?: '',
                ],
                'address' => [
                    'status' => 'error',
                    'message' => $validation->getError('type') ?: '',
                ],
                'page' => [
                    'status' => 'error',
                    'message' => $validation->getError('type') ?: '',
                ],
                'type' => [
                    'status' => 'error',
                    'message' => $validation->getError('type') ?: '',
                ],
                'code' => [
                    'status' => 'error',
                    'message' => $validation->getError('type') ?: '',
                ],
                'seperator' => [
                    'status' => 'error',
                    'message' => $validation->getError('type') ?: '',
                ],
                'logo' => [
                    'status' => 'error',
                    'message' => $validation->getError('type') ?: '',
                ],
                'logoLight' => [
                    'status' => 'error',
                    'message' => $validation->getError('type') ?: '',
                ],
                'favicon' => [
                    'status' => 'error',
                    'message' => $validation->getError('type') ?: '',
                ],
                
            ];
            return json_encode($response);
        }else{   


                  
                    if ($this->request->getMethod() === 'post') {

                        $companyName = $this->request->getPost('companyName');
                        $site = $this->request->getPost('site');
                        $phone = $this->request->getPost('phone');
                        $email = $this->request->getPost('email');
                        $timezone = $this->request->getPost('timezone');
                        $language = $this->request->getPost('language');
                        $direction = $this->request->getPost('direction');
                        $address = $this->request->getPost('address');
                        $page = $this->request->getPost('page');
                        $type = $this->request->getPost('type');
                        $currency = $this->request->getPost('currency');
                        $code = $this->request->getPost('code');
                        $seperator = $this->request->getPost('seperator');
                        $logo = $this->request->getFile('logo');
                        $logoLight = $this->request->getFile('logoLight');
                        $favicon = $this->request->getFile('favicon');

                        $settingmodel = new SettingModel();
                        $data = $settingmodel->find($id);
                        
                        if ($logo->isValid() && !$logo->hasMoved())
                            {
                                $old_photo = $data['logo'];    
                                if(file_exists("Settingphotos/logosPhotos/".$old_photo)){
                                    unlink("Settingphotos/logosPhotos/".$old_photo);
                                }

                                $logoName = $logo->getRandomName();
                                $logo->move('Settingphotos/logosPhotos/', $logoName);
                            }
                        if ($logoLight->isValid() && !$logoLight->hasMoved())
                            {
                                $old_photo = $data['logoLight'];    
                                if(file_exists("Settingphotos/logosPhotos/".$old_photo)){
                                    unlink("Settingphotos/logosPhotos/".$old_photo);
                                }

                                $logoLightName = $logoLight->getRandomName();
                                $logoLight->move('Settingphotos/logosPhotos/', $logoLightName);
                            }

                        if ($favicon->isValid() && !$favicon->hasMoved())
                            {
                                $old_photo = $data['favicon'];    
                                if(file_exists("Settingphotos/logosPhotos/".$old_photo)){
                                    unlink("Settingphotos/logosPhotos/".$old_photo);
                                }
                                $faviconName = $favicon->getRandomName();
                                $favicon->move('Settingphotos/logosPhotos/', $faviconName);
                            }



                        
                        $data = [

                            'company_name' => $companyName,
                            'site' => $site,
                            'company_phone' => $phone,
                            'email' => $email,
                            'timezone' => $timezone,
                            'language' => $language,
                            'direction' => $direction,
                            'company_address' => $address,
                            'Number_of_data_per_page' => $page,
                            'registration_type' => $type,
                            'default_currency' => $currency,
                            'code' => $code,
                            'seperator' => $seperator,
                            'logo' => $logoName,
                            'logoLight' => $logoLightName,
                            'favicon' => $faviconName,
                            'property_id'       => $property_id
                          
                        ];

                        $settingmodel->update($id, $data);

                        $response = [
                            'success' => true,
                            'message' => 'Data updated successfully.'
                        ];
                        return $this->response->setJSON($response);
                    }
                }


            // $data['getsetting']= $settingmodel->where('property_id',$property_id)->findall();
            // return view('Modules\ApplicationSetting\Views\admin\bank\application-setting', $data);
        }





}
