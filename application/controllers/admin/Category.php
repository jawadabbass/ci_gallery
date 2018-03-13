<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		verify_admin_user(uri_string());        
		$this->load->model('category_model');		
        $this->load->helper('form');		
		$this->load->library('form_validation');        
    }

    public function index()
    {						
        $this->load->view('admin/category/list_categories');
    }
	
	public function load_datatable()
    {	
		$id = $this->input->post('id', TRUE);
		$category = $this->input->post('category', TRUE);
		
		$categories = $this->category_model->get_all_categories_for_datatable($id, $category);		
        echo $categories;
    }
    

    public function delete_category()
    {
		$id = $this->input->post('id', TRUE);
        $this->category_model->delete_category($id);
		echo 1;
    }

    public function add_category()
    {		
        $this->form_validation->set_rules('category', 'Category', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/category/add_category');
        } else {
            $data = array(
                'category' => $this->input->post("category", true)
            );
			
            $category_id = $this->category_model->insert_category($data);
			set_success_flashdata('Category added successfully');
            redirect('/admin/categories/', 'refresh');
        }
    }

    public function edit_category($category_id)
    {
        $this->form_validation->set_rules('category', 'Category', 'required');
		
        if ($this->form_validation->run() === FALSE) {
		    $data['category'] = $this->category_model->get_category($category_id);
            $this->load->view('admin/category/edit_category', $data);
        } else {
            $data = array(
                'category' => $this->input->post("category", true)
            );
            $this->category_model->update_category($category_id, $data);
			set_success_flashdata('Category updated successfully');
            redirect('/admin/categories/', 'refresh');
        }
    }

}
