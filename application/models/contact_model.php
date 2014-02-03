<?php


class Contact_model extends CI_Model
{
    public function construct()
    {
        parent::__contrust();
    }
    
    public function create($first_name, $last_name, $email, $phone, $bday, $address, $city, $state, $zip)    
    {
        return $this->db->insert('contact', array(
            "first_name"    => $first_name, 
            "last_name"     => $last_name, 
            "email"         => $email, 
            "phone"         => $phone, 
            "birthday"      => $bday, 
            "address"       => $address, 
            "city"          => $city, 
            "state"         => $state, 
            "zip"           => $zip
        ));
    }
    
    public function delete($user_id)
    {
        $this->db->where(array('id' => $user_id)); 
        return $this->db->delete('contact');
    }
    
    public function update($user_id, $update_arr)
    {
        $this->db->where(array('id' => $user_id));
        return $this->db->update('contact', $update_arr);
    }
    
    public function read($user_id = null)
    {
        if($user_id == null)
        {
            $this->db->order_by("last_name", "asc");
            $query = $this->db->get('contact');
        }else 
        {
            $this->db->order_by("last_name", "asc");
            $this->db->where('id', $user_id);
            $query = $this->db->get('contact');
        }
       
        return $query->result();
    }
}