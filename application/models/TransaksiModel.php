<?php
class TransaksiModel extends CI_Model
{
    public function
    tampil_data_by_kode_produk($id)
    {
        return $this->db->get_where('tb_produk', array('kode_produk' => $id));
    }

    public function tampil_data()
    {
        return $this->db->get('tb_produk')->result_array();
    }

    public function getall($limit = 20, $offset = 0, $type = 'result')
    {
        $this->db->select('tb_transaksi.*, user.nama, (SELECT SUM(harga*quantity) FROM tb_detail_transaksi WHERE id_transaksi = tb_transaksi.id_transaksi ) AS total');

        $this->db->join('user', 'tb_transaksi.user_id = user.id', 'left');

        if (
            $this->input->get('query') != ''
        )
            $this->db->like('id_transaksi', $this->input->get('query'));

        if ($this->input->get('from') != '')
            $this->db->where('DATE(date) >= ', $this->input->get('from'));

        if ($this->input->get('to') != '')
            $this->db->where('DATE(date) <= ', $this->input->get('to'));

        if ($this->input->get('kasir') != '')
            $this->db->where('tb_transaksi.user_id', $this->input->get('kasir'));

        $this->db->order_by('date', 'desc');

        if (
            $type == 'num'
        ) {
            return $this->db->get('tb_transaksi')->num_rows();
        } else {
            return $this->db->get('tb_transaksi', $limit, $offset)->result();
        }
    }

    public function get($param = 0)
    {
        $this->db->where('id_transaksi', $param);

        return $this->db->get('tb_transaksi')->row();
    }

    public function getProductItems($param = 0)
    {
        $this->db->select('tb_detail_transaksi.*, tb_produk.nama_produk, tb_produk.satuan, tb_produk.kode_produk, ');

        $this->db->join('tb_produk', 'tb_detail_transaksi.produk = tb_produk.id_produk', 'left');

        $this->db->where('tb_detail_transaksi.id_transaksi', $param);

        return $this->db->get('tb_detail_transaksi')->result_array();
    }

    public function getItemByCode($param = 0)
    {
        $this->db->select('tb_detail_transaksi.*, tb_produk.nama_produk, tb_produk.stok, tb_produk.kode_produk, tb_produk.satuan');

        $this->db->join('tb_produk', 'tb_detail_transaksi.produk = tb_produk.id_produk', 'left');

        $this->db->where('tb_produk.kode_produk', $param);

        return $this->db->get('tb_detail_transaksi')->row();
    }

    public function getItemById($param = 0)
    {
        $this->db->select('tb_detail_transaksi.*, tb_produk.nama_produk, tb_produk.stok, tb_produk.kode_produk, tb_produk.satuan');

        $this->db->join('tb_produk', 'tb_detail_transaksi.produk = tb_produk.id_produk', 'left');

        $this->db->where('tb_produk.id_produk', $param);

        return $this->db->get('tb_detail_transaksi')->row();
    }

    public function getallByUser($from = NULL, $to = NULL, $kasir = 0, $type = 'result')
    {
        $this->db->select('tb_transaksi.*, user.nama, (SELECT SUM(harga*quantity) FROM tb_detail_transaksi WHERE id_transaksi = tb_transaksi.id_transaksi ) AS total');

        $this->db->join('user', 'tb_transaksi.user_id = user.id', 'left');

        $this->db->where('DATE(date) >= ', $from);

        $this->db->where('DATE(date) <= ', $to);

        $this->db->where('tb_transaksi.user_id', $kasir);

        $this->db->order_by('date', 'desc');

        if (
            $type == 'num'
        ) {
            return $this->db->get('tb_transaksi')->num_rows();
        } else {
            return $this->db->get('tb_transaksi')->result();
        }
    }
}
