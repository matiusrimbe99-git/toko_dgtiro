<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_transaksi extends CI_Controller
{
	public $data;

	public $per_page;

	public $page;

	public $query;

	public $from;

	public $to;

	public $cashier;

	private $filtered = array();

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		session_level();

		$this->per_page = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');

		$this->page = $this->input->get('page');

		$this->query = $this->input->get('query');

		$this->from = (!$this->input->get_post('from')) ? '0000-00-00' : $this->input->get('from');

		$this->to = (!$this->input->get('to')) ? date('Y-m-d') : $this->input->get('to');

		$this->cashier = $this->input->get('kasir');
	}

	public function index()
	{
		$config = $this->template->pagination_list();

		$config['base_url'] = base_url("administrator/data_transaksi?per_page={$this->per_page}&query={$this->query}&from={$this->from}&to={$this->to}&kasir={$this->cashier}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->TransaksiModel->getall(null, null, 'num');

		$this->pagination->initialize($config);

		$data = array(
			'title' => 'Data Transaksi',
			'transaksi' =>  $this->TransaksiModel->getall($this->per_page, $this->page)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/navbar', $data);
		$this->load->view('administrator/laporan/data-transaksi', $data);
		$this->load->view('templates/footer');
	}

	public function update($param = 0)
	{

		$data = array(
			'title' => 'Ubah Data Transaksi',
			'transaksi' =>  $this->TransaksiModel->get($param)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/navbar', $data);
		$this->load->view('administrator/laporan/ubah-transaksi', $data);
		$this->load->view('templates/footer');
	}

	public function getdataupdate($param = 0)
	{
		$product_items = $this->TransaksiModel->getProductItems($param);
		$data = array();

		$no = $_POST['start'];

		foreach ($product_items as $item) {
			$row = array();
			$row[] = '<center>' . ++$no . '</center>';
			$row[] = '<center>' . $item['kode_produk'] . '</center>';
			$row[] = $item['nama_produk'];
			$row[] = '<center>' . $item['quantity'] . '</center>';
			$row[] = '<center>' . $item['satuan'] . '</center>';
			$row[] = "Rp. " . number_format($item['harga'], 2, ',', '.');
			$row[] = "Rp. " . number_format($item['harga'] * $item['quantity'], 2, ',', '.');

			$row[] = '<a class="btn btn-primary btn-xs" onclick="update_cart(' . "'" . $item['id_transaksi'] . "'," . '' . "'" . $item['kode_produk'] . "'" . ');"><i class="fas fa-edit"></i></a>
            	<a class="btn btn-danger btn-xs" onclick="hapus_cart(' . "'" . $item['produk'] . "'," . '' . "'" . $item['kode_produk'] . "'" . ');"><i class="fas fa-trash"></i></a>';

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

	public function get_total()
	{
		$product_items = $this->TransaksiModel->getProductItems($this->input->post('transaction', TRUE));

		$total = 0;

		foreach ($product_items as $item)
			$total += ($item['harga'] * $item['quantity']);

		$output['total'] = 'Rp. ' . number_format($total, 2, ',', '.');
		echo json_encode($output);
	}

	public function data_produk($param)
	{
		$list = $this->ProdukModel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $produk) {
			if ($param == "umum") {
				$no++;
				$row = array();
				$row[] = '<center>' . $produk['kode_produk'] . '</center>';
				$row[] = $produk['nama_produk'];
				$row[] = '<center>' . $produk['stok'] . '</center>';
				$row[] = '<center>' . $produk['satuan'] . '</center>';
				$row[] = "Rp. " . number_format($produk['harga_umum'], 2, ',', '.');


				$row[] = '<center>' . '<a class="btn btn-sm btn-success" id="' . $produk['kode_produk'] . '" onclick="add_cart_cari(' . $produk['kode_produk'] . ')" title="Tambahkan" data-kodeproduk="' . $produk['kode_produk'] . '" data-namaproduk="' . $produk['nama_produk'] . '" data-hargaumum=" '  . $produk['harga_umum'] .  '" data-satuan=" '  . $produk['satuan'] .  '" data-selltype=" ' . $produk['kode_produk'] . '-' . 'umum' .  '"><i class="fas fa-plus"></i></a>' . '</center>';

				$data[] = $row;
			} else {
				$no++;
				$row = array();
				$row[] = '<center>' . $produk['kode_produk'] . '</center>';
				$row[] = $produk['nama_produk'];
				$row[] = '<center>' . $produk['stok'] . '</center>';
				$row[] = '<center>' . $produk['satuan'] . '</center>';
				$row[] = "Rp. " . number_format($produk['harga_langganan'], 2, ',', '.');


				$row[] = '<center>' . '<a class="btn btn-sm btn-success" id="' . $produk['kode_produk'] . '" onclick="add_cart_cari(' . $produk['kode_produk'] . ')" title="Tambahkan" data-kodeproduk="' . $produk['kode_produk'] . '" data-namaproduk="' . $produk['nama_produk'] . '" data-hargalangganan=" '  . $produk['harga_langganan'] .  '" data-satuan=" '  . $produk['satuan'] .  '" data-selltype=" ' . $produk['kode_produk'] . '-' . 'langganan' .  '"><i class="fas fa-plus"></i></a>' . '</center>';

				$data[] = $row;
			}
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->ProdukModel->count_all(),
			"recordsFiltered" => $this->ProdukModel->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
	}


	public function addedcart($id)
	{

		$produk = $this->db->query("SELECT * FROM tb_produk WHERE kode_produk = '{$id}'")->row_array();

		$stok = $produk['stok'];
		$qty = $this->input->post('quantity', TRUE);

		if ($qty > $stok) {
			$output = array(
				'status' => FALSE,
				'message' => "Stock tidak mencukupi, \nSilahkan Update Stok terlebih dahulu."
			);
		} else {
			$this->db->insert('tb_detail_transaksi', array(
				'id_transaksi' => $this->input->post('transaction', TRUE),
				'produk' => $produk['id_produk'],
				'quantity' => $qty,
				'harga' => ($this->input->post('customer', TRUE) == 'umum') ? $produk['harga_umum'] : $produk['harga_langganan']
			));

			$this->db->update('tb_produk', array(
				'stok' => ($produk['stok'] - $qty)
			), array(
				'id_produk' => $produk['id_produk']
			));

			$output = array(
				'status' => TRUE,
			);
		}

		echo json_encode($output);

	}

	public function updatecart($param = 0, $sell_type)
	{
		$product = $this->db->query("SELECT * FROM tb_produk WHERE kode_produk = '{$param}'")->row();

		$items = $this->TransaksiModel->getItemByCode($param);

		$qty = $this->input->post('qty');

		if ($qty == 0) {
			$this->db->update('tb_produk', array(
				'stok' => ($product->stok + $items->quantity)
			), array(
				'id_produk' => $product->id_produk
			));

			$this->db->delete('tb_detail_transaksi', array('produk' => $product->id_produk));
		}

		if ($qty < $items->quantity) {
			$jumlahStock = ($product->stok + ($items->quantity - $qty));
		} else if ($qty > $items->quantity) {
			$jumlahStock = ($product->stok - ($qty - $items->quantity));
		} else if ($items->quantity == $qty) {
			$jumlahStock = $product->stok;
		}

		if ($jumlahStock < 0) {
			$output = array(
				'status' => false,
				'message' => '<p>Stock tidak mencukupi,</p><p>Jumlah stock produk ini : <strong>' . $product->stok . ' ' . $product->satuan . '</strong></p>'
			);
		} else {
			$this->db->update('tb_produk', array(
				'stok' => $jumlahStock
			), array(
				'id_produk' => $product->id_produk
			));

			$this->db->update(
				'tb_detail_transaksi',
				array(
					'quantity' => $qty
				),
				array(
					'id' => $items->id
				),
			);

			$output = array(
				'status' => true,
				'message' => $jumlahStock,
				'result' => array('stock' => $product->stok, 'unit' => $product->satuan),
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function get_cart($param = 0, $byCode = NULL)
	{
		if ($byCode == NULL) {
			$product = $this->TransaksiModel->getItemById($param);
		} else {
			$product = $this->TransaksiModel->getItemByCode($param);
		}

		$output = array(
			'data' => array($this->db->last_query()),
		);

		if ($product) {
			$output['status'] = true;
			$output['result'] = array(
				'id' => $product->produk,
				'ID_produk' => $product->kode_produk,
				'nama_produk' => $product->nama_produk,
				'qty' => $product->quantity,
				'satuan' => $product->satuan,
				'price' => number_format($product->harga),
				'total' => number_format($product->harga * $product->quantity)
			);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	public function delete_item($param = 0)
	{
		$product = $this->db->query("SELECT * FROM tb_produk WHERE id_produk = '{$param}'")->row();

		$item = $this->TransaksiModel->getItemById($param);

		$this->db->update('tb_produk', array(
			'stok' => ($product->stok + $item->quantity)
		), array(
			'id_produk' => $item->produk
		));

		$this->db->delete('tb_detail_transaksi', array('produk' => $param));

		$this->output->set_content_type('application/json')->set_output(json_encode(array('status' => true)));
	}

	public function hitung($bayar)
	{

		$total = 0;
		$transaksi = $this->TransaksiModel->get($this->input->post('transaction', TRUE));
		$product_items = $this->TransaksiModel->getProductItems($this->input->post('transaction', TRUE));

		foreach ($product_items as $item)
			$total += ($item['harga'] * $item['quantity']);


		if ($bayar >= $total) {
			$this->db->update('tb_transaksi', array(
				'total' => $total,
				'paid' => $bayar
			), array(
				'id_transaksi' => $this->input->post('transaction', TRUE)
			));
			$output['status'] = TRUE;
			$kembalian = number_format($bayar - $total, 2, ',', '.');
			$output['kembali'] = $kembalian;
		} else {
			$output['status'] = FALSE;
		}

		echo json_encode($output);
	}

	/**
	 * Menghapus Data Transaksi
	 *
	 * @return string
	 **/
	public function delete_transaksi($param = 0)
	{
		$this->db->delete('tb_transaksi', array('id_transaksi' => $param));
		$this->db->delete('tb_detail_transaksi', array('id_transaksi' => $param));

		redirect('administrator/data_transaksi');
	}

	public function report()
	{
		$config = $this->template->pagination_list();

		$config['base_url'] = base_url("administrator/data_transaksi?per_page={$this->per_page}&query={$this->query}&from={$this->from}&to={$this->to}&kasir={$this->cashier}");

		$config['per_page'] = $this->per_page;
		$config['total_rows'] = $this->TransaksiModel->getall(null, null, 'num');

		$this->pagination->initialize($config);

		$data = array(
			'title' => 'Buat Laporan Transaksi',
			'transaksi' =>  $this->TransaksiModel->getall($this->per_page, $this->page)
		);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('templates/navbar', $data);
		$this->load->view('administrator/laporan/buat-laporan', $data);
		$this->load->view('templates/footer');
	}

	public function cetaklaporan()
	{
		$data = array(
			'title' => 'Cetak Laporan',
			'transaksi' =>  $this->TransaksiModel->getallByUser($this->input->get('from'), $this->input->get('to'), $this->input->get('kasir'), 'result'),
			'user' => $this->session->userdata('nama')
		);

		$this->load->view('administrator/laporan/cetak-laporan', $data);
	}
}

/* End of file Data_transaksi.php */
/* Location: ./application/controllers/Data_transaksi.php */