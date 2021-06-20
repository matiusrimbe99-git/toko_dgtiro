<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        session_level();
    }

    public function index()
    {
        $data['title'] = 'Kategori - Sistem Kasir Dg. Tiro';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar', $data);
        $this->load->view('administrator/kategori/index', $data);
        $this->load->view('templates/footer');
    }

    public function data_kategori() {
        $list = $this->KategoriModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kategori) {
            $no++;
            $row = array();
            $row[] = "<center>".$no."</center>";
            $row[] = "<center>".$kategori['kategori']. "</center>";
            $row[] = "<center>".$this->KategoriModel->count_product($kategori['id_kategori']). "</center>";

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kategori(' . "'" . $kategori['id_kategori'] . "'" . ')"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_kategori(' . "'" . $kategori['id_kategori'] . "'" . ')"><i class="fas fa-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->KategoriModel->count_all(),
            "recordsFiltered" => $this->KategoriModel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function tambah()
    {
        $data = array(
            'kategori' => $this->input->post('kategori',TRUE),
        );

        $insert = $this->KategoriModel->simpan_data($data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit($id)
    {
        $data = $this->KategoriModel->tampil_data_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $data = array(
            'kategori' => $this->input->post('kategori',TRUE),
        );
        $this->KategoriModel->update_data(array('id_kategori' => $this->input->post('id_kategori',TRUE)), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus($id)
    {
        $this->KategoriModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    
}
