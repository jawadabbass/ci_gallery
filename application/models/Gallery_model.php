<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery_model extends CI_Model
{

    public $table_name = 'gallery';
	public $category_table_name = 'categories';
	public $site_user_table_name = 'site_users';

    public function __construct()
    {
        $this->load->database();
		$this->load->library('datatables');
		$this->load->model('site_user_model');		
    }
	
	public function total_gallery_images()
    {
        $this->db->select('id');
        $this->db->from($this->table_name);
        $query = $this->db->get();
        $return = $query->num_rows();

        $query->free_result();
        return $return;
    }

    public function get_image($image_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('id', $image_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->row();
        } else {
            $return = 0;
        }

        $query->free_result();
        return $return;
    }

    public function count_all_images($category_id = 0, $user_id = 0, $status = '')
    {
		$site_users_array = array();
		if($status != ''){
			$site_users = $this->site_user_model->get_all_site_users('', '', $status);
			if($site_users){
				foreach($site_users as $site_user){
					$site_users_array[] = $site_user->id;
				}
			}
		}
		
        $this->db->select('id');
        $this->db->from($this->table_name);
		
		if($category_id > 0){
			$this->db->where('category_id', $category_id);
		}
		
		if($user_id > 0){
			$this->db->where('user_id', $user_id);
		}
		
		if($status != ''){
			$this->db->where('status', $status);
			$this->db->where_in('user_id', $site_users_array);
		}
		
		
        $query = $this->db->get();
        $return = $query->num_rows();
		
        $query->free_result();
        return $return;
    }
	
	public function get_all_images($category_id = 0, $user_id = 0, $status = '', $per_page = 20, $offset = 0)
    {
		$site_users_array = array();
		if($status != ''){
			$site_users = $this->site_user_model->get_all_site_users('','',$status);
			if($site_users){
				foreach($site_users as $site_user){
					$site_users_array[] = $site_user->id;
				}
			}
		}
		
        $this->db->select('*');
        $this->db->from($this->table_name);
		
		if($category_id > 0){
			$this->db->where('category_id', $category_id);
		}
		
		if($user_id > 0){
			$this->db->where('user_id', $user_id);
		}
		
		if($status != ''){
			$this->db->where('status', $status);
			$this->db->where_in('user_id', $site_users_array);
		}
		
		
        $this->db->order_by('category_id', 'ASC');
		$this->db->order_by('title', 'ASC');
		$this->db->limit($per_page, $offset);
		
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->result();
        } else {
            $return = 0;
        }

        $query->free_result();
        return $return;
    }    
	
	public function get_all_images_for_datatable($title = '', $description = '', $category_id = 0, $user_id = 0)
    {
        $this->datatables->select(
		"
		$this->table_name.id,
		$this->table_name.title,
		$this->table_name.description,
		$this->table_name.image_name,
		$this->table_name.status,
		$this->category_table_name.category,
		$this->site_user_table_name.full_name
		"
		);
		
        $this->datatables->from($this->table_name);
		$this->datatables->join($this->category_table_name, "$this->table_name.category_id = $this->category_table_name.id", 'left');
		
		$this->datatables->join($this->site_user_table_name, "$this->table_name.user_id = $this->site_user_table_name.id", 'left');
		
		if(!empty($title)){
			$this->datatables->like('title', $title);
		}
		if(!empty($description)){
			$this->datatables->like('description', $description);
		}
		if($category_id > 0){
			$this->datatables->where('category_id', $category_id);
		}
		if($user_id > 0){
			$this->datatables->where('user_id', $user_id);
		}				
		
		$this->datatables->add_column('image', '<img src="'.site_url().'assets/uploads/gallery_images/thumbs/$1" width="100px" />', 'image_name');		 
		
		$this->datatables->add_column('operations', '<a class="btn btn-success btn-xs" href="javascript:;" onclick="update_status($1, \'$2\');" data-status="$2" id="anchor_$1">Make Inactive</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger btn-xs" href="javascript:;" onclick="delete_image($1)">DELETE</a>', 'id,status'); 
		       
        $results = $this->datatables->generate();
        
		//$data['aaData'] = $results['aaData'];
		//$data['sColumns'] = $results['sColumns'];
        
        return $results;
    }

    public function insert_image($data)
    {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function update_image($id, $data)
    {
        $this->db->update($this->table_name, $data, array('id' => $id));
    }

    private function getImageName($id)
    {
        $image = $this->get_image($id);
        return $image->image_name;
    }

    public function delete_image($id, $image_name = '')
    {

        if ($image_name == '') {
            $image_name = $this->getImageName($id);
        }
        /*         * **************************************** */

        $this->db->where('id', $id);
        $this->db->delete($this->table_name);

        if ((bool) $this->db->affected_rows()) {
            $this->unlink_image($id, $image_name);
            return true;
        } else {
            return false;
        }
    }

    public function unlink_image($id, $image_name = '')
    {

        if ($image_name == '') {
            $image_name = $this->getImageName($id);
        }
        /*         * **************************************** */
        if ($image_name != '') {
            $main = realpath(APPPATH . '../assets/uploads/gallery_images/') . '/' . $image_name;
            $thumb = realpath(APPPATH . '../assets/uploads/gallery_images/thumbs/') . '/' . $image_name;
            unlink($main);
            unlink($thumb);
        }
    }

}
