<?php

class Mfrontend extends CI_Model{

    public function get_all_kategori(){
        return $this->db->get('tbl_kategori');
    }

    public function  get_all_kota(){
        return $this->db->get('tbl_kota');
    }

    public function insert_reg($data){
        $this->db->insert('tbl_member', $data);
    }

    public function get_produk($jumlah){
        $this->db->select('p.*');
        $this->db->from('tbl_produk as p');
        $this->db->order_by('idProduk', 'desc');
        $this->db->limit($jumlah);  
        $query = $this->db->get();
        return $query;
    }

    public function get_komentar($id) {
        $this->db->select('k.*, m.namaKonsumen');
        $this->db->from('tbl_komentar as k');
        $this->db->join('tbl_member as m','m.idKonsumen = k.idKonsumen', 'LEFT');
        $this->db->where('k.idProduk', $id); 
        return $this->db->get();
    }

    public function get_like($key, $value, $idkategori) {
        $this->db->where('idKat', $idkategori);
        $this->db->like($key, $value);
        return $this->db->get('tbl_produk');
    }

    public function paginate_produk($limit, $start, $query, $idkategori) {
        $this->db->where('idKat', $idkategori);
        $this->db->like('namaProduk', $query);
        $this->db->limit($limit, $start);
        $query = $this->db->get('tbl_produk');

        return $query->result();	
    }

}