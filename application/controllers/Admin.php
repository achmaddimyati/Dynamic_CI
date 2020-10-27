<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('role_model');
        $this->load->model('menu_model');
        $this->load->model('uam_model');
        is_logged_in();
    }

    public function index()
    {

        $data['title'] = 'Dashboard';
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {

        $data['title'] = 'Role';
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);

        $data['role'] = $this->role_model->get_all_role();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($role_id)
    {

        $data['title'] = 'Role';
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);

        $data['role'] = $this->role_model->get_role($role_id);
        $data['menu'] = $this->menu_model->get_all_menux();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->uam_model->get_uam($data);

        if ($result->num_rows() < 1) {
            $this->uam_model->save($data);
        } else {
            $this->uam_model->delete($data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed !</div>');
    }
}
