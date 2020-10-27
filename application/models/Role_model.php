<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_Model extends CI_Model
{
    public function get_all_role()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function get_role($role_id)
    {
        return $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    }
}
