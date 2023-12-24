<?php

class Model_content extends CI_model
{

    public function get()
    {
        return $this->db->get('edukasi');
    }
    public function getId($id)
    {
        return $this->db->get_where('edukasi', ['id' => $id])->row_array();
    }
    public function add($data)
    {
        return $this->db->insert('edukasi', $data);
    }
    public function up($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('edukasi', $data);
    }
    public function update($data, $where)
    {
        $this->db->update('edukasi', $data, $where);
    }
    public function del($id)
    {
        $this->db->where('id', $id);
        $del = $this->db->delete('edukasi');
        return $del;
    }

}