<?php
class anasayfa_model extends CI_Model
{
    function ekle($data = array(),$where){
        $result = $this->db->insert($where,$data);
        return $result;
    }

    function uyeKontrol($email,$sifre){
        $this->db->where('uyemail', $email);
        $this->db->where('uyesifre', $sifre);
        $this->db->limit(1);
        $query = $this->db->get('yonetim');
        return $query->result(); //$query->row
    }

    function facebook($email){
        $this->db->where('uyemail', $email);
        $this->db->where('uyetipi', 'facebook');
        $this->db->limit(1);
        $query = $this->db->get('yonetim');
        $sonuc = $query->result();
        if($sonuc)
        {
            return true;
        }
        {
            return false;
        }
    }
}