<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_user_model extends CI_Model
{

    public $table_name = 'admin_user';

    public function __construct()
    {
        $this->load->database();
    }
	
    public function get_admin_user_by_email($email)
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
	
	
	public function get_admin_user($admin_user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where('id', $admin_user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $return = $query->row();
        } else {
            $return = 0;
        }

        $query->free_result();
        return $return;
    }    

    public function update_admin_user($id, $data)
    {
        $this->db->update($this->table_name, $data, array('id' => $id));
    }    

}
