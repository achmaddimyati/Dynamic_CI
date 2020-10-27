<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function get_all_menu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function get_menu($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }

    public function get_all_menux()
    {
        $this->db->where('id !=', 1);
        return $this->db->get('user_menu')->result_array();
    }

    public function save($menu)
    {
        return $this->db->insert('user_menu', ['menu' => $menu]);
    }

    public function update($data, $id)
    {
        return $this->db->update('user_menu', $data, ['id' => $id]);
    }

    public function delete($menu, $id)
    {
        return $this->db->delete('user_menu', $menu, ['id' => $id]);
    }

    public function get_sub($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function save_sub($data)
    {
        $this->db->insert('user_sub_menu', $data);
    }

    public function update_sub($data, $id)
    {
        return $this->db->update('user_sub_menu', $data, ['id' => $id]);
    }

    public function delete_sub($submenu, $id)
    {
        return $this->db->delete('user_sub_menu', $submenu, ['id' => $id]);
    }

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                ";

        return $this->db->query($query)->result_array();
    }
}
