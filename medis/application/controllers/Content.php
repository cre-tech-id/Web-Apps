<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_content');
    }
    public function index()
    {
        $data['content'] = $this->Model_content->get()->result();
        $this->load->view('template/header');
        $this->load->view('content/index', $data);
        // $this->load->view('template/a');
        $this->load->view('template/footer');
    }
    public function up($id)
    {
        $data['content'] = $this->Model_content->getId($id);
        $this->load->view('template/header');
        $this->load->view('content/update', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $this->load->view('template/header');
        $this->load->view('content/add');
        $this->load->view('template/footer');
    }
    public function insert()
    {
        $config['upload_path'] = './assets/img/content';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('img')) { //jika gagal

            $title = $this->input->post('title');
            $desc = $this->input->post('desc');

            $data = array(
                'title' => $title,
                'desc' => $desc
            );
            $this->Model_content->add($data);
            redirect(base_url('content/index'));
        } else { //jika berhasil

            $data = $this->upload->data();
            $fileName = $data['file_name'];
            $title = $this->input->post('title');
            $desc = $this->input->post('desc');

            $data = array(
                'title' => $title,
                'desc' => $desc,
                'img' => $fileName
            );

            $this->Model_content->add($data);

            redirect(base_url('content'));
        }
    }

    public function hapus($id)
    {
        $this->Model_content->del($id); //menghapus data
        redirect(base_url('content')); //mengalihkan ke tampbali
    }

    public function ubah($id)
    {

        $data = array(
            'title' => $this->input->post('title'),
            'desc' => $this->input->post('desc')
            // 'img' => $this->input->post('img')
        );
        $this->Model_content->up($id, $data);
        redirect(base_url('content'));


    }

    public function update()
    {
        $id = $this->uri->segment(3);

        $config['upload_path'] = './assets/img/content/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 3000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('img')) {
            echo 'anda belum upload';
        } else {
            //tampung data dari form
            $title = $this->input->post('title');
            $desc = $this->input->post('desc');
            $file = $this->upload->data();
            $img = $file['file_name'];

            $this->Model_content->update(
                array(
                    'title' => $title,
                    'desc' => $desc,
                    'img' => $img
                ),
                array(
                    'id' => $this->input->post('id')
                )
            );
            $this->session->set_flashdata('msg', 'data berhasil di update');
            redirect('content');
        }

    }

}