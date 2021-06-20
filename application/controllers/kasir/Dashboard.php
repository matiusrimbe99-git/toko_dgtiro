<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data = $this->UserModel->get_session($this->session->userdata('nama'));
        $data['title'] = 'Sistem Kasir Dg. Tiro';

        $this->load->view('templates_kasir/header',$data);
        $this->load->view('templates_kasir/sidebar');
        $this->load->view('templates_kasir/navbar',$data);
        $this->load->view('kasir/dashboard');
        $this->load->view('templates_kasir/footer');

    }

    
}
