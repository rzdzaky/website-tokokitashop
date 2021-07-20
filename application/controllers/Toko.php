<?php

class Toko extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('Mfrontend');
		$this->load->model('Mtoko');
		$this->load->model('Mcrud');
		$this->load->library('form_validation');
	}

	public function main($idToko){
		$data['kategori']=$this->Mfrontend->get_all_kategori()->result();
		$data['toko']=$this->Mtoko->get_toko($idToko)->row_object();
		$this->template->load('layout_frontend','frontend/toko_home', $data);
	}

	public function produk($idToko){
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();
		$data['toko'] = $this->Mtoko->get_toko($idToko)->row_object();
		$data['produk'] = $this->Mtoko->get_produk($idToko)->result();
		$data['idToko'] = $idToko;
		$this->template->load('layout_frontend','frontend/toko_produk', $data);
	}

	public function create_produk($idToko){
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();
		$data['toko'] = $this->Mtoko->get_toko($idToko)->row_object();
		$data['idToko'] = $idToko;
		$this->template->load('layout_frontend','frontend/toko_create_produk', $data);

	}

	public function insert_produk(){
		//header('Content-Type: application/json');
        //echo json_encode( $this->input->post() );

		$idKat = $this->input->post('kategori');
		$idToko = $this->input->post('id_toko');
		$namaProduk = $this->input->post('namaProduk');
		$harga = $this->input->post('harga');
		$stok = $this->input->post('stok');
		$berat = $this->input->post('berat');
		$deskripsiProduk = $this->input->post('deskripsi');

		$config['upload_path'] = './assets/produk/';
		$config['allowed_types'] = 'jpg|png|jpeg';

		$this->load->library('upload', $config);

		if($this->upload->do_upload('foto_produk')){
			$data_file = $this->upload->data();

			$data_insert=array('idKat' => $idKat,
								'idToko' => $idToko, 
								'namaProduk' => $namaProduk,
								'harga' => $harga,
								'stok' => $stok,
								'berat' => $berat,
								'foto' => $data_file['file_name'],
								'deskripsiProduk' => $deskripsiProduk);
			$this->Mtoko->insert_produk($data_insert);
			redirect('toko/produk/'.$idToko);
		} else {
			redirect('toko/create_produk/'.$idToko);
		}
	}

	public function edit_produk($id){
		$data['kategori'] = $this->Mcrud->get_all_data('tbl_kategori')->result();
        $data['produk'] = $this->Mcrud->get_by_id('tbl_produk', ['idProduk' => $id])->row();
        $data['toko'] = $this->Mcrud->get_by_id('tbl_toko', ['idKonsumen' => $this->session->userdata('id'), 'idToko' => $data['produk']->idToko])->row();
        $this->template->load('layout_frontend', 'frontend/edit_produk', $data);
	}

	public function update_produk() {

		$this->form_validation->set_rules('namaProduk','nama produk','required');
        $this->form_validation->set_rules('kategori','kategori','required');
        $this->form_validation->set_rules('harga','harga','required');
        $this->form_validation->set_rules('stok','stok','required');
        $this->form_validation->set_rules('berat','berat','required');
        $this->form_validation->set_rules('deskripsi','deskripsi','required');
        $this->form_validation->set_rules('foto_lama','foto lama','required');

		if($this->form_validation->run() != false){
			$idKat = $this->input->post('kategori');
			$idToko = $this->input->post('id_toko');
			$namaProduk = $this->input->post('namaProduk');
			$harga = $this->input->post('harga');
			$stok = $this->input->post('stok');
			$berat = $this->input->post('berat');
			$deskripsiProduk = $this->input->post('deskripsi');
            $id = $this->input->post('idProduk');
            $foto_lama = $this->input->post('foto_lama');

            if (!empty($_FILES["foto_produk"]["name"])) {
                $config['upload_path'] = './assets/produk/';
				$config['allowed_types'] = 'jpg|png|jpeg';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('foto_produk')){
					$data_file = $this->upload->data();

					$image = $data_file['file_name'];
				} else {
					$image = $foto_lama;
				}
            } else {
                $image = $foto_lama;
            }

            $dataUpdate = [
				'namaProduk'=> $namaProduk,
				'idKat'=> $idKat,
                'harga'=> $harga,
                'stok'=> $stok,
                'berat'=> $berat,
                'deskripsiProduk'=> $deskripsiProduk,
				'foto'=> $image,
			];
            
            $this->Mcrud->update('tbl_produk', $dataUpdate, 'idProduk', $id);
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('toko/produk/'.$this->input->post('id_toko'));
		}else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('toko/edit_produk/'.$this->input->post('idProduk'));
		}
    }

	public function hapus_produk($id) {
		$data['kategori'] = $this->Mcrud->get_all_data('tbl_kategori')->result();
		$data['produk'] = $this->Mcrud->get_by_id('tbl_produk', ['idProduk' => $id])->row();

        $this->Mcrud->delete('tbl_produk', 'idProduk', $id);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('toko/produk/'.$data['produk']->idToko);
	}
}