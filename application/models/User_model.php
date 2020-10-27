<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function get_user($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }

    public function save($data)
    {
        return $this->db->insert('user', $data);
    }

    public function update($data, $email)
    {
        return $this->db->update('user', $data, ['email' => $email]);
    }
}
