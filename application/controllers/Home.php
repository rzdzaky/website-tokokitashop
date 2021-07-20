<?php 

class Home extends CI_Controller{

	function __construct() {
		parent::__construct();
		$this->load->model('Mfrontend');
		$this->load->model('Mcrud');
	}

	public function index() {
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();
		$data['produk'] = $this->Mfrontend->get_produk(4)->result();
		$this->template->load('layout_frontend','frontend/home',$data);
	}

	public function register() {
		$data['kota'] = $this->Mfrontend->get_all_kota()->result();
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();
		$this->template->load('layout_frontend', 'frontend/register', $data);
	}

	public function login() {
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();
		$this->template->load('layout_frontend', 'frontend/login', $data);
	}

	public function act_reg() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama','Nama','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('password_confirm','Password Confirm','trim|required|matches[password]');
		$this->form_validation->set_rules('alamat','Alamat','trim|required');
		$this->form_validation->set_rules('no_telepon','No Telepon','trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan', validation_errors());
			redirect('home/register');
		} else {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$alamat = $this->input->post('alamat');
			$kota = $this->input->post('kota');
			$no_telepon = $this->input->post('no_telepon');

			$data_insert = [
				'username' => $username,
				'password' => $password,
				'namaKonsumen' => $nama,
				'alamat' => $alamat,
				'idKota' => $kota,
				'email' => $email,
				'tlpn' => $no_telepon,
				'statusAktif' => 'Y'
			];

			$this->Mfrontend->insert_reg($data_insert);
			redirect('home/login');
		}

		
	}

	public function cari() {

		if (isset($_POST['kategori'])) {
			$this->session->set_userdata('kategori_search', $this->input->post('kategori'));
			$this->session->set_userdata('q_search', $this->input->post('q'));

			$kategori = $this->input->post('kategori');
			$q = $this->input->post('q');
		} else {
			$kategori = $this->session->userdata('kategori_search');
			$q = $this->session->userdata('q_search');
		}
        
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();

        $jumlah = $this->Mfrontend->get_like('namaProduk', $q, $kategori)->num_rows();
        $this->load->library('pagination');
		$config['base_url'] = site_url().'/home/cari';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 4;
		$from = $this->uri->segment(3);
		$this->pagination->initialize($config);

		$data['q'] = $q;

		$data['produk'] = $this->Mfrontend->paginate_produk($config['per_page'], $from, $q, $kategori);
		$this->template->load('layout_frontend', 'frontend/cari', $data);
    }

	public function produk($id) {
		$data['kategori'] = $this->Mfrontend->get_all_kategori()->result();
		$data['produk'] = $this->Mcrud->get_by_id('tbl_produk', ['idProduk' => $id])->row();
		$data['komentar'] = $this->Mfrontend->get_komentar($id)->result();
		$this->template->load('layout_frontend','frontend/produk',$data);
	}

} 
