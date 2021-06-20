<?php
class ProdukModel extends CI_Model
{

    var $table = 'tb_produk';

    var $column_order = array(null, 'kode_produk', 'nama_produk', 'stok', 'satuan', null, 'harga_beli', 'harga_umum', 'harga_langganan', null); //set column field database for datatable orderable
    var $column_search = array('kode_produk', 'nama_produk'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('kode_produk' => 'desc', 'nama_produk' => 'desc'); // default order 

    public function tampil_data_category_produk()
    {
        $this->db->select('*');
        $this->db->from('tb_produk');
        $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori');
        $query = $this->db->get();
        return $query->result_array();
    }



    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori', 'left');


        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    public function simpan_data($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function tampil_data_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id_produk', $id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function update_data($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete($this->table);
    }
}