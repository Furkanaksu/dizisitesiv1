<?php
class anasayfa_model extends CI_Model
{
    function ekle($data = array(),$where){
        $result = $this->db->insert($where,$data);
        return $result;
    }

    function login($username, $password)
    {
        $AdminIP = $this->input->ip_address();
        $AdminOS= getOS();
        $AdminBrowser= getBrowser();
        $AdminDate = date('Y-m-d- H:i:s');
        $this->db->where('Email', $username);
        $this->db->where('Password', $password);
        $this->db->limit(1);
        $query = $this->db->get('yonetim');
        if($query->num_rows() > 0)
        {
            $AdminCheck = $query->row();

            $this->db->where('Id', $AdminCheck->Id);
            $UpdateData = array(
                'LoginDate' =>$AdminDate,
                'IP' =>$AdminIP,
                'OS' =>$AdminOS,
                'Browser' =>$AdminBrowser
            );
            $this->db->update('yonetim', $UpdateData);

            $AdminCheck->LoginDate = $AdminDate;
            $AdminCheck->IP = $AdminIP;
            $AdminCheck->OS = $AdminOS;
            $AdminCheck->Browser = $AdminBrowser;

            return $AdminCheck;
        }
        else
        {
            $this->db->where('Email', $username);
            $this->db->limit(1);
            $query = $this->db->get('yonetim');
            if($query->num_rows() > 0) {
                $this->db->where('Email', $username);
                $UpdateData = array(
                    'FailedDate' =>date('Y-m-d- H:i:s'),
                    'IP' =>$AdminIP,
                    'OS' =>$AdminOS,
                    'Browser' =>$AdminBrowser
                );
            }
            return array();
        }

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