<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_umum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Transaksi Umum - Sistem Kasir Dg. Tiro';
        $data['produk'] = $this->TransaksiModel->tampil_data();

        $this->load->view('templates_kasir/header', $data);
        $this->load->view('templates_kasir/sidebar');
        $this->load->view('templates_kasir/navbar', $data);
        $this->load->view('kasir/transaksi/umum', $data);
        $this->load->view('templates_kasir/footer');
    }

    public function data_transaksi()
    {
        $produk_cart = $this->cart->contents();
        $data = array();

        $no = $_POST['start'];
        foreach ($produk_cart as $item) {
            $row = array();
            $row[] = '<center>' . ++$no . '</center>';
            $row[] = '<center>' . $item['produk_id'] . '</center>';
            $row[] = $item['name'];
            $row[] = '<center>' . $item['qty'] . '</center>';
            $row[] = '<center>' . $item['satuan'] . '</center>';
            $row[] = "Rp. " . number_format($item['price'], 2, ',', '.');
            $row[] = "Rp. " . number_format($item['subtotal'], 2, ',', '.');

            $row[] = '<a class="btn btn-primary btn-xs" onclick="update_cart(' . "'" . $item['rowid'] . "'," . '' . "'" . $item['produk_id'] . "'" . ');"><i class="fas fa-edit"></i></a>
            	<a class="btn btn-danger btn-xs" onclick="hapus_cart(' . "'" . $item['rowid'] . "'," . '' . "'" . $item['produk_id'] . "'" . ');"><i class="fas fa-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ProdukModel->count_all(),
            "recordsFiltered" => $this->ProdukModel->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }


    public function data_produk()
    {
        $list = $this->ProdukModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $produk) {
            $no++;
            $row = array();
            $row[] = '<center>' . $produk['kode_produk'] . '</center>';
            $row[] = $produk['nama_produk'];
            $row[] = '<center>' . $produk['stok'] . '</center>';
            $row[] = '<center>' . $produk['satuan'] . '</center>';
            $row[] = "Rp. " . number_format($produk['harga_umum'], 2, ',', '.');


            $row[] = '<center>' . '<a class="btn btn-sm btn-success" id="' . $produk['kode_produk'] . '" onclick="add_cart_cari(' . $produk['kode_produk'] . ')" title="Tambahkan" data-kodeproduk="' . $produk['kode_produk'] . '" data-namaproduk="' . $produk['nama_produk'] . '" data-hargaumum=" '  . $produk['harga_umum'] .  '" data-satuan=" '  . $produk['satuan'] .  '" data-selltype=" ' . $produk['kode_produk'] . '-' . 'umum' .  '"><i class="fas fa-plus"></i></a>' . '</center>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ProdukModel->count_all(),
            "recordsFiltered" => $this->ProdukModel->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function get_data($id)
    {

        $data = $this->TransaksiModel->tampil_data_by_kode_produk($id);

        $output['result'] = array(
            'ID_produk' => $data['kode_produk'],
            'nama_produk' => $data['nama_produk'],
            'stok' => $data['stok'],
            'satuan' => $data['satuan'],
            'harga_umum' => 'Rp. ' . number_format($data['harga_umum'], 2, ',', '.'),
            'harga_langganan' => 'Rp. ' . number_format($data['harga_langganan'], 2, ',', '.')
        );

        echo json_encode($output);
    }

    public function get_cart($id)
    {

        $data = $this->cart->get_item($id);

        if ($data) {
            $output['result'] = array(
                'id' => $data['id'],
                'produk_id' => $data['produk_id'],
                'nama_produk' => $data['name'],
                'qty' => $data['qty'],
                'satuan' => $data['satuan'],
                'price' => 'Rp. ' . number_format($data['price'], 2, ',', '.'),
                'total' => 'Rp. ' . number_format($data['subtotal'], 2, ',', '.'),
                'customer' => $data['customer']
            );
        }

        echo json_encode($output);
    }

    public function get_total()
    {
        $output['total'] = 'Rp. ' . number_format($this->cart->total(), 2, ',', '.');
        echo json_encode($output);
    }

    public function tambah($id)
    {
        $produk = $this->db->query("SELECT * FROM tb_produk WHERE kode_produk = '{$id}'")->row_array();

        $data = array(
            'id' => $this->input->post('sell_type', TRUE) . '-' . 'umum',
            'produk_id' => $this->input->post('ID_produk', TRUE),
            'name' => $this->input->post('nama_produk', TRUE),
            'price' => $this->input->post('harga_umum', TRUE),
            'satuan' => $this->input->post('satuan', TRUE),
            'qty' => $this->input->post('quantity', TRUE),
            'customer' => $this->input->post('customer', TRUE),
        );

        $stok = $produk['stok'];
        $qty = $this->input->post('quantity', TRUE);

        if ($qty > $stok) {
            $output = array(
                'status' => FALSE,
                'message' => "Stock tidak mencukupi, \nSilahkan Update Stok terlebih dahulu."
            );
        } else {
            $this->cart->insert($data);
            $output = array(
                'status' => TRUE,
            );
        }

        echo json_encode($output);
    }

    function update_cart($produk_id)
    {

        $produk = $this->db->query("SELECT * FROM tb_produk WHERE kode_produk = '{$produk_id}'")->row_array();

        $data = array(
            'rowid' => $this->input->post('row_id', TRUE),
            'qty' => $this->input->post('quantity', TRUE),
        );

        $qty_edit = $this->input->post('quantity', TRUE);

        if ($qty_edit > $produk['stok']) {
            $output = array(
                'status' => FALSE,
                'message' => "Stock tidak mencukupi, \nSilahkan Update Stok terlebih dahulu."
            );
        } else {
            $this->cart->update($data);
            $output = array(
                'status' => TRUE,
            );
        }

        echo json_encode($output);
    }

    function hapus_cart()
    {
        $data = array(
            'rowid' => $this->input->post('row_id', TRUE),
            'qty' => 0,
        );
        $this->cart->update($data);

        $output = array(
            'status' => TRUE,
        );

        echo json_encode($output);
    }

    function hitung($bayar)
    {
        if ($bayar >= $this->cart->total()) {
            $output['status'] = TRUE;
            $kembalian = number_format($bayar - $this->cart->total(), 2, ',', '.');
            $output['kembali'] = $kembalian;
        } else {
            $output['status'] = FALSE;
        }

        echo json_encode($output);
    }

    public function tambah_transaksi()
    {
        if (!count($this->cart->contents())) {
            $output = array('status' => FALSE);
        } else {
            $code_factur = $this->custom->code_factur();

            $data = array(
                'id_transaksi' => $code_factur,
                'date' => date('Y-m-d H:i:s'),
                'total' => $this->cart->total(),
                'paid' => str_replace(',', '', $this->input->post('bayar', TRUE)),
                'user_id' => $this->session->userdata('id'),
            );

            $this->db->insert('tb_transaksi', $data);

            foreach ($this->cart->contents() as $item) {
                $productDB = $this->db->query("SELECT stok, id_produk FROM tb_produk WHERE kode_produk = {$item['produk_id']}")->row();

                /* Kurangi stock */
                $kurangi = $productDB->stok - $item['qty'];

                if ($kurangi < 0) {
                    $kurangi = 0;
                }

                $this->db->update('tb_produk', array('stok' => $kurangi), array('id_produk' => $productDB->id_produk));
                /* buat multidimensi */
                $detail_transaction = array(
                    'id_transaksi' => $code_factur,
                    'produk' => $productDB->id_produk,
                    'quantity' => $item['qty'],
                    'harga' => $item['price'],
                );

                $this->db->insert('tb_detail_transaksi', $detail_transaction);
            }

            $output = array(
                'status' => TRUE,
                'id_transaksi' => $code_factur,
            );
        }

        $this->cart->destroy();

        echo json_encode($output);
    }

    public function print_transaction($ID)
    {
        $transaction = $this->db->query("SELECT * FROM tb_transaksi WHERE id_transaksi = {$ID}")->row();

        $product = $this->db->query("
			SELECT tb_detail_transaksi.*, tb_produk.* FROM tb_detail_transaksi 
			JOIN tb_produk ON tb_detail_transaksi.produk = tb_produk.id_produk 
			WHERE tb_detail_transaksi.id_transaksi = {$ID}
		")->result();

        $user = $this->session->userdata('id');

        $data = array(
            'transaksi' => $transaction,
            'produk' => $product,
            'user' => $this->session->userdata('nama')
        );
        $this->load->view('kasir/transaksi/print_nota', $data);
    }

    public function cancel_transaction()
    {
        $this->cart->destroy();
        return redirect(site_url('kasir/transaksi_umum'));
    }
}
