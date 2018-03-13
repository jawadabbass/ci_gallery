<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_user extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('site_user_model');
		$this->load->model('gallery_model');
		$this->load->model('category_model');
        $this->load->helper('form');
		$this->load->helper('text');		
		$this->load->library('image_uploader');
        $this->load->library('form_validation');		
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }	
	
	public function dashboard()
    {
		verify_site_user(uri_string());
		
		$category_id = 0;
		$category = $this->input->get('category', true);
		if(!empty($category)){
			$category_obj = $this->category_model->get_category_by_name($category);
			$category_id = $category_obj->id;
		}
		
        $data = $this->seo_model->get_seo('user-dashboard');
		$data['categories'] = $this->category_model->get_all_categories();
		$data['gallery_images'] = $this->gallery_model->get_all_images($category_id, get_site_user_id()); 
		$this->load->view('site_user/dashboard', $data);    
    }
	
	public function logout()
    {
		set_success_flashdata('you have successfully signed out');
		logout_site_user();
    }
	
	public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
			$data = $this->seo_model->get_seo('login');		
			$this->load->view('site_user/login', $data);
        } else {
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			
			$site_user = $this->site_user_model->get_site_user_by_email($email);            
			if((bool)$site_user === false || !password_verify($password, $site_user->password)){
				$this->session->set_flashdata('email', $email);
				$this->session->set_flashdata('pasword', $password);
				set_error_flashdata('Email / Password Invalid');
				redirect('login/', 'refresh');
			}else{			
				put_site_user_login_details($site_user);				
			}            
        }
    }
	
	public function register()
    {
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[site_users.email]', array('is_unique' => 'Someone already registers with this email.'));
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|min_length[8]|matches[password]');
		$this->form_validation->set_rules('i_agree', 'Terms and Conditions', 'required', array('required' => 'Please check %s.'));
		
		if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'required', array('required' => 'Please select %s.'));
        }

        if ($this->form_validation->run() === FALSE) {
			$data = $this->seo_model->get_seo('register');		
			$this->load->view('site_user/register', $data);
        } else {
			$new_name_for_image = url_title($this->input->post("full_name", TRUE), 'dash', true);
            $image_name = $this->image_uploader->do_upload('image', $new_name_for_image, 'assets/uploads/site_users_images');

            $data = array(
                'full_name' => $this->input->post("full_name", TRUE),
                'email' => $this->input->post("email", TRUE),
				'password' => password($this->input->post("password", TRUE))
            );
            if (!empty($image_name)) {
                $data['image'] = $image_name;
            }
            $site_user_id = $this->site_user_model->insert_site_user($data);
			$site_user = $this->site_user_model->get_site_user($site_user_id);			
			set_success_flashdata('You have signed up successfully');			
			put_site_user_login_details($site_user);
			           
        }
	}
		
	public function update_profile()
    {
		verify_site_user(uri_string());
		
		$site_user_id = $this->session->site_user_id;
		
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
		if (!empty($this->input->post("password", TRUE))) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[8]');
        }
        		

        if ($this->form_validation->run() === FALSE) {
			$data = $this->seo_model->get_seo('register');			
			$data['site_user'] = $this->site_user_model->get_site_user($site_user_id);
			$this->load->view('site_user/update_profile', $data);
        } else {
			
			$full_name = $this->input->post("full_name", TRUE);
			$password = $this->input->post("password", TRUE);

			$new_name_for_image = url_title($full_name, 'dash', true);
            $image_name = $this->image_uploader->do_upload('image', $new_name_for_image, 'assets/uploads/site_users_images');

            $data = array(
                'full_name' => $full_name
            );
			if (!empty($password)) {
				$data['password'] = password($password);
			}
            if (!empty($image_name)) {
				$this->site_user_model->unlink_image($site_user_id);
                $data['image'] = $image_name;
            }
            $this->site_user_model->update_site_user($site_user_id, $data);
			$site_user = $this->site_user_model->get_site_user($site_user_id);
			set_success_flashdata('Account info updated successfully');
			put_site_user_login_details($site_user);
			           
        }
    }
	
	
}
