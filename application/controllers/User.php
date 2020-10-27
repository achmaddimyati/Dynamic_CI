<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('agama_model');
        $this->load->model('jurusan_model');
        is_logged_in();
    }

    public function index()
    {

        $data['title'] = 'My Profile';
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);
        $data['agama'] = $this->agama_model->get_agama();
        $data['jurusan'] = $this->jurusan_model->get_jurusan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $email = $this->session->userdata('email');
        $data['user'] = $this->user_model->get_user($email);
        $data['agama'] = $this->agama_model->get_agama();
        $data['jurusan'] = $this->jurusan_model->get_jurusan();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {

            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $kd_agama = $this->input->post('kd_agama');
            $kd_jurusan = $this->input->post('kd_jurusan');
            $data = [
                'name' => $name,
                'email' => $email,
                'kd_agama' => $kd_agama,
                'kd_jurusan' => $kd_jurusan
            ];

            //cek jika ada gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '4048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->user_model->update($data, $email);


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated</div>');
            redirect('user');
        }
    }
}
