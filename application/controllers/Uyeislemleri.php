<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uyeislemleri extends CI_Controller
{
    private $fb;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('facebookSDK');
        $this->fb = $this->facebooksdk;
        $this->load->model('anasayfa_model');
        $this->load->model('admin/movie_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = array();
        $data['movies'] = $this->movie_model->movies();
        $this->load->library('facebookSDK');
        $this->fb = $this->facebooksdk;
        $adress = "http://localhost/dizisitesi/Uyeislemleri/callback";
        $data['url'] = $this->fb->getLoginUrl($adress);

        $this->load->view('front/anasayfa', $data);


    }

    public function callback()
    {
        $token = $this->fb->getAccessToken();
        $data = $this->fb->getUserData($token);
        $email = $data['email'];
        $this->load->model('anasayfa_model');
        $sonuc = $this->anasayfa_model->facebook($email);
        if ($sonuc == true) {
            $this->session->userdata('durum', true);
            $this->session->userdata('user', $sonuc);
            $this->session->set_flashdata('success', '<div class="alert alert-success">Giriş Yapıldı</div>');
            redirect(base_url() . 'anasayfa');
        } else {
            $tarih = date('Y-m-d');
            $random = rand(123456, 987654);
            $data = array(
                'uyetipi' => 'facebook',
                'uyeadi' => $data['name'],
                'uyemail' => $data['email'],
                'uyesifre' => $random,
                'uyeresim' => 'http://graph.facebook.com/' . $data['id'] . '/picture',
                'uyeaktif' => 1,
                'kayittarihi' => $tarih);
            $this->load->model('anasayfa_model');
            $ekle = $this->anasayfa_model->ekle($data, 'yonetim');
            if ($ekle) {
                $this->session->set_flashdata('info', '<div class="alert alert-success">Tebrikler artık giriş yapabilirsiniz</div>');
                redirect(base_url() . 'anasayfa');
            }
        }
    }

    //---------------------------------------------------------------------------------------------------------------------------------------
    public function kayitol()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'email', 'is_unique[yonetim.uyemail]|required');
        $this->form_validation->set_rules('password', 'Password', 'matches[confirm]|required');
        $this->form_validation->set_rules('confirm', 'Confirm', 'required');

        $this->form_validation->set_message('matches', '<div class="alert alert-danger">Şifre Eşleşmiyor</div>');
        $this->form_validation->set_message('is_unique', '<div class="alert alert-danger">Mail Kullanılıyor</div>');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('front/anasayfa');
        } else {
            $adsoyad = $this->input->post('username');
            $email = $this->input->post('email');
            $sifre = $this->input->post('password');
            $tarih = date('Y-m-d');
            $data = array(
                'uyeadi' => $adsoyad,
                'uyemail' => $email,
                'uyesifre' => $sifre,
                'uyeresim' => 'assets/front/images/uploads/ava4.jpg',
                'uyeaktif' => 1,
                'kayittarihi' => $tarih);
            $this->load->model('anasayfa_model');
            $ekle = $this->anasayfa_model->ekle($data, 'yonetim');
            if ($ekle) {
                $this->session->set_flashdata('info', '<div class="alert alert-success">Tebrikler artık giriş yapabilirsiniz</div>');
                redirect(base_url() . 'anasayfa');
            }
        }
    }
    public function login()
    {
        $this->load->view('front/login');
    }

    public function girisYap()
    {

        if (!empty($this->input->post())) {
            $this->form_validation->set_rules('email', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run()) {

                $UserEmail = $this->input->post('email');
                $UserPassword = $this->input->post('password');

                $AdminCheck = $this->anasayfa_model->login($UserEmail, $UserPassword);
                if (count($AdminCheck) > 0) {
                    if ($AdminCheck->Status != 1) {
                        $this->session->set_flashdata('Message', 'Kullanıcı aktif değil.');
                        redirect(base_url() . 'Uyeislemleri/login');

                        return;
                    }
                    $session_data = array(
                        'Email' => $AdminCheck->Email,
                        'Id' => $AdminCheck->Id,
                        'IP' => $AdminCheck->IP,
                        'LoginDate' => $AdminCheck->LoginDate,
                        'FailedDate' => $AdminCheck->FailedDate,
                        'Name' => $AdminCheck->Name,
                        'Surname' => $AdminCheck->Surname,
                        'OS' => $AdminCheck->OS,
                        'Browser' => $AdminCheck->Browser

                    );
                    $this->session->set_userdata($session_data);

                    redirect(base_url());

                    //$this->load->view("admin/logout");
                } else {
                    $this->session->set_flashdata('error', 'Geçersiz Bilgi');
                    redirect(base_url() . 'Uyeislemleri/login');
                }
            } else {
                redirect(base_url() . 'Uyeislemleri/login');
            }
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url());
    }
}