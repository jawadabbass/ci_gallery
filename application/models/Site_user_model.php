<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site_user_model extends CI_Model
{

    public $table_name = 'site_users';

    public function __construct()
    {
        $this->load->database();
		$this->load->library('datatables');
    }
	
	public function total_site_users()
    {
        $this->db->select('id');
        $this->db->from($this->table_name);
        $query = $this->db->get();
        $return = $query->num_rows();

        $query->free_result();
        return $return;
    }

    public function get_site_user_by_email($email)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->row();
        } else {
            $return = 0;
        }

        $query->free_result();
        return $return;
    }
	
	
	public function get_site_user($site_user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('id', $site_user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->row();
        } else {
            $return = 0;
        }

        $query->free_result();
        return $return;
    }
	
	public function get_all_site_users_for_datatable($email = '', $full_name = '')
    {
        $this->datatables->select(
		"
		$this->table_name.id,
		$this->table_name.email,
		$this->table_name.full_name,
		$this->table_name.image,
		$this->table_name.status
		"
		);
		
        $this->datatables->from($this->table_name);
		
		if(!empty($email)){
			$this->datatables->like('email', $email);
		}
		if(!empty($full_name)){
			$this->datatables->like('full_name', $full_name);
		}
		
		$this->datatables->add_column('image', '<img src="'.site_url().'assets/uploads/site_users_images/thumbs/$1" width="100px" />', 'image'); 
		
		$this->datatables->add_column('operations', '<a class="btn btn-success btn-xs" href="javascript:;" onclick="update_status($1, \'$2\');" data-status="$2" id="anchor_$1">Make Inactive</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger btn-xs" href="javascript:;" onclick="delete_site_user($1)">DELETE</a>', 'id, status');        
        $results = $this->datatables->generate();		
        
        return $results;
    }

    public function insert_site_user($data)
    {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function update_site_user($id, $data)
    {
        $this->db->update($this->table_name, $data, array('id' => $id));
    }

    private function getImageName($id)
    {
        $site_user = $this->get_site_user($id);
        return $site_user->image;
    }

    public function delete_site_user($id, $image_name = '')
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
            $main = realpath(APPPATH . '../assets/uploads/site_users_images/') . '/' . $image_name;
            $thumb = realpath(APPPATH . '../assets/uploads/site_users_images/thumbs/') . '/' . $image_name;
            unlink($main);
            unlink($thumb);
        }
    }		
	
	public function count_all_site_users($email = '', $full_name = '', $status = '')
    {
        $this->db->select('id');
        $this->db->from($this->table_name);
		
		if(!empty($email)){
			$this->datatables->like('email', $email);
		}
		
		if(!empty($full_name)){
			$this->datatables->like('full_name', $full_name);
		}
		
		if($status != ''){
			$this->db->where('status', $status);
		}	        
		
        $query = $this->db->get();
        $return = $query->num_rows();

        $query->free_result();
        return $return;
    }
	
	public function get_all_site_users($email = '', $full_name = '', $status = '')
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
		
		if(!empty($email)){
			$this->datatables->like('email', $email);
		}
		
		if(!empty($full_name)){
			$this->datatables->like('full_name', $full_name);
		}
		
		if($status != ''){
			$this->db->where('status', $status);
		}
		
        $this->db->order_by('id', 'ASC');
		
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->result();
        } else {
            $return = 0;
        }

        $query->free_result();
        return $return;
    }
	
	public function get_all_site_users_paging($email = '', $full_name = '', $status = '', $per_page = 20, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
		
		if(!empty($email)){
			$this->datatables->like('email', $email);
		}
		
		if(!empty($full_name)){
			$this->datatables->like('full_name', $full_name);
		}
		
		if($status != ''){
			$this->db->where('status', $status);
		}
		
        $this->db->order_by('id', 'ASC');
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

    

}
