<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_user extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		verify_admin_user(uri_string());
		$this->load->model('site_user_model');
		$this->load->library('pagination');
    }

    public function index()
    {		
		$this->load->view('admin/site_user/list_site_users');
    }		
	
	public function load_datatable()
    {	
		$email = $this->input->post('email', TRUE);
		$full_name = $this->input->post('full_name', TRUE);
		
		$site_users = $this->site_user_model->get_all_site_users_for_datatable($email, $full_name);		
        echo $site_users;
    }
    

    public function delete_site_user()
    {
		$id = $this->input->post('id', TRUE);
        $this->site_user_model->delete_site_user($id);
		echo 1;
    }
	
	public function update_status_ajax()
    {
		$id = $this->input->post('id', TRUE);
		$status = $this->input->post('status', TRUE);
		
		$new_status = ($status == 'active')? 'inactive':'active';
		
        $this->site_user_model->update_site_user($id, array('status'=>$new_status));
		echo 1;
    }
	
	
	/***********************************************************
	Function being used in simple listings
	with out ajax data tables
	***********************************************************/
	
	public function list_site_users($per_page = 20, $offset = 0)
    {
		$email = $this->input->get('email', TRUE);
		$full_name = $this->input->get('full_name', TRUE);				
		
		$total_site_users = $this->site_user_model->count_all_site_users($email, $full_name, '');
		$data['site_users'] = $this->site_user_model->get_all_site_users_paging($email, $full_name, '', $per_page, $offset);
		
		/*************************/
		$config['base_url'] = site_url('admin/list-site-users/'.$per_page.'/');
		$config['uri_segment'] = 4;
		$config['total_rows'] = $total_site_users;
		$config['per_page'] = $per_page;
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);
		/*************************/				
		
		$this->load->view('admin/site_user/list_site_users_simple', $data);
    }
	
	public function update_status($id, $status)
    {		
		$new_status = ($status == 'active')? 'inactive':'active';
		
        $this->site_user_model->update_site_user($id, array('status'=>$new_status));
		set_success_flashdata('Site user status updated successfully');
		redirect('admin/list-site-users');
    }
	
	public function remove_site_user($id)
    {
        $this->site_user_model->delete_site_user($id);
		set_success_flashdata('Site user deleted successfully');
		redirect('admin/list-site-users');
    }

    
}
