<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{
    public function get_all_data()
    {
        return $this->db->get('edukasi')->result_array();
    }

    public function get_data($id)
    {
        return $this->db->get_where('edukasi', array('id' => $id))->row_array();
    }

    public function create_data($data)
    {
        $this->db->insert('edukasi', $data);
    }

    public function update_data($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('edukasi', $data);
    }

    public function delete_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('edukasi');
    }
}