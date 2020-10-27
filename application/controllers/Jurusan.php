<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('jurusan_model');
        $this->load->model('user_model');
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);
        $data['title'] = 'List Jurusan';
        $data['jurusan'] = $this->jurusan_model->get_jurusan();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('category/jurusan', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $post = $this->input->post();
        $validation = $this->form_validation;

        $validation->set_rules('nama_jurusan', 'jurusan', 'required');
        if ($validation->run() == FALSE) {
            $errors = $validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('input', $post);
            redirect('jurusan');
        } else {
            $jurusan = $post['nama_jurusan'];
            $data = array(
                'nama_jurusan' => $jurusan
            );

            $jurusan = $this->jurusan_model;
            $insert = $jurusan->save($data);

            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Jurusan has been added</div>');
                redirect('jurusan');
            }
        }
    }

    public function edit($id_jurusan = null)
    {
        if (!isset($id_jurusan)) redirect('jurusan');

        $post = $this->input->post();
        $validation = $this->form_validation;

        $validation->set_rules('nama_jurusan', 'Jurusan', 'required');
        if ($validation->run() == FALSE) {
            $errors = $validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('input', $post);

            $jurusan = $this->jurusan_model;
            $email = $this->session->userdata('email');
            $data['user'] = $this->user_model->get_user($email);
            $data['title'] = 'Edit Jurusan';
            $data['jurusan'] = $jurusan->get_one($id_jurusan);
            if (!$data['jurusan']) show_404();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('jurusan/edit_jurusan', $data);
            $this->load->view('templates/footer');
        } else {
            $id_jurusan = $post['id_jurusan'];
            $jurusan = $post['nama_jurusan'];

            $data = array(
                'id_jurusan' => $id_jurusan,
                'nama_jurusan' => $jurusan
            );
            $jurusan = $this->jurusan_model;
            $update = $jurusan->update($data, $id_jurusan);

            if ($update) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">A Jurusan has been edited</div>');
                redirect('jurusan');
            }
        }
    }

    public function delete($id_jurusan = null)
    {
        if (!isset($id_jurusan)) show_404();

        if ($this->jurusan_model->delete($id_jurusan)) {
            redirect(site_url('jurusan'));
        }
    }
}
