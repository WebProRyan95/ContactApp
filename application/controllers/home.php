<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
            $this->load->model('contact_model');
            $contacts = $this->contact_model->read();
            
            $this->load->view('home', array('contacts' => $contacts));
	}
        
        public function search($value)
        {
            $this->load->model('contact_model'); 
            $contact = $this->contact_model->read($value);
            $this->load->view('home', $contact);
        }
        
        public function create_contact()
        {
            $fname = $this->input->post('first_name');
            $lname = $this->input->post('last_name'); 
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $bday  = $this->input->post('birthday');
            $address = $this->input->post('address');
            $city  = $this->input->post('city');
            $state = $this->input->post('state');
            $zip   = $this->input->post('zip');
            
            if($fname == "" || $lname == "" || $email == ""){
               die("Values for First Name, Last Name, and Email were empty.");
            }
            
            $this->load->model('contact_model');
            $contact = $this->contact_model->create($fname, $lname, $email,$phone, $bday, $address, $city, $state, $zip);
            
            if($contact == 1)
            {
                $this->index();
            }
        }
        
        public function delete_contact($user_id)
        {
            $update_arr = array(
                'first_name'    => $this->input->post('first_name'), 
                'last_name'     => $this->input->post('last_name'), 
                'email'         => $this->input->post('email'), 
                'phone'         => $this->input->post('phone'), 
                'bday'          => $this->input->post('birthday'), 
                'address'       => $this->input->post('address'), 
                'city'          => $this->input->post('city'), 
                'state'         => $this->input->post('state'), 
                'zip'           => $this->input->post('zip')
            );
            
            $this->load->model('contact_model');
            $this->contact_model->delete($user_id, $update_arr);
            $this->index();
        }
        
        public function update_contact($user_id)
        {
            if(!isset($user_id)){ die('User id not recognized for this user. '); }

            $this->load->model('contact_model');
            $this->contact_model->update($user_id);
            $this->index();
        }
        
        public function get_contact($user_id)
        {
            $this->load->model('contact_model');
            $results = $this->contact_model->read($user_id);
            $contact = array();
            $t = array();
            
            foreach ($results as $key => $value) {
                $contact[] = $value->first_name;
                $contact[] = $value->last_name;
                $contact[] = $value->email;
                $contact[] = $value->phone;
                $contact[] = $value->birthday;
                $contact[] = $value->address;
                $contact[] = $value->city;
                $contact[] = $value->state;
                $contact[] = $value->zip;
            }
            
            return print_r(json_encode($contact));
            
        }
}