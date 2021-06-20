<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        session_level();
    }

    public function index()
    {
        $data['title'] = 'User - Sistem Kasir Dg. Tiro';
        $data['categories'] = $this->KategoriModel->tampil_data();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar', $data);
        $this->load->view('administrator/user/index', $data);
        $this->load->view('templates/footer');
    }

    public function data_user()
    {
        $list = $this->UserModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();
            $row[] = "<center>" . $no . "</center>";
            $row[] = "<center>" . $user['nama'] . "</center>";
            $row[] = "<center>" . $user['username'] . "</center>";
            $row[] = "<center>" . $user['telepon'] . "</center>";
            $row[] = "<center>" . $user['level'] . "</center>";

            //add html for action
            $row[] = "<center>" .  '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user(' . "'" . $user['id'] . "'" . ')"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_user(' . "'" . $user['id'] . "'" . ')"><i class="fas fa-trash"></i></a>' . "</center>";

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->UserModel->count_all(),
            "recordsFiltered" => $this->UserModel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function tambah()
    {
        $data = array(
            'nama' => $nama = $this->input->post('nama', TRUE),
            'username' => url_title(strtolower($nama)),
            'telepon' => $this->input->post('telepon', TRUE),
            'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
            'level' => $this->input->post('level', TRUE),
        );

        $insert = $this->UserModel->simpan_data($data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit($id)
    {
        $data = $this->UserModel->tampil_data_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $data = array(
            'nama' => $nama = $this->input->post('nama', TRUE),
            'username' => url_title(strtolower($nama)),
            'telepon' => $this->input->post('telepon', TRUE),
            // 'password' => password_hash($this->input->post('password', TRUE), PASSWORD_BCRYPT),
            'level' => $this->input->post('level', TRUE),
        );
        $this->UserModel->update_data(array('id' => $this->input->post('id', TRUE)), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus($id)
    {
        $this->UserModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
}
