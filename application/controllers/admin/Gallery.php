<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller
{

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
		$category_id = 0;
		$category = $this->input->get('category', true);
		if(!empty($category)){
			$category_obj = $this->category_model->get_category_by_name($category);
			$category_id = $category_obj->id;
		}
		
        $data = $this->seo_model->get_seo('gallery');
		$data['categories'] = $this->category_model->get_all_categories();
		$data['users'] = $this->site_user_model->get_all_site_users();
		$data['gallery_images'] = $this->gallery_model->get_all_images($category_id);
        $this->load->view('admin/gallery/list_gallery_images', $data);
    }
	
	public function load_datatable()
    {	
		$title = $this->input->post('title', TRUE);
		$description = $this->input->post('description', TRUE);
		$category_id = $this->input->post('category_id', TRUE);
		$user_id = $this->input->post('user_id', TRUE);
		
		$images = $this->gallery_model->get_all_images_for_datatable($title, $description, $category_id, $user_id);		
        echo $images;
    }
    

    public function delete_image()
    {
		$id = $this->input->post('id', TRUE);
        $this->gallery_model->delete_image($id);
		echo 1;
    }
	
	public function update_status()
    {
		$id = $this->input->post('id', TRUE);
		$status = $this->input->post('status', TRUE);
		
		$new_status = ($status == 'active')? 'inactive':'active';
		
        $this->gallery_model->update_image($id, array('status'=>$new_status));
		echo 1;
    }

    
}
