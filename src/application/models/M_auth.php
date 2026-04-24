<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// 532E48647974
class M_auth extends CI_Model {

    public function cek_login($username)
    {   
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }
}