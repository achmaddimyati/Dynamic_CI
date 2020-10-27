<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agama_model extends CI_model
{
    private $_table = "agama";

    public function get_agama()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function get_one($id_agama)
    {
        return $this->db->get_where($this->_table, ['id_agama' => $id_agama])->row_array();
    }

    public function save($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function update($data, $id_agama)
    {
        return $this->db->update($this->_table, $data, array('id_agama' => $id_agama));
    }

    public function delete($id_agama)
    {
        return $this->db->delete($this->_table, array('id_agama' => $id_agama));
    }
}
