<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('admin_user_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }	
		
	public function logout()
    {
		set_success_flashdata('you have successfully signed out');
		logout_admin_user();
    }
	
	public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
			$data = $this->seo_model->get_seo('login');		
			$this->load->view('admin/admin_user/login', $data);
        } else {
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			
			$admin_user = $this->admin_user_model->get_admin_user_by_email($email);            
			if((bool)$admin_user === false || !password_verify($password, $admin_user->password)){
				$this->session->set_flashdata('email', $email);
				$this->session->set_flashdata('pasword', $password);
				set_error_flashdata('Email / Password Invalid');
				redirect('admin/login/', 'refresh');
			}else{			
				put_admin_user_login_details($admin_user);				
			}            
        }
    }		
		
	public function update_profile()
    {
		verify_admin_user(uri_string());
		
		$admin_user_id = $this->session->admin_user_id;
		
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
		if (!empty($this->input->post("password", TRUE))) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[8]');
        }
        		

        if ($this->form_validation->run() === FALSE) {		
			$data['admin_user'] = $this->admin_user_model->get_admin_user($admin_user_id);
			$this->load->view('admin/admin_user/update_profile', $data);
        } else {
			
			$full_name = $this->input->post("full_name", TRUE);
			$password = $this->input->post("password", TRUE);			

            $data = array(
                'full_name' => $full_name
            );
			if (!empty($password)) {
				$data['password'] = password($password);
			}
			
            $this->admin_user_model->update_admin_user($admin_user_id, $data);
			$admin_user = $this->admin_user_model->get_admin_user($admin_user_id);
			set_success_flashdata('Account info updated successfully');
			put_admin_user_login_details($admin_user);
			           
        }
    }
	
	
}
