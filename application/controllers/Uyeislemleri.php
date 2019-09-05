<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uyeislemleri extends CI_Controller
{

    public function index()
    {
       echo 'deneme';
    }
    public function kayitol()
    {
        $this->load->library('form_validation');
        $this-> form_validation->set_rules('email', 'email', 'is_unique[yonetim.uyemail]|required');
        $this-> form_validation->set_rules('password', 'Password', 'matches[confirm]|required');
        $this->form_validation->set_rules('confirm', 'Confirm', 'required');

        $this->form_validation->set_message('matches','<div class="alert alert-danger">Şifre Eşleşmiyor</div>');
        $this->form_validation->set_message('is_unique','<div class="alert alert-danger">Mail Kullanılıyor</div>');

        if($this->form_validation->run() == FALSE)
        {
           $this->load->view('front/anasayfa');
        }else
        {
            $adsoyad = $this->input->post('username');
            $email = $this->input->post('email');
            $sifre = $this->input->post('password');
            $tarih = date('Y-m-d');
            $data = array(
                'uyeadi'=>$adsoyad,
                'uyemail'=>$email,
                'uyesifre'=>$sifre,
                'uyeresim'=>'assets/front/images/uploads/ava4.jpg',
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
    public function girisYap()
    {
        $this->load->model('anasayfa_model');
        $email = $this->input->post('email');
        $sifre = $this->input->post('password');
        $sonuc = $this->anasayfa_model->uyeKontrol($email,$sifre);
        if($sonuc)
        {
            $this->session->userdata('durum',true);
            $this->session->userdata('user',$sonuc);
            $this->session->set_flashdata('success','<div class="alert alert-success">Giriş Yapıldı</div>');
            redirect(base_url().'anasayfa');
        }
    }
}