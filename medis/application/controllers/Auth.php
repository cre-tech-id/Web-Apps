<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_auth');
        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('index');
        }
        $this->load->view('auth/signin');
    }
    public function signup()
    {
        if ($this->session->userdata('email')) {
            redirect('index');
        }
        $this->load->view('auth/signup');
    }

    public function login()
    {
        $data = array(

            'email' => $this->input->post('email', TRUE),
            'password' => md5($this->input->post('password', TRUE))
        );
        $this->load->model('Model_auth');
        $hasil = $this->Model_auth->cek($data);

        if ($hasil->num_rows() == 1) {
            foreach ($hasil->result() as $sess) {
                $sess_data['logged_in'] = 'Sudah Loggin';
                $sess_data['email'] = $sess->email;
                $this->session->set_userdata($sess_data);
                redirect('content');
            }
        } else {
            echo "<script>alert('Gagal login: Cek username, password!');history.go(-1);</script>";
        }
    }
    public function signout()
    {
        $this->session->unset_userdata('email');
        session_destroy();
        redirect('auth');
    }

    public function register()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/signup');
        } else {
            $data = array(
                'email' => $this->input->post('email', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'password' => md5($this->input->post('password', TRUE))
            );

            $result = $this->model_auth->register_user($data);

            if ($result) {
                redirect('auth');
            } else {
                echo "<script>alert('Gagal registrasi!');history.go(-1);</script>";
            }
        }
    }
}