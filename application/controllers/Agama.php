<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agama extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('agama_model');
        $this->load->model('user_model');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);
        $data['title'] = 'List Agama';
        $data['agama'] = $this->agama_model->get_agama();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('category/agama', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $post = $this->input->post();
        $validation = $this->form_validation;

        $validation->set_rules('agama', 'Agama', 'required');
        if ($validation->run() == FALSE) {
            $errors = $validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('input', $post);
            redirect('agama');
        } else {
            $agama = $post['agama'];
            $data = array(
                'agama' => $agama
            );
            $agama = $this->agama_model;
            $insert = $agama->save($data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Agama has been added</div>');
                redirect('agama');
            }
        }
    }

    public function edit($id_agama = null)
    {
        if (!isset($id_agama)) redirect('agama');

        $post = $this->input->post();
        $validation = $this->form_validation;

        $validation->set_rules('agama', 'Agama', 'required');
        if ($validation->run() == FALSE) {
            $errors = $validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('input', $post);

            $agama = $this->agama_model;
            $email = $this->session->userdata('email');
            $data['user'] = $this->user_model->get_user($email);
            $data['title'] = 'Edit Agama';
            $data['agama'] = $agama->get_one($id_agama);
            if (!$data['agama']) show_404();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('agama/edit_agama', $data);
            $this->load->view('templates/footer');
        } else {
            $id_agama = $post['id_agama'];
            $agama = $post['agama'];

            $data = array(
                'id_agama' => $id_agama,
                'agama' => $agama
            );
            $agama = $this->agama_model;
            $update = $agama->update($data, $id_agama);

            if ($update) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">An Agama has been edited</div>');
                redirect('agama');
            }
        }
    }

    public function delete($id_agama = null)
    {
        if (!isset($id_agama)) show_404();

        if ($this->agama_model->delete($id_agama)) {
            redirect(site_url('agama'));
        }
    }
}
