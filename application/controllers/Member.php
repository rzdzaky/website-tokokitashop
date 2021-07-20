<?php

class Member extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Mfrontend');
		$this->load->model('Mmember');
		$this->load->model('Mcrud');
	}

	public function act_login() {
		$u = $this->input->post('username');
		$p = $this->input->post('password');

		$cek = $this->Mmember->cek_login($u, $p)->num_rows();
		$result = $this->Mmember->cek_login($u, $p)->result();

		if($cek == 1) {
			$data_session = [
				'username' => $u,
				'id' => $result[0]->idKonsumen,
				'status' => 'login'
			];

			$this->session->set_userdata($data_session);
			redirect('member');
		} else {
			$this->session->set_flashdata('pesan','Username / Password Tidak Sesuai');
			redirect('home/login');
		}
	}

	public function index() {
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();
		$this->template->load('layout_frontend','frontend/user_menu', $data);
	}

	public function transaksi() {
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();
		$data['transaksi'] = $this->Mcrud->get_by_id('tbl_order', ['idKonsumen' => $this->session->userdata('id')])->result();
		$this->template->load('layout_frontend','frontend/member_transaksi', $data);

	}

	public function toko() {
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();
		$data['toko'] = $this->Mmember->get_toko_by_member()->result();
		$this->template->load('layout_frontend','frontend/toko_member', $data);
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('home');
	}

	public function createToko (){
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();
		$this->template->load('layout_frontend','frontend/create_toko', $data);
	}
	private function _uploadImage() {
		$config['upload_path']          = './assets/logo/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']            = uniqid();
		$config['overwrite']			= true;
		$config['max_size']             = 4096; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('logo_toko')) {
			return $this->upload->data("file_name");
		}
		
		return "default.jpg";
	} 

	public function store_toko() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama_toko','nama toko','trim|required');
		$this->form_validation->set_rules('deskripsi','deskripsi','trim|required');

		if($this->form_validation->run() != false){
            $nama = $this->input->post('nama_toko');
            $deskripsi = $this->input->post('deskripsi');

            $dataInsert = [
				'namaToko'=> $nama,
				'deskripsi'=> $deskripsi,
				'logo'=> $this->_uploadImage(),
				'statusAktif'=> "Y",
				'idKonsumen'=> $this->session->userdata('id'),
			];

			$this->db->insert('tbl_toko', $dataInsert);

			$this->session->set_flashdata('success', 'Toko berhasil dibuat');
			redirect('member/toko');
		}else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('toko/create_toko');
		}

	
    }

	// KOMENTAR
	public function tambah_komentar($idProduk) {
		if ($this->session->userdata('id') ??  redirect('home/login'));

		$komentar = [
            'idProduk' => $idProduk,
            'idKonsumen' => $this->session->userdata('id'),
            'komentar' => $this->input->post('komentar'),
            'tanggal' => date("Y-m-d H:i:s")
        ];

        $insert = $this->Mcrud->insert('tbl_komentar', $komentar);
        $this->session->set_flashdata('success', 'Komentar berhasil diberikan');
        redirect('home/produk/'.$idProduk);
	}
}