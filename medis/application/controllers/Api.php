<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';
use chriskacerguis\RestServer\RestController;

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_model'); // Buatlah model untuk mengelola data
    }

    public function index()
    {
        echo "Welcome to the API!";
    }
    

    public function get_data($id = NULL)
{
    $response = array();

    if ($id === NULL) {
        $data = $this->api_model->get_all_data();
        if (!empty($data)) {
            $response['status'] = 'success';
            $response['message'] = 'Data retrieved successfully';
            $response['data'] = $data;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'No data found';
        }
    } else {
        $data = $this->api_model->get_data($id);
        if (!empty($data)) {
            $response['status'] = 'success';
            $response['message'] = 'Data retrieved successfully';
            $response['data'] = $data;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Data not found';
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}


    public function create_data()
    {
        $title = $this->input->post('title');
        $desc = $this->input->post('desc');

        // Proses upload gambar dan dapatkan namanya
        $img = $this->_upload_image();

        $data = array(
            'title' => $title,
            'desc' => $desc,
            'img' => $img
        );

        $this->api_model->create_data($data);

        echo "Data created successfully.";
    }

    public function update_data($id)
    {
        // // Ambil data lama berdasarkan ID
        // $old_data = $this->api_model->get_data($id);

        // $title = $this->input->put('title');
        // $desc = $this->input->put('desc');
        // Ambil data lama berdasarkan ID
        $old_data = $this->api_model->get_data($id);

        // Ambil data yang dikirim melalui metode PUT
        parse_str(file_get_contents("php://input"), $put_data);

        // Ambil data yang diperlukan
        $title = isset($put_data['title']) ? $put_data['title'] : $old_data['title'];
        $desc = isset($put_data['desc']) ? $put_data['desc'] : $old_data['desc'];


        // Periksa apakah ada upload gambar baru
        $img = $old_data['img'];
        if ($_FILES['img']['error'] == 0) {
            // Hapus gambar lama
            if ($old_data['img'] != NULL) {
                unlink('./assets/img/content/' . $old_data['img']);
            }
            // Proses upload gambar baru
            $img = $this->_upload_image();
        }

        $data = array(
            'title' => $title,
            'desc' => $desc,
            'img' => $img
        );

        $this->api_model->update_data($id, $data);

        echo "Data updated successfully.";
    }

    public function delete_data($id)
    {
        // Hapus gambar terkait jika ada
        $data = $this->api_model->get_data($id);
        if ($data['img'] != NULL) {
            unlink('./assets/img/content/' . $data['img']);
        }

        $this->api_model->delete_data($id);

        echo "Data deleted successfully.";
    }

    // Fungsi internal untuk upload gambar
    private function _upload_image()
    {
        $config['upload_path'] = './assets/img/content/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('img')) {
            echo $this->upload->display_errors();
            die();
        } else {
            return $this->upload->data('file_name');
        }
    }
}