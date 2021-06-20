<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AuthModel extends CI_Model
{
    public function cekLogin($username, $password)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        if ($query->num_rows() > 0) {
            $hash = $query->row('password');
            if (password_verify($password, $hash)) {
                return $query->result_array();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}
