<?php

namespace Modules\Manage_user\Controllers;

// use Modules\Demo\Models\Demomodel;
// use Modules\Demo\Models\Blogmodel;
use App\Controllers\BaseController; 
use Modules\Manage_user\Models\UserModel; 
use Modules\CategoryModule\Models\Categorymodel; 
 
class Manage_profileController extends BaseController{

    public $session,$db;

    public function __construct(){
        // parent::__construct();
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
    }

    // public function index($pro_id=''){
    //     if(!empty($pro_id) && is_numeric($pro_id)){
    //         $this->session->set('rs_property_id',$pro_id);

    //         if(valid_user($pro_id)==false){
    //             return redirect()->back();
    //         }
           

    //     }

    //     $property_id=$this->session->get('rs_property_id'); 

    //     // var_dump($property_id);
    //     // die();

    //     return view('Modules\Bank_Management\Views\admin\manage_profile');
    // }


    public function index(){
        
        $UserModel = new UserModel;
        $Usertable = $UserModel->findAll();

        // echo '<pre>';
        // print_r($Usertable);
        // die;


        // return view('Modules\Bank_Management\Views\admin\manage_profile',['cattable' => $Categorytable]);
        return view('Modules\Manage_user\Views\admin\user',['userdata' => $Usertable]);

    }

    public function insertuser(){ 

        
        $rules = [
                'name' => 'required|',
                'email' => 'required|',
                'password' => 'required|',
                'confirm_password' => 'required|'
            ];
            if($this->validate($rules)){
                
                $UserModel = new UserModel();
                date_default_timezone_set('Asia/Dhaka');
                $date = date('d-m-y h:i:s');

                $data = [

                    'name'        => $this->request->getPost('name'),
                    'email'        => $this->request->getPost('email'),
                    'password'        => $this->request->getPost('password'),
                    'confirm_password'        => $this->request->getPost('confirm_password'),
                    'date'              =>$date,
                    
                ];
            $UserModel->insert($data);
            return $this->response->setJSON(['status' => 'success', 'message' => 'File inserted successfully.']);  
            
        }else{
                // echo 12;
                // die();

                $data['validation'] = $this->validator;
                return view('Modules\Manage_user\Views\admin\user', $data);
            }        

        // $UserModel = new UserModel();
        // date_default_timezone_set('Asia/Dhaka');
        // $date = date('d-m-y h:i:s');

        // $data = [

        //     'name'        => $this->request->getPost('name'),
        //     'email'        => $this->request->getPost('email'),
        //     'password'        => $this->request->getPost('password'),
        //     'confirm_password'        => $this->request->getPost('confirm_password'),
        //     'date'              =>$date,
            
        // ];
        // $UserModel->insert($data);

        // $rules = [
        //     'name' => 'required|min_length[3]',
        //     'email' => 'required|valid_email',
        //     'password' => 'required',
        //     'confirm_password' => 'required'
        // ];

        // if($this->validate($rules)){
        //     $UserModel = new UserModel();

        //     $data = [

        //         'name'        => $this->request->getPost('name'),
        //         'email'        => $this->request->getPost('email'),
        //         'password'        => $this->request->getPost('password'),
        //         'confirm_password'        => $this->request->getPost('confirm_password'),
                
        //     ];
        //     $UserModel->insert($data);
        //     return redirect()->to('Modules\Bank_Management\Views\admin\manage_profile');
        // }else{
        //     $data['validation'] = $this->validator;
        //     echo view('Modules\Bank_Management\Views\admin\manage_profile', $data);
        // }        

    }

    public function saveuser(){

        $validation = \Config\Services::validation();

        $rules = [
            'name' => 'required|min_length[3]|is_unique[profile.name]', 
            'email' => 'required|valid_email|is_unique[profile.email]',
            'password' => 'required|max_length[10]|min_length[5]',
            'confirm_password' => 'required|matches[password]',
           
        ];

        // $validation->setRules($rules, [
        //     'name' => [
        //         'required' => 'Please enter holder Name.',
        //     ],
        //     'email' => [
        //         'required' => 'Please enter Bank Name.',
        //     ],
        //     'password' => [
        //         'required' => 'Please enter password.',
        //     ],
        //     'confirm_password' => [
        //         'required' => 'Please enter confirm_password.',
        //     ],

        // ]);

        if (!$this->validate($rules)) {
            $response = [
                'name' => [
                    'status' => 'error',
                    'message' => $validation->getError('name') ?: '',
                ],
                'email' => [
                    'status' => 'error',
                    'message' => $validation->getError('email') ?: '',
                ],
                'password' => [
                    'status' => 'error',
                    'message' => $validation->getError('password') ?: '',
                ],
                'confirm_password' => [
                    'status' => 'error',
                    'message' => $validation->getError('confirm_password') ?: '',
                ],
            ];
            return json_encode($response);
        }

        $UserModel = new UserModel();

            date_default_timezone_set('Asia/Dhaka');
            $date = date('Y-m-d h:i:s');

        $data = [

                    'name'        => $this->request->getPost('name'),
                    'email'        => $this->request->getPost('email'),
                    'password'        => SHA1($this->request->getPost('password')),
                    'confirm_password'        => SHA1($this->request->getPost('confirm_password')),
                    'date'              =>$date,
                    
                ];

        $UserModel->insert($data);  
         
        $response = [
            'success' => [
                'status' => 'ok',
                'message' => 'Data inserted successfully.',
            ],
        ];
        return json_encode($response);

        // $UserModel->insert($data);
        // return $this->response->setJSON(['status' => 'success', 'message' => 'File inserted successfully.']);  

        // previous
        // $rules = [
        //     'name' => 'required|min_length[3]',
        //     'email' => 'required|valid_email',
        //     'password' => 'required|max_length[10]',
        //     'confirm_password' => 'required|matches[password]'
        // ];

        // if($this->validate($rules)){
            
        //     // echo 11; die();

        //     $UserModel = new UserModel();

        //     date_default_timezone_set('Asia/Dhaka');
        //     $date = date('d-m-y h:i:s');

        //     $data = [

        //         'name'        => $this->request->getPost('name'),
        //         'email'        => $this->request->getPost('email'),
        //         'password'        => SHA1($this->request->getPost('password')),
        //         'confirm_password'        => $this->request->getPost('confirm_password'),
        //         'date'              =>$date,
                
        //     ];
           
        //     $UserModel->insert($data);
        //     return $this->response->setJSON(['status' => 'success', 'message' => 'File inserted successfully.']);  
            
        // }else{
        //         // echo 12;
        //         // die();
                

        //         $data['validation'] = $this->validator;
        //         echo view('\Modules\Manage_user\Views\admin\user', $data);
        //     }     

        // $UserModel = new UserModel();
        // $date = date('d-m-y h:i:s');
        
        // $data = [

        //     'name'        => $this->request->getPost('name'),
        //     'email'        => $this->request->getPost('email'),
        //     'password'        => $this->request->getPost('password'),
        //     'confirm_password'        => $this->request->getPost('confirm_password'),
        //     'date'              =>$date,
            
        // ];
        // $UserModel->insert($data);

        // return $this->response->setJSON(['status' => 'success', 'message' => 'File inserted successfully.']);

    }

    public function deleteuser($id)
    {

        $UserModel = new UserModel();
        $userdeleted = $UserModel->delete($id);
        
        // $UserModel = new UserModel();
        // $usertable = $UserModel->findAll();
        
        return redirect()->to('admin/manage_user')->with('status', 'success');

        // return view('Modules\Bank_Management\Views\admin\user',['userdata'=>$usertable]);
        
    }

    public function edituser()
    {
        
        $id = $this->request->getGET('id');

        $UserModel = new UserModel();

        $data = $UserModel->where('userId',$id)->findAll();

        // echo "<pre>";
        // print_r($data);
        // die();

        return json_encode($data);
        // return view('Modules\Bank_Management\Views\admin\manage_profile', ['userdata'=>$data,'menuValue'=>$menuValue,'homepageValue'=>$homepageValue]); 
       
    }

    public function updateuser($id)
    {
    
     $UserModel = new UserModel;
     $usertable = $UserModel->find($id);

     $validation = \Config\Services::validation();

     $rules = [
         'name' => 'required|min_length[3]|is_unique[profile.name]', 
         'email' => 'required|valid_email|is_unique[profile.email]',
         'password' => 'required|min_length[5]',
         'confirm_password' => 'required|matches[password]',
        
     ];
     if (!$this->validate($rules)) {
        $response = [
            'name' => [
                'status' => 'error',
                'message' => $validation->getError('name') ?: '',
            ],
            'email' => [
                'status' => 'error',
                'message' => $validation->getError('email') ?: '',
            ],
            'password' => [
                'status' => 'error',
                'message' => $validation->getError('password') ?: '',
            ],
            'confirm_password' => [
                'status' => 'error',
                'message' => $validation->getError('confirm_password') ?: '',
            ],
        ];
        return json_encode($response);
    }else{
        $UserModel = new UserModel();

        date_default_timezone_set('Asia/Dhaka');
        $date = date('Y-m-d h:i:s');

        $data = [

                'name'        => $this->request->getPost('name'),
                'email'        => $this->request->getPost('email'),
                'password'        => SHA1($this->request->getPost('password')),
                'confirm_password'        => SHA1($this->request->getPost('confirm_password')),
                'date'              =>$date,
                
            ];

        $UserModel->update($id,$data);
        // $UserModel->insert($data);  
     
        $response = [
            'success' => [
                'status' => 'ok',
                'message' => 'Data updaated successfully.',
            ],
        ];
        return json_encode($response);


    }

    //  $data = [

    //     'name'        => $this->request->getPost('name'),
    //     'email'        => $this->request->getPost('email'),
    //     'password'        => $this->request->getPost('password'),
    //     'confirm_password'        => $this->request->getPost('confirm_password'),
        
    //     ];

        // echo "<pre>"; print_r($data); die();
        
        // $UserModel->update($id,$data);

        // return $this->response->setJSON(['status' => 'success', 'message' => 'Form updated successfully.']);

        // $UserModel = new UserModel();
        // $cattable = $UserModel->findAll();
        
        // return view('variantcategory/variantcategory',['cattable'=>$cattable]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'File updated successfully.']);
       
    }
    
}
