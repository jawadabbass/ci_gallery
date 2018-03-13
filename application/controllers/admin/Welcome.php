<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
		verify_admin_user(uri_string());
		$this->load->model('gallery_model');
		$this->load->model('category_model');
		$this->load->model('site_user_model');
    }
	
	public function index()
	{		
		$data['total_categories'] = $this->category_model->total_categories();
		$data['total_gallery_images'] = $this->gallery_model->total_gallery_images();
		$data['total_site_users'] = $this->site_user_model->total_site_users();
		
		$this->load->view('admin/dashboard', $data);
	}
	
	
}
