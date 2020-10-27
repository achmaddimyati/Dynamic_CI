<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uam_model extends CI_Model
{
    public function get_uam($data)
    {
        return $this->db->get_where('user_access_menu', $data);
    }

    public function save($data)
    {
        return $this->db->insert('user_access_menu', $data);
    }

    public function delete($data)
    {
        $this->db->delete('user_access_menu', $data);
    }
}
