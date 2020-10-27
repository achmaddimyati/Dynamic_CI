<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('menu_model');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);
        $data['menu'] = $this->menu_model->get_all_menu();


        $this->form_validation->set_rules('menu', 'Menu', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $menu = $this->input->post('menu');
            $this->menu_model->save($menu);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu has been added</div>');
            redirect('menu');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Menu';
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);
        $data['menu'] = $this->menu_model->get_menu($id);


        $this->form_validation->set_rules('menu', 'Menu', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $menu = $this->input->post('menu');
            $data = [
                'id' => $id,
                'menu' => $menu
            ];
            $this->menu_model->update($data, $id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu has been edited !</div>');
            redirect('menu');
        }
    }

    public function delete($id)
    {
        $menu = $this->menu_model->get_menu($id);
        $this->menu_model->delete($menu, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu has been deleted !</div>');
        redirect('menu');
    }

    public function subMenu()
    {
        $data['title'] = 'Sub Menu Management';
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);

        $data['subMenu'] = $this->menu_model->getSubMenu();
        $data['menu'] = $this->menu_model->get_all_menu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $title = $this->input->post('title');
            $menu_id = $this->input->post('menu_id');
            $url = $this->input->post('url');
            $icon = $this->input->post('icon');
            $is_active = $this->input->post('is_active');

            $data = [
                'title' => $title,
                'menu_id' => $menu_id,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $is_active
            ];

            $this->menu_model->save_sub($data);
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Menu has been added</div>');
            redirect('menu/submenu');
        }
    }

    public function edit_sub($id)
    {
        $data['title'] = 'Edit Sub Menu';
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);

        $data['submenu'] = $this->menu_model->get_sub($id);
        $data['menu'] = $this->menu_model->get_all_menu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_sub', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $title = $this->input->post('title');
            $menu_id = $this->input->post('menu_id');
            $url = $this->input->post('url');
            $icon = $this->input->post('icon');
            $is_active = $this->input->post('is_active');

            $data = [
                'id' => $id,
                'title' => $title,
                'menu_id' => $menu_id,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $is_active
            ];

            $this->menu_model->update_sub($data, $id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Submenu has been edited</div>');
            redirect('menu/submenu');
        }
    }

    public function delete_sub($id)
    {
        $submenu = $this->menu_model->get_sub($id);
        $this->menu_model->delete_sub($submenu, $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu has been deleted !</div>');
        redirect('menu/submenu');
    }
}
