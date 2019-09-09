<?php
class admin_model extends CI_Model
{
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
    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------
    public function getAdmins($adminWhere = array()){
        if(count($adminWhere) > 0)
        {
            $this->db->where($adminWhere);
        }
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('yonetim');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return array();
        }
    }


    public function Contacts($contactWhere = array()){
        $returnArray = array();
        $ProductList = $this->product_model->Products();
        $ProductList = $ProductList['Data'];
        if(count($contactWhere) > 0)
        {
            $this->db->where($contactWhere);
        }
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('contacts');
        if($query->num_rows() > 0)
        {
            $contactList = $query->result();
            foreach ($contactList as $contact){
                $contact->ProductTitle = 'No Product';
                foreach ($ProductList as $product){
                    if($product->Id == $contact->ProductId)
                    {
                        $contact->ProductTitle = $product->Title;
                        break;
                    }
                }

                $returnArray[] = $contact;
            }

            return $returnArray;
        }
        else
        {
            return array();
        }
    }

    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------
    public function getImages($categoryWhere = array()){
        if(count($categoryWhere) > 0)
        {
            $this->db->where($categoryWhere);
        }
        $this->db->order_by('Id', 'DESC');
        $query = $this->db->get('productsimage');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return array();
        }
    }
    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------
    function addAdmin($formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $adminCheck = $this->getAdmins(array('Email'=>$formData['Email']));
        if(count($adminCheck)>0)
        {
            $resultArray['Errors'] = array($this->lang->line('emailInUse'));
            return $resultArray;
        }

        $insertData = array(
            'Name'=>$formData['Name'],
            'Email'=>$formData['Email'],
            'Password'=>$formData['Password'],
            'Status'=>$formData['Status'],
            'Surname'=>$formData['Surname'],
            'AddedDate'=>$formData['AddedDate'],
            'UpdatedDate'=>'0000-00-00 00:00:00',
            'LoginDate'=>'0000-00-00 00:00:00',
            'IP'=>'0.0.0.0',
            'OS'=>'Unknown',
            'Browser'=>'Unknown',
            'FailedDate'=>'0000-00-00 00:00:00'
        );

        $this->db->insert('yonetim',$insertData);
        $insertResult = ($this->db->affected_rows() != 1) ? false : true;
        if($insertResult == true) {
            $resultArray['Data'] = $this->getAdmins(array('Email'=>$formData['Email']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('adminCantAdded'));
        }
        return $resultArray;
    }
    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------
    function addCategories($formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $insertData = array(
            'Title'=>$formData['Title'],
            'Description'=>$formData['Description'],
            'Status'=>$formData['Status'],
            'AddedDate'=>$formData['AddedDate'],
            'UpdatedDate'=>'0000-00-00 00:00:00'
        );

        $this->db->insert('categories',$insertData);
        $insertResult = ($this->db->affected_rows() != 1) ? false : true;
        if($insertResult == true) {
            $resultArray['Data'] = $this->product_model->Categories(array('Title'=>$formData['Title']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('categoryCantAdded'));
        }
        return $resultArray;
    }

    // ---------------------AddProducts-------------------------------------------------------------------------------
    function AddProducts($formData = array())
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $insertData = array(
            'Title'=>$formData['Title'],
            'CategoryId'=>$formData['CategoryId'],
            'UpdatedDate'=>'0000-00-00 00:00:00',
            'Status'=>$formData['Status'],
            'Price'=>$formData['Price'],
            'PriceDiscount'=>$formData['PriceDiscount'],
            'Country'=>$formData['Country'],
            'Year'=>$formData['Year'],
            'Width'=>$formData['Width'],
            'Height'=>$formData['Height'],
            'Description'=>$formData['Description'],
            'AddedDate'=>$formData['AddedDate']
        );

        $this->db->insert('products',$insertData);
        $insertResult = ($this->db->affected_rows() != 1) ? false : true;
        if($insertResult == true) {
            $resultArray['Data'] = $this->product_model->Products(array('Title'=>$formData['Title']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantAdded'));
        }
        return $resultArray;
    }

    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------

    function UpdateAdmin($whereData ,$formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $adminCheck = $this->getAdmins(array('Email'=>$formData['Email']));
        if(count($adminCheck)>0)
        {
            if($adminCheck[0]->Id != $whereData['Id']){
                $resultArray['Errors'] = array($this->lang->line('emailInUse'));
                return $resultArray;
            }
        }else
        {
            $resultArray['Errors'] = array($this->lang->line('unknownUser'));
            return $resultArray;
        }

        $updateData = array(
            'Name'=>$formData['Name'],
            'Email'=>$formData['Email'],
            'Password'=>$formData['Password'],
            'Status'=>$formData['Status'],
            'Surname'=>$formData['Surname'],
            'AddedDate'=>$formData['AddedDate'],
            'UpdatedDate'=>$formData['UpdatedDate'],
            'LoginDate'=>$formData['LoginDate'],
            'IP'=>$formData['IP'],
            'OS'=>$formData['OS'],
            'Browser'=>$formData['Browser'],
            'FailedDate'=>$formData['FailedDate']
        );

        $this->db->where($whereData);
        $this->db->update('yonetim',$updateData);
        $updateResult = ($this->db->affected_rows() != 1) ? false : true;
        if($updateResult == true) {
            $resultArray['Data'] = $this->getAdmins(array('Id'=>$whereData['Id']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('adminCantUpdated'));
        }
        return $resultArray;
    }

    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------

    function UpdateCategory($whereData ,$formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $adminCheck = $this->product_model->Categories(array('Title'=>$formData['Title']));
        if(count($adminCheck)>0)
        {
            if($adminCheck[0]->Id != $whereData['Id']){
                $resultArray['Errors'] = array($this->lang->line('categoryInUse'));
                return $resultArray;
            }
        }else
        {
            $resultArray['Errors'] = array($this->lang->line('unknownCategory'));
            return $resultArray;
        }

        $updateData = array(
            'Title'=>$formData['Title'],
            'Description'=>$formData['Description'],
            'Status'=>$formData['Status'],
            'AddedDate'=>$formData['AddedDate'],
            'UpdatedDate'=>$formData['UpdatedDate']
        );

        $this->db->where($whereData);
        $this->db->update('categories',$updateData);
        $updateResult = ($this->db->affected_rows() != 1) ? false : true;
        if($updateResult == true) {
            $resultArray['Data'] = $this->product_model->Categories(array('Id'=>$whereData['Id']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('categoryCantUpdated'));
        }
        return $resultArray;
    }

    // ---------------------UPDATE ADMIN-------------------------------------------------------------------------------

    function UpdateProduct($whereData ,$formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $updateData = array(
            'Title'=>$formData['Title'],
            'Description'=>$formData['Description'],
            'Status'=>$formData['Status'],
            'AddedDate'=>$formData['AddedDate'],
            'UpdatedDate'=>$formData['UpdatedDate'],
            'CategoryId'=>$formData['CategoryId'],
            'Price'=>$formData['Price'],
            'PriceDiscount'=>$formData['PriceDiscount'],
            'Country'=>$formData['Country'],
            'Year'=>$formData['Year'],
            'Width'=>$formData['Width'],
            'Height'=>$formData['Height']
        );

        $this->db->where($whereData);
        $this->db->update('products',$updateData);
        $updateResult = ($this->db->affected_rows() != 1) ? false : true;
        if($updateResult == true) {
            $resultArray['Data'] = $this->product_model->Products(array('Id'=>$whereData['Id']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantUpdated'));
            redirect(site_url() . 'admin/Products');
        }
        return $resultArray;
    }

    //-----------------------------------------------------------------------------------------------------------------
    function DeleteAdmin($whereData){

        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );
        $this->db->where($whereData);
        $this->db->delete('yonetim');
        $deleteResult = ($this->db->affected_rows() != 1) ? false : true;
        if($deleteResult == true) {
            $resultArray['Data'] = array('ok');
        } else {
            $resultArray['Errors'] = array($this->lang->line('adminCantDeleted'));
        }

        return $resultArray;
    }
//-----------------------------------------------------------------------------------------------------------------
    function DeleteCategory($whereData){

        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        if(isset($whereData['Id']))
        {
            $this->db->where('CategoryId', $whereData['Id']);
            $UpdateData = array(
                'CategoryId' =>0
            );
            $this->db->update('products', $UpdateData);
        }

        $this->db->where($whereData);
        $this->db->delete('categories');
        $deleteResult = ($this->db->affected_rows() != 1) ? false : true;
        if($deleteResult == true) {
            $resultArray['Data'] = array('ok');
        } else {
            $resultArray['Errors'] = array($this->lang->line('categoryCantDeleted'));
        }

        return $resultArray;
    }
//-----------------------------------------------------------------------------------------------------------------
    function DeleteProduct($whereData){

        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        if(isset($whereData['Id']))
        {
            $this->db->where('ProductId', $whereData['Id']);
            $UpdateData = array(
                'ProductId' =>0
            );
            $this->db->update('contacts', $UpdateData);
        }
        $this->db->where($whereData);
        $this->db->delete('products');
        $deleteResult = ($this->db->affected_rows() != 1) ? false : true;
        if($deleteResult == true) {
            $resultArray['Data'] = array('ok');
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantDeleted'));
        }

        return $resultArray;
    }
    //-----------------------------------------------------------------------------------------------------------------
        function DeleteContact($whereData){

        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $this->db->where($whereData);
        $this->db->delete('contacts');
            $deleteResult = ($this->db->affected_rows() != 1) ? false : true;
        if($deleteResult == true) {
            $resultArray['Data'] = array('ok');
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantDeleted'));
        }

        return $resultArray;
    }

    function DeleteProductImage($whereData){
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $ImageDelete = $this->product_model->ProductsImage();

        $path = "posters/orj/";
        $delete = unlink($path.$ImageDelete[0]->Image);

        $this->db->where($whereData);
        $this->db->delete('productsimage');
        $deleteResult = ($this->db->affected_rows() != 1) ? false : true;
        if($deleteResult == true) {
            $resultArray['Data'] = array('ok');
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantDeleted'));
        }

        return $resultArray;
    }

    function AddProductImage($formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $insertData = array(
            'Image'=>$formData['Image'],
            'ProductId'=>$formData['ProductId'],
            'Status'=>$formData['Status'],
            'Main'=>$formData['Main'],
            'AddedDate'=>$formData['AddedDate']
        );

        $this->db->insert('productsimage',$insertData);
        $insertResult = ($this->db->affected_rows() != 1) ? false : true;
        if($insertResult == true) {
            $resultArray['Data'] = $this->product_model->ProductsImage(array('Image'=>$formData['Image']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('categoryCantAdded'));
        }
        return $resultArray;
    }

    function UpdateProductImage($whereData ,$formData)
    {
        $resultArray = array(
            'Errors' => array(),
            'Data' => array()
        );

        $updateData = array(
            'Main'=>$formData['Main'],
        );

        $this->db->where($whereData);
        $this->db->update('products',$updateData);
        $updateResult = ($this->db->affected_rows() != 1) ? false : true;
        if($updateResult == true) {
            $resultArray['Data'] = $this->product_model->Products(array('Id'=>$whereData['Id']));
        } else {
            $resultArray['Errors'] = array($this->lang->line('productCantUpdated'));
            redirect(site_url() . 'admin/Products');
        }
        return $resultArray;
    }
}