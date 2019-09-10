<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/UploadHandler.php';

class Admin extends CI_Controller {
    //functions

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->model('admin/movie_model');
        $this->load->library('form_validation');
    }

//--------------------------------------------------------------------------------------------------------
    function index()
    {
        $data['title'] = 'Admin Login';
        $this->load->view("back/login");
    }
//--------------------------------------------------------------------------------------------------------
    function login_validation()
    {
        $this-> form_validation->set_rules('login-email', 'Username', 'required');
        $this->form_validation->set_rules('login-password', 'Password', 'required');
        if($this->form_validation->run())
        {

            $UserEmail = $this->input->post('login-email');
            $UserPassword = $this->input->post('login-password');

            $AdminCheck = $this->admin_model->login($UserEmail, $UserPassword);
            if(count($AdminCheck)> 0)
            {
                if($AdminCheck->Status != 1)
                {
                    $this->session->set_flashdata('Message',$this->lang->line('notActive'));
                    redirect(site_url() . 'admin');

                    return;
                }
                $session_data = array(
                    'Email'     =>     $AdminCheck->Email,
                    'Id'     =>     $AdminCheck->Id,
                    'IP'     =>     $AdminCheck->IP,
                    'LoginDate'=>     $AdminCheck->LoginDate,
                    'FailedDate'=>     $AdminCheck->FailedDate,
                    'Name'=>     $AdminCheck->Name,
                    'Surname'=>     $AdminCheck->Surname,
                    'OS'=>     $AdminCheck->OS,
                    'Browser'=>     $AdminCheck->Browser

                );
                $this->session->set_userdata($session_data);

                redirect(site_url() . 'Admin/dashboard');

                //$this->load->view("admin/logout");
            }
            else
            {
                $this->session->set_flashdata('error', $this->lang->line('invalidInfo'));
                redirect(site_url() . 'admin');
            }
        }
        else
        {
            $this->login();
        }
    }
//--------------------------------------------------------------------------------------------------------
    function dashboard()
    {
        $data = array();
        $data['MetaTitle']='Dashboard';
        $data['MetaDescription']='back/dashboard';
        $data['View']='back/dashboard';
        $this->load->view('back/template', $data);
    }

//---------------------------------------GET ADMINS-----------------------------------------------------------
    function getAdmins()
    {
        $data = array();
        $data['admin'] = $this->admin_model->getAdmins();
        $data['MetaTitle']='Admins';
        $data['MetaDescription']='back/getAdmins';
        $data['View']='back/admins';
        $this->load->view('back/template', $data);
    }

    //-------------------------------------PRODUCTS------------------------------------------------------------
    function movies($page = 1)
    {
        $data = array();
        $data['CurrentPage'] = $page;
        $page = $page - 1;
        $start = ($page * PAGE_LIMIT);
        $productArray = $this->movie_model->Products(array(),$start);
        $data['Products'] = $productArray['Data'];
        $data['TotalPage'] = ceil($productArray['TotalRecord'] / PAGE_LIMIT);
        $data['MetaTitle']='Products';
        $data['MetaDescription']='admin/Products';
        $data['View']='back/movies';
        $this->load->view('back/template', $data);
    }
    //-------------------------------------Contacts------------------------------------------------------------
    function Contacts()
    {
        $data = array();
        $data['contacts'] = $this->admin_model->Contacts();
        $data['MetaTitle']='Contacts';
        $data['MetaDescription']='admin/Contacts';
        $data['View']='back/contacts';
        $this->load->view('back/template', $data);
    }

    //-------------------------------------Contacts------------------------------------------------------------
    function ImagesUpload($page = 1)
    {
        $data = array();
        $data['CurrentPage'] = $page;
        $page = $page - 1;
        $start = ($page * PAGE_LIMIT);
        $productArray = $this->movie_model->Products(array(),$start);
        $data['Products'] = $productArray['Data'];
        $data['TotalPage'] = ceil($productArray['TotalRecord'] / PAGE_LIMIT);
        $productArray = $this->movie_model->Products(array());
        $data['Products'] = $productArray['Data'];
        $data['MetaTitle']='UploadImageButton';
        $data['MetaDescription']='admin/imageUploadButton';
        $data['View']='back/images';
        $this->load->view('back/template', $data);
    }

//--------------------------------------------AddAdmin---------------------------------------------------------
    function AddAdmin()
    {
        $data = array();
        $data['MetaTitle']='AddNewAdmin';
        $data['MetaDescription']='admin/AddNewAdmin';
        $data['View']='back/AddAdmin';

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Name', 'Name', 'required|min_length[2]');
            $this->form_validation->set_rules('Email', 'Email', 'required|min_length[4]|is_unique[yonetim.Email]|valid_email');
            $this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('Status', 'Status', 'required|min_length[1]');
            $this->form_validation->set_rules('Surname', 'Surname', 'required|min_length[2]');
            $this->form_validation->set_rules('AddedDate', 'AddedDate', 'required|min_length[10]');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('back/template', $data);
                return;
            }

            $formData=array(
                'Name'=>$this->input->post('Name'),
                'Email'=>$this->input->post('Email'),
                'Password'=>$this->input->post('Password'),
                'Status'=>$this->input->post('Status'),
                'Surname'=>$this->input->post('Surname'),
                'AddedDate'=>$this->input->post('AddedDate')
            );
            $resultArray = $this->admin_model->addAdmin($formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message',$this->lang->line('adminAddSuccess'));
                redirect(site_url() . 'admin/GetAdmins');
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$this->lang->line('somethingWentWrong'));
        }

        $this->load->view('back/template', $data);
    }

//--------------------------------------------------------------------------------------------------------
    function AddCategories()
    {
        $data = array();
        $data['MetaTitle']='AddCategories';
        $data['MetaDescription']='admin/AddCategories';
        $data['View']='back/AddCategories';

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Title', 'Title', 'required|min_length[2]');
            $this->form_validation->set_rules('Description', 'Description', 'required|min_length[4]');
            $this->form_validation->set_rules('Status', 'Status', 'required|min_length[1]');
            $this->form_validation->set_rules('AddedDate', 'AddedDate', 'required|min_length[8]');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('back/template', $data);
                return;
            }
            $formData=array(
                'Title'=>$this->input->post('Title'),
                'Description'=>$this->input->post('Description'),
                'Status'=>$this->input->post('Status'),
                'AddedDate'=>$this->input->post('AddedDate'),
            );
            $resultArray = $this->admin_model->addCategories($formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message' , $this->lang->line('categoryAddSuccess'));
                redirect(site_url() . 'admin/Categories');
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('back/template', $data);
    }

//--------------------------------------------------------------------------------------------------------
    function addMovie()
    {
        $data = array();
        $data['MetaTitle']='addMovie';
        $data['MetaDescription']='admin/addMovie';
        $data['View']='back/addMovie';

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Name', 'Name', 'required|min_length[2]');
            $this->form_validation->set_rules('Category', 'Category');
            $this->form_validation->set_rules('Category2', 'Category2');
            $this->form_validation->set_rules('Score', 'Score');
            $this->form_validation->set_rules('Date', 'Date');


            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('back/template', $data);
                return;
            }

            $formData=array(
                'Name'=>$this->input->post('Name'),
                'Category'=>$this->input->post('Category'),
                'Category2'=>$this->input->post('Category2'),
                'Score'=>$this->input->post('Score'),
                'Date'=>$this->input->post('Date'),
            );
            $resultArray = $this->admin_model->addMovie($formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message', $this->lang->line('productAddSuccess'));
                redirect(site_url() . 'Admin/movies');
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('back/template', $data);
    }
//--------------------------------------------------------------------------------------------------------
    function UpdateAdmin($adminId){
        $data = array();
        $data['AdminDetail'] = $this->admin_model->getAdmins(array('Id'=> $adminId));
        $data['MetaTitle']='UpdateAdmin';
        $data['MetaDescription']='admin/UpdateAdmin';
        $data['View']='back/UpdateAdmin';

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Name', 'Name', 'required|min_length[2]');
            $this->form_validation->set_rules('Email', 'Email', 'required|min_length[4]|valid_email');
            $this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('Status', 'Status', 'required|min_length[1]');
            $this->form_validation->set_rules('Surname', 'Surname', 'required|min_length[2]');
            $this->form_validation->set_rules('AddedDate', 'AddedDate', 'required|min_length[6]');
            $this->form_validation->set_rules('LoginDate', 'LoginDate', 'required|min_length[6]');
            $this->form_validation->set_rules('FailedDate', 'FailedDate', 'required|min_length[6]');
            $this->form_validation->set_rules('UpdatedDate', 'UpdatedDate', 'required|min_length[6]');
            $this-> form_validation->set_rules('Browser', 'Browser', 'required|min_length[2]');
            $this-> form_validation->set_rules('IP', 'IP', 'required|min_length[4]');
            $this-> form_validation->set_rules('OS', 'OS', 'required|min_length[2]');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('back/template', $data);
                return;
            }

            $formData=array(
                'Name'=>$this->input->post('Name'),
                'Email'=>$this->input->post('Email'),
                'Password'=>$this->input->post('Password'),
                'Status'=>$this->input->post('Status'),
                'Surname'=>$this->input->post('Surname'),
                'AddedDate'=>$this->input->post('AddedDate'),
                'LoginDate'=>$this->input->post('LoginDate'),
                'FailedDate'=>$this->input->post('FailedDate'),
                'UpdatedDate'=>$this->input->post('UpdatedDate'),
                'IP'=>$this->input->post('IP'),
                'Browser'=>$this->input->post('Browser'),
                'OS'=>$this->input->post('OS')
            );

            $whereData = array('Id' =>$adminId);
            $resultArray = $this->admin_model->UpdateAdmin($whereData,$formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message',$this->lang->line('adminUpdateSuccess'));
                redirect(site_url() . 'admin/UpdateAdmin/'.$adminId);
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('back/template', $data);
    }
//--------------------------------------------------------------------------------------------------------
    function UpdateCategory($categoryId){
        $data = array();
        $data['AdminDetail'] = $this->product_model->Categories(array('Id'=> $categoryId));
        $data['MetaTitle']='UpdateCategory';
        $data['MetaDescription']='admin/UpdateCategory';
        $data['View']='back/UpdateCategory';

        if(!empty($this->input->post()))
        {$this-> form_validation->set_rules('Title', 'Title', 'required|min_length[2]');
            $this->form_validation->set_rules('Description', 'Description', 'required|min_length[4]');
            $this->form_validation->set_rules('Status', 'Status', 'required|min_length[1]');
            $this->form_validation->set_rules('AddedDate', 'AddedDate', 'required|min_length[8]');
            $this->form_validation->set_rules('UpdatedDate', 'UpdatedDate', 'required|min_length[8]');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('back/template', $data);
                return;
            }

            $formData=array(
                'Title'=>$this->input->post('Title'),
                'Description'=>$this->input->post('Description'),
                'Status'=>$this->input->post('Status'),
                'AddedDate'=>$this->input->post('AddedDate'),
                'UpdatedDate'=>$this->input->post('UpdatedDate')
            );

            $whereData = array('Id' =>$categoryId);
            $resultArray = $this->admin_model->UpdateCategory($whereData,$formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message', $this->lang->line('categoryUpdateSuccess'));
                redirect(site_url() . 'admin/UpdateCategory/'.$categoryId);
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('back/template', $data);
    }


    //--------------------------------------------------------------------------------------------------------
    function UpdateProduct($productId){
        $data = array();
        $productArray = $this->product_model->movies(array('Id'=> $productId));
        $data['AdminDetail'] = $productArray['Data'];
        $data['MetaTitle']='UpdateProduct';
        $data['MetaDescription']='admin/UpdateProduct';
        $data['View']='back/UpdateProduct';
        $data['CategoryList'] = $this->product_model->Categories();

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Title', 'Title', 'required|min_length[2]');
            $this->form_validation->set_rules('CategoryId', 'CategoryId');
            $this->form_validation->set_rules('AddedDate', 'AddedDate', 'required|min_length[10]');
            $this->form_validation->set_rules('UpdatedDate', 'UpdatedDate', 'required|min_length[10]');
            $this->form_validation->set_rules('Status', 'Status', 'required|min_length[1]');
            $this->form_validation->set_rules('Price', 'Price', 'required|min_length[1]');
            $this->form_validation->set_rules('PriceDiscount', 'PriceDiscount', 'required|min_length[1]');
            $this->form_validation->set_rules('Country', 'Country');
            $this->form_validation->set_rules('Year', 'Year', 'required|min_length[4]|max_length[4]');
            $this->form_validation->set_rules('Width', 'Width');
            $this->form_validation->set_rules('Height', 'Height');
            $this->form_validation->set_rules('Description', 'Description', 'required|min_length[1]');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('back/template', $data);
                return;
            }

            $formData=array(
                'Title'=>$this->input->post('Title'),
                'CategoryId'=>$this->input->post('CategoryId'),
                'UpdatedDate'=>$this->input->post('UpdatedDate'),
                'Status'=>$this->input->post('Status'),
                'Price'=>$this->input->post('Price'),
                'PriceDiscount'=>$this->input->post('PriceDiscount'),
                'Country'=>$this->input->post('Country'),
                'Year'=>$this->input->post('Year'),
                'Width'=>$this->input->post('Width'),
                'Height'=>$this->input->post('Height'),
                'Description'=>$this->input->post('Description'),
                'AddedDate'=>$this->input->post('AddedDate')
            );

            $whereData = array('Id' =>$productId);
            $resultArray = $this->admin_model->UpdateProduct($whereData,$formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message', $this->lang->line('productUpdateSuccess'));
                redirect(site_url() . 'admin/Products/');
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('back/template', $data);
    }

//--------------------------------------------------------------------------------------------------------
    function DeleteAdmin($adminId){
        $whereData = array('Id' =>$adminId);
        $resultArray = $this->admin_model->DeleteAdmin($whereData);
        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message', $this->lang->line('deleteAdmin'));
            redirect(site_url() . 'admin/GetAdmins');
        }

        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));

        redirect(site_url() . 'admin/GetAdmins');
    }
//--------------------------------------------------------------------------------------------------------
    function DeleteCategory($categoryId){
        $whereData = array('Id' =>$categoryId);
        $resultArray = $this->admin_model->DeleteCategory($whereData);
        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message', $this->lang->line('deleteCategory'));
            redirect(site_url() . 'admin/Categories');
        }

        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message' , $this->lang->line('somethingWentWrong'));

        redirect(site_url() . 'admin/Categories');
    }

    function DeleteProduct($productId){
        $whereData = array('Id' =>$productId);
        $resultArray = $this->admin_model->DeleteProduct($whereData);
        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message',$this->lang->line('deleteProduct'));
            redirect(site_url() . 'admin/Products');
        }

        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message' , $this->lang->line('somethingWentWrong'));

        redirect(site_url() . 'admin/Products');
    }

    function DeleteContact($contactId){
        $whereData = array('Id' =>$contactId);
        $resultArray = $this->admin_model->DeleteContact($whereData);
        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message', $this->lang->line('deleteContact'));
            redirect(site_url() . 'admin/Contacts');
        }

        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message' , $this->lang->line('somethingWentWrong'));

        redirect(site_url() . 'admin/Contacts');
    }
//--------------------------------------------------------------------------------------------------------

    function ProductsImage($imageId){
        $data['MetaTitle']='ProductsImage';
        $data['MetaDescription']='admin/ProductsImage';
        $data['View']='back/ProductsImage';
        $data['ImageList'] = $this->movie_model->ProductsImage(array('ProductId'=>$imageId));
        $data['ProductId'] = $imageId;
        $this->load->view('back/template', $data);
    }

    function ImageMain(){
        $data['MetaTitle']='ProductsImage';
        $data['MetaDescription']='admin/ProductsImage';
        $data['View']='back/images';
        $data['ImageList'] = $this->movie_model->Products();
        $this->load->view('back/template', $data);
    }

    function DeleteProductImage($productId, $productImageId){
        $whereData = array('Id' =>$productImageId);
        $resultArray = $this->admin_model->DeleteProductImage($whereData);
        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message',$this->lang->line('deleteProduct'));
            redirect(site_url() . 'admin/ImagesUpload/'.$productId);
        }

        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message' , $this->lang->line('somethingWentWrong'));

        redirect(site_url() . 'admin/ImagesUpload/'.$productId);
    }
//--------------------------------------------------------------------------------------------------------

    function AddProductImage($productId){

        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            json_output(500,array('error'=>1));
        }

        if(!isset($_FILES))
        {
            json_output(500,array('error'=>2));
        }
        elseif (count($_FILES) == 0)
        {
            json_output(500,array('error'=>4));
        }


        $productArray = $this->movie_model->Products(array('Id'=> $productId));
        $title= $productArray['Data'][0]->Name;

        $uploadedFiles = upload_files($title, $_FILES['file']);
        if($uploadedFiles == false )
        {
            json_output(500,array('error'=>3));
        }

        $formData=array(
            'Image'=>$uploadedFiles,
            'ProductId'=>$productId,
            'Status'=>'1',
            'Main'=>'1',
            'AddedDate'=>date('Y-m-d- H:i:s')
        );
        $resultArray = $this->admin_model->AddProductImage($formData);

        if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
            json_output(500,array());

            return;
        } else if(count($resultArray['Data']) > 0) {
            $this->session->set_flashdata('MessageType','success');
            $this->session->set_flashdata('Message', $this->lang->line('productAddSuccess'));
            json_output(200,array());


        }
        $this->session->set_flashdata('MessageType','danger');
        $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        json_output(500,array('error'=>4));
    }

    //--------------------------------------------------------------------------------------------------------
    function UpdateProductImage($categoryId){
        $data = array();
        $data['AdminDetail'] = $this->product_model->Categories(array('Id'=> $categoryId));
        $data['MetaTitle']='UpdateCategory';
        $data['MetaDescription']='admin/UpdateCategory';
        $data['View']='back/UpdateCategory';

        if(!empty($this->input->post()))
        {
            $this-> form_validation->set_rules('Main', 'Main');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message', validation_errors());
                $this->load->view('back/template', $data);
                return;
            }

            $formData=array(
                'Main'=>$this->input->post('Main'),
            );

            $whereData = array('Id' =>$categoryId);
            $resultArray = $this->admin_model->UpdateProductImage($whereData,$formData);

            if(isset($resultArray['Errors']) && count($resultArray ['Errors']) > 0){
                $this->session->set_flashdata('MessageType','danger');
                $this->session->set_flashdata('Message',$resultArray['Errors'][0]);
                return;
            } else if(count($resultArray['Data']) > 0) {
                $this->session->set_flashdata('MessageType','success');
                $this->session->set_flashdata('Message', $this->lang->line('categoryUpdateSuccess'));
                redirect(site_url() . 'admin/ImageMain/'.$categoryId);
            }

            $this->session->set_flashdata('MessageType','danger');
            $this->session->set_flashdata('Message', $this->lang->line('somethingWentWrong'));
        }

        $this->load->view('back/template', $data);
    }
}