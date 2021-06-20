<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        session_level();
    }

    public function index()
    {
        $data = $this->UserModel->get_session($this->session->userdata('nama'));
        $data['title'] = 'Sistem Kasir Dg. Tiro';

        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar',$data);
        $this->load->view('administrator/dashboard');
        $this->load->view('templates/footer');

    }

    
}
