<?php

class Model_auth extends CI_Model
{
    function cek($data)
    {
        $query = $this->db->get_where('users', $data);
        return $query;
    }

    function login($email, $password)
    {
        $query = $this->db->get_where('users', ['email' => $email, 'password' => $password]);
        return $query;
    }

    public function register_user($data)
    {
        return $this->db->insert('users', $data);
    }
}