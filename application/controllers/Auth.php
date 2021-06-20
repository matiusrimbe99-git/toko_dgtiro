<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('login');
    }

    public function login_aksi()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('auth');
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);
            $cek_login = $this->AuthModel->cekLogin($username, $password);

            if ($cek_login == TRUE) {
                //jika akun login cocok
                foreach ($cek_login as $cek) {
                    $sess_data['logged_in'] = TRUE;
                    $sess_data['id'] = $cek['id'];
                    $sess_data['username'] = $cek['username'];
                    $sess_data['nama'] = $cek['nama'];
                    $sess_data['level'] = $cek['level'];
                    $this->session->set_userdata($sess_data);
                }
                //cek level
                if ($sess_data['level'] == 'admin') {
                    //jika level admin cocok
                    redirect('administrator/dashboard');
                }

                if ($sess_data['level'] == 'kasir') {
                    redirect('kasir/dashboard');
                }
            } else {
                //jika akun login tidak cocok
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Username atau Password Anda salah.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
