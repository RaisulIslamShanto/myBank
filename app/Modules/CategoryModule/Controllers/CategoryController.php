<?php

namespace Modules\CategoryModule\Controllers;

// use Modules\Demo\Models\Demomodel;
// use Modules\Demo\Models\Blogmodel; 
use App\Controllers\BaseController;

use Modules\CategoryModule\Models\Categorymodel;

class CategoryController extends BaseController{

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
    public function categorypage(){

        $Categorymodel = new Categorymodel;

        
        // $Categorytable = $Categorymodel->findAll();

        $Categorytable = $Categorymodel->where('deleted_at', null)->findAll();
        
        return view('Modules\CategoryModule\Views\admin\categorypage',['cattable' => $Categorytable]);

    }

    public function savecategory(){

        $validation = \Config\Services::validation();
        
        $rules = [
            'categoryName' => 'required|min_length[3]|is_unique[categorytable.categoryName]', 
            'categoryType' => 'required|min_length[3]', 
        ];

        $validation->setRules($rules, [
            'categoryName' => [
                'required' => 'Please enter Category Name.',
            ],
            'categoryType' => [
                'required' => 'Please enter Category Type.',
            ],

        ]);

        if (!$this->validate($rules)) {
            $response = [
                'categoryName' => [
                    'status' => 'error',
                    'message' => $validation->getError('categoryName') ?: '',
                ],
                'categoryType' => [
                    'status' => 'error',
                    'message' => $validation->getError('categoryType') ?: '',
                ],
                
            ];
            return json_encode($response);
        }else{

            $data = [
   
                'categoryName'=>$this->request->getPost('categoryName'),
                'categoryType'=>$this->request->getPost('categoryType')
    
               ];
               
                //    echo'<pre>';
                //    print_r($data);
                //    die();
    
                $Categorymodel = new Categorymodel;
                $Categorymodel->insert($data);
                
                $response = [
                    'success' => [
                        'status' => 'ok',
                        'message' => 'Data inserted successfully.',
                    ],
                ];
                return json_encode($response);

        }


        
           
        // return $this->response->setJSON(['status' => 'success', 'message' => 'File inserted successfully.']);
    //     return view('Modules\CategoryModule\Views\admin\categorypage');

    }
    public function deletecat($id)
    {

        $Categorymodel = new Categorymodel;
        $catdeleted = $Categorymodel->find($id);

        // $catdeleted = $Categorymodel->where('deleted_at', null)->findAll();

        if ($catdeleted) {

            $Categorymodel->softDelete($id);

    
            $response = [
                'success' => true,
                'message' => 'Category deleted successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Category not found.'
            ];
        }
    
        return $this->response->setJSON($response);
        
        
        // return $this->response->setJSON(['status' => 'success', 'message' => 'Form deleted successfully.']);

        // return redirect()->to('admin/categorypage')->with('status', 'success');
        // return view('Modules\CategoryModule\Views\admin\categorypage',['cattable'=>$cattable]);
        
    }
    public function editcat()
    {
        
        $id  = $this->request->getPost('id');

        $Categorymodel = new Categorymodel();
        $data = $Categorymodel->where('categoryId',$id)->findAll();

        // print_r($data);
        // die();
    
        return json_encode($data);

        // return view('variantcategory/editCategory', ['catdata'=>$data,'menuValue'=>$menuValue,'homepageValue'=>$homepageValue]); 
       
    }
    
    public function updatecat($id)
    {
       
        $validation = \Config\Services::validation();
        
        $rules = [
            'categoryName' => 'required|min_length[3]|is_unique[categorytable.categoryName]', 
            'categoryType' => 'required|min_length[3]', 
        ];

        $validation->setRules($rules, [
            'categoryName' => [
                'required' => 'Please enter Category Name.',
            ],
            'categoryType' => [
                'required' => 'Please enter Category Type.',
            ],

        ]);

        if (!$this->validate($rules)) {
            $response = [
                'categoryName' => [
                    'status' => 'error',
                    'message' => $validation->getError('categoryName') ?: '',
                ],
                'categoryType' => [
                    'status' => 'error',
                    'message' => $validation->getError('categoryType') ?: '',
                ],
                
            ];
            return json_encode($response);
        }else{

            $Categorymodel = new Categorymodel;
            $catrow = $Categorymodel->find($id);
       
            $data = [
          
               'categoryName'=>$this->request->getPost('categoryName'),
               'categoryType'=>$this->request->getPost('categoryType')
       
              ]; 
       
              // print_r($data);
               // die();
               $Categorymodel->update($id,$data);

               $response = [
                'success' => [
                    'status' => 'ok',
                    'message' => 'Data updated successfully.',
                ],
            ];
            return json_encode($response);
       
            //    return $this->response->setJSON(['status' => 'success', 'message' => 'Form updated successfully.']);

        }


    
    
       
    }

    
}
