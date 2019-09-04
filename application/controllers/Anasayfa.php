<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anasayfa extends CI_Controller {

	public function index()
	{
		$this->load->view('front/anasayfa');
	}

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

                redirect(site_url() . 'admin/dashboard');

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
}
