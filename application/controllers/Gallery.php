<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('gallery_model');
		$this->load->model('category_model');		
        $this->load->helper('form');
		$this->load->helper('text');		
		$this->load->library('image_uploader');
        $this->load->library('form_validation');
		$this->load->library('pagination');
    }

    public function index($per_page = 20, $offset = 0)
    {
		$category_id = 0;
		$category = $this->input->get('category', true);
		if(!empty($category)){
			$category_obj = $this->category_model->get_category_by_name($category);
			$category_id = $category_obj->id;
		}
		
        $data = $this->seo_model->get_seo('gallery');
		$data['categories'] = $this->category_model->get_all_categories();
		
		$total_gallery_images = $this->gallery_model->count_all_images($category_id, 0, 'active');
		$data['gallery_images'] = $this->gallery_model->get_all_images($category_id, 0, 'active', $per_page, $offset);
		
		/*************************/
		$config['base_url'] = site_url('gallery/'.$per_page.'/');
		$config['uri_segment'] = 3;
		$config['total_rows'] = $total_gallery_images;
		$config['per_page'] = $per_page;
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
		/*************************/
		
        $this->load->view('gallery/show_gallery', $data);
    }

    public function show_image()
    {
		$image_id = $this->input->post('id', true);
        $image = $this->gallery_model->get_image($image_id);
		
		$modal = '
		<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">'.$image->title.'</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="" src="'.base_url('assets/uploads/gallery_images/' . $image->image_name).'" title="'.$image->title.'" alt="'.$image->title.'" width="100%" /><p>'.$image->description.'</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>';
		
		echo $modal;
    }

    public function delete_image($image_id)
    {
        $this->gallery_model->delete_image($image_id);
		set_success_flashdata('Image deleted successfully');
        redirect('/gallery/');
    }

    public function add_image()
    {
		verify_site_user(uri_string());

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('category_id', 'Category', 'required', array('required'=>'Please select %s')); 
        if (empty($_FILES['image_name']['name'])) {
            $this->form_validation->set_rules('image_name', 'Image', 'required');
        }


        if ($this->form_validation->run() === FALSE) {
			$data = $this->seo_model->get_seo('add-image');
			$data['categories'] = $this->category_model->get_all_categories();
            $this->load->view('site_user/add_image', $data);
        } else {
            $new_name_for_image = url_title($this->input->post("title"), 'dash', true);
            $image_name = $this->image_uploader->do_upload('image_name', $new_name_for_image, 'assets/uploads/gallery_images');

            $data = array(
                'title' => $this->input->post("title", true),
                'description' => $this->input->post("description", true),
				'category_id' => $this->input->post("category_id", true),
				'user_id' => get_site_user_id()
            );
            if (!empty($image_name)) {
                $data['image_name'] = $image_name;
            }
            $image_id = $this->gallery_model->insert_image($data);
			set_success_flashdata('Image added successfully');
            redirect('/edit-image/' . $image_id, 'refresh');
        }
    }

    public function edit_image($image_id)
    {
		verify_site_user(uri_string());
		
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('category_id', 'Category', 'required', array('required'=>'Please select %s'));        

        if ($this->form_validation->run() === FALSE) {
			$data = $this->seo_model->get_seo('edit-image');
			$data['categories'] = $this->category_model->get_all_categories();
            $data['image'] = $this->gallery_model->get_image($image_id);
            $this->load->view('site_user/edit_image', $data);
        } else {
            $new_name_for_image = url_title($this->input->post("title"), 'dash', true);
            $image_name = $this->image_uploader->do_upload('image_name', $new_name_for_image, 'assets/uploads/gallery_images');						

            $data = array(
                'title' => $this->input->post("title", true),
                'description' => $this->input->post("description", true),
				'category_id' => $this->input->post("category_id", true),
				'user_id' => get_site_user_id()
            );
            if (!empty($image_name)) {
				$this->gallery_model->unlink_image($image_id);
                $data['image_name'] = $image_name;
            }
            $this->gallery_model->update_image($image_id, $data);
			set_success_flashdata('Image updated successfully');
            redirect('/edit-image/' . $image_id, 'refresh');
        }
    }

}
