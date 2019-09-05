<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anasayfa extends CI_Controller {

    private $fb;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('facebookSDK');
        $this->fb = $this->facebooksdk;
    }

    public function index()
    {
        $this->load->library('facebookSDK');
        $this->fb = $this->facebooksdk;
        $adress = "http://localhost/dizisitesi/Anasayfa/callback";
        $data['url'] = $this->fb->getLoginUrl($adress);
        $this->load->view('front/anasayfa',$data);
    }

    public function callback()
    {
        $token = $this->fb->getAccessToken();
        $data = $this->fb->getUserData($token);
        $email = $data['email'];
        $this->load->model('anasayfa_model');
        $sonuc = $this->anasayfa_model->facebook($email);
        if($sonuc == true)
        {
                $this->session->userdata('durum',true);
                $this->session->userdata('user',$sonuc);
                $this->session->set_flashdata('success','<div class="alert alert-success">Giriş Yapıldı</div>');
                redirect(base_url().'anasayfa');
        }else
        {



            $tarih = date('Y-m-d');
            $random = rand(123456,987654);
            $data = array(
                'uyetipi'=>'facebook',
                'uyeadi'=>$data['name'],
                'uyemail'=>$data['email'],
                'uyesifre'=>$random,
                'uyeresim'=>'http://graph.facebook.com/'.$data['id'].'/picture',
                'uyeaktif'=>1,
                'kayittarihi'=>$tarih);
            $this->load->model('anasayfa_model');
            $ekle = $this->anasayfa_model->ekle($data,'yonetim');
            if($ekle)
            {
                $this->session->set_flashdata('info','<div class="alert alert-success">Tebrikler artık giriş yapabilirsiniz</div>');
                redirect(base_url().'anasayfa');
            }
        }
    }
}
