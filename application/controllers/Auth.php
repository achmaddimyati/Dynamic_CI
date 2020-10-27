<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user_model');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->user_model->get_user($email);

        if (!$user) {
            //jika user tidak ada
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email has not been registered</div>');
            redirect('auth');
        } else {
            //jika user tidak aktif
            if (!$user['is_active'] == 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email has not been activated</div>');
                redirect('auth');
            } else {
                //jika user aktif
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else { //jika user tidak cocok password nya
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password</div>');
                    redirect('auth');
                }
            }
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'This email has been used']);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'password dont match !', 'min_length' => 'password too short !']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $name = htmlspecialchars($this->input->post('name', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

            $data = [
                'name' => $name,
                'email' => $email,
                'image' => 'default.jpg',
                'password' => $password,
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->user_model->save($data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulations Your Account has been created. Please Login</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out !</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['title'] = 'Access blocked';
        $this->load->view('auth/blocked', $data);
    }
}
