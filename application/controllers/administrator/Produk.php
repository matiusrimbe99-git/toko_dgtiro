<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        session_level();
    }

    public function index()
    {
        $data['title'] = 'Produk - Sistem Kasir Dg. Tiro';
        $data['categories'] = $this->KategoriModel->tampil_data();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar', $data);
        $this->load->view('administrator/produk/index', $data);
        $this->load->view('templates/footer');
        
    }

    public function cek_harga() {
        $data['title'] = 'Cek Harga Produk - Sistem Kasir Dg. Tiro';
        $data['produk'] = $this->TransaksiModel->tampil_data();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar', $data);
        $this->load->view('administrator/produk/cek_harga', $data);
        $this->load->view('templates/footer');
    }

    public function data_produk()
    {
        $list = $this->ProdukModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $produk) {
            $no++;
            $row = array();
            $row[] = "<center>".$no. "</center>";
            $row[] = "<center>".$produk['kode_produk']. "</center>";
            $row[] = $produk['nama_produk'];
            $row[] = "<center>". $produk['stok']. "</center>";
            $row[] = "<center>".$produk['satuan']. "</center>";
            $row[] = "<center>" . $produk['kategori']."</center>";
            $row[] = "Rp. ". number_format($produk['harga_beli'],2,',','.');
            $row[] = "Rp. " . number_format($produk['harga_umum'], 2, ',', '.');
            $row[] = "Rp. " . number_format($produk['harga_langganan'], 2, ',', '.');

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_produk(' . "'" . $produk['id_produk'] . "'" . ')"><i class="fas fa-edit"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_produk(' . "'" . $produk['id_produk'] . "'" . ')"><i class="fas fa-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ProdukModel->count_all(),
            "recordsFiltered" => $this->ProdukModel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function tambah()
    {
        $data = array(
            'kode_produk' => $this->input->post('kode_produk', TRUE),
            'nama_produk' => $this->input->post('nama_produk', TRUE),
            'stok' => $this->input->post('stok', TRUE),
            'satuan' => $this->input->post('satuan', TRUE),
            'id_kategori' => $this->input->post('id_kategori', TRUE),
            'harga_beli' => $this->input->post('harga_beli', TRUE),
            'harga_umum' => $this->input->post('harga_umum', TRUE),
            'harga_langganan' => $this->input->post('harga_langganan', TRUE),
        );

        $insert = $this->ProdukModel->simpan_data($data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit($id)
    {
        $data = $this->ProdukModel->tampil_data_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $data = array(
            'kode_produk' => $this->input->post('kode_produk', TRUE),
            'nama_produk' => $this->input->post('nama_produk', TRUE),
            'stok' => $this->input->post('stok', TRUE),
            'satuan' => $this->input->post('satuan', TRUE),
            'id_kategori' => $this->input->post('id_kategori', TRUE),
            'harga_beli' => $this->input->post('harga_beli', TRUE),
            'harga_umum' => $this->input->post('harga_umum', TRUE),
            'harga_langganan' => $this->input->post('harga_langganan', TRUE),
        );
        $this->ProdukModel->update_data(array('id_produk' => $this->input->post('id_produk', TRUE)), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus($id)
    {
        $this->ProdukModel->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
}
