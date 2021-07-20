<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->library('cart');
        $this->load->model(['Mcrud', 'Mlogin']);

        if ($this->session->userdata('id') ??  redirect('home/login'));
    }

    public function index() {
        $data['cart_items'] = $this->cart->contents();
        $data['total'] = $this->cart->total();
        $data['kategori'] = $this->Mcrud->get_all_data('tbl_kategori')->result();

        $this->template->load('layout_frontend', 'frontend/cart', $data);
    }

    public function add_to_cart($id) {
        $produk = $this->Mcrud->get_by_id('tbl_produk', ['idProduk' => $id])->row();

        $data = array(
            'id' => $produk->idProduk, 
            'name' => $produk->namaProduk, 
            'price' => $produk->harga, 
            'image' => $produk->foto,
            'qty' => 1, 
        );
        $this->cart->insert($data);
        
        $this->session->set_flashdata('success', 'Barang ditambahkan ke keranjang');
        redirect('cart');
    }

    public function delete_cart($rowid) {
        if ($rowid == "all") {
                $this->cart->destroy();
        } else {
            $data = [
                'rowid' => $rowid,
                'qty' => 0
            ];

            $this->session->set_flashdata('success', 'Cart berhasil dihapus');
            $this->cart->update($data);
        }

        redirect('cart');
    }

    public function add_one_qty($rowid) {
        $item = $this->cart->get_item($rowid);
        $data = [
            'rowid' => $rowid,
            'qty' => $item['qty']+1
        ];

        $this->cart->update($data);

        $this->session->set_flashdata('success', 'Qty barang '.$item['name'].' ditambah 1');
        redirect('cart');
    }

    public function remove_one_qty($rowid) {
        $item = $this->cart->get_item($rowid);
        $data = [
            'rowid' => $rowid,
            'qty' => $item['qty']-1
        ];

        $this->cart->update($data);

        $this->session->set_flashdata('success', 'Qty barang '.$item['name'].' berhasil dikurangi');
        redirect('cart');
    }

    public function checkout(){

        if ($cart = $this->cart->contents()) {
            foreach ($cart as $item) {
                $konsumen = [
                    'idKonsumen' => $this->session->userdata('id'),
                    'tglOrder' => date("Y-m-d H:i:s"),
                    'statusOrder' => "Belum Bayar"
                ];
        
                $lastId = $this->Mcrud->insert_order($konsumen); 

                $detailOrder = [
                    'idOrder' => $lastId,
                    'idProduk' => $item['id'],
                    'jumlah' => $item['qty'],
                    'harga' => $item['price']*$item['qty']
                ];
                $this->Mcrud->insert('tbl_detail_order', $detailOrder);
                $lastId = 0;

                $this->cart->remove($item['rowid']);
            }
        }

        $this->cart->destroy();
        redirect('member/transaksi');
	}
}
