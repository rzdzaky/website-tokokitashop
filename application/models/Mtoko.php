<?php

class Mtoko extends CI_Model{

    public function get_toko($id)
    {
		return $this->db->get_where('tbl_toko', ['idToko' => $id]);
	}

    public function get_produk($id)
    {
        $this->db->select('p.*, k.namakat');
        $this->db->from('tbl_produk as p');
        $this->db->join('tbl_kategori as k','k.idkat = p.idKat', 'LEFT');
        $this->db->where('p.idToko', $id);  
        $query = $this->db->get();
        return $query;
	}

    public function insert_produk($data)
	{
		$this->db->insert('tbl_produk', $data);
	}

}