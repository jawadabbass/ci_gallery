<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model
{

    public $table_name = 'categories';

    public function __construct()
    {
        $this->load->database();
		$this->load->library('datatables');
    }

    public function total_categories()
    {
        $this->db->select('id');
        $this->db->from($this->table_name);
        $query = $this->db->get();
        $return = $query->num_rows();

        $query->free_result();
        return $return;
    }
	
	
	public function get_category($id)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->row();
        } else {
            $return = 0;
        }

        $query->free_result();
        return $return;
    }
	
	public function get_category_by_name($category)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->like('category', $category);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->row();
        } else {
            $return = 0;
        }

        $query->free_result();
        return $return;
    }

    public function get_all_categories()
    {
		
        $this->db->from($this->table_name);
        $this->db->order_by('category', 'ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->result();
        } else {
            $return = 0;
        }

        $query->free_result();
        return $return;
    }
	
	public function get_all_categories_for_datatable($id = 0, $category = '')
    {
        $this->datatables->select('id, category');
		
        $this->datatables->from($this->table_name);
		
		if($id > 0){
			$this->datatables->where('id', $id);
		}
		if(!empty($category)){
			$this->datatables->like('category', $category);
		}
		
		$this->datatables->add_column('edit_delete', '<a class="btn btn-warning btn-xs" href="'.site_url().'admin/edit-category/$1">EDIT</a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger btn-xs" href="javascript:;" onclick="delete_category($1)">DELETE</a>', 'id');        
        $results = $this->datatables->generate();
        
		//$data['aaData'] = $results['aaData'];
		//$data['sColumns'] = $results['sColumns'];
        
        return $results;
    }

    public function insert_category($data)
    {
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }

    public function update_category($id, $data)
    {
        $this->db->update($this->table_name, $data, array('id' => $id));
    }

    public function delete_category($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);     
    }
}
