<?php 

class Ongkir extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Mongkir');
	}

	public function index() {
		$data['ongkir'] = $this->Mongkir->get_all_data('v_ongkir')->result();
		$this->template->load('layout_admin', 'admin/ongkir/index', $data);
	}

	public function add() 
	{
		$data['kurir']=$this->Mongkir->get_all_Data('tbl_kurir')->result();
		$data['kota']=$this->Mongkir->get_all_Data('tbl_kota')->result();
		$this->template->load('layout_admin', 'admin/ongkir/form_add', $data);
	}

	public function save(){
		$namaKurir = $this->input->post('Kurir');
		$KotaAsal =  $this->input->post('KotaAsal');
		$KotaTujuan =  $this->input->post('KotaTujuan');
		$biaya =  $this->input->post('biaya');
		$dataInsert = array (
			'idKurir' => $namaKurir,
			'idKotaAsal' => $KotaAsal,
			'idKotaTujuan' => $KotaTujuan,
			'biaya' => $biaya
		);
		$this->Mongkir->insert('tbl_biaya_kirim', $dataInsert);
		redirect('ongkir');
	}

	public function getid($id) {
		$dataWhere = array('idBiayaKirim'=>$id);
		$data['ongkir'] = $this->Mongkir->get_by_id('tbl_biaya_kirim', $dataWhere)->row_object();
		$data['kurir'] = $this->Mongkir->get_all_data('tbl_kurir')->result();
		$data['kota'] = $this->Mongkir->get_all_data('tbl_kota')->result();
		$this->template->load('layout_admin', 'admin/ongkir/form_edit', $data);
	}

	public function edit(){
		$id = $this->input->post('id');
		$namaKurir = $this->input->post('Kurir');
		$KotaAsal = $this->input->post('KotaAsal');
		$KotaTujuan = $this->input->post('KotaTujuan');
		$biaya = $this->input->post('biaya');
		$dataUpdate = array (
			'idKurir' => $namaKurir,
			'idKotaAsal' => $KotaAsal,
			'idKotaTujuan' => $KotaTujuan,
			'biaya' => $biaya
		);

		$this->Mongkir->update('tbl_biaya_kirim', $dataUpdate, 'idBiayaKirim', $id);
		redirect('ongkir');
	}

	public function delete($id) {
		$dataDelete = array('idBiayaKirim' => $id);
		$this->Mongkir->delete('tbl_biaya_kirim', $dataDelete);
		redirect('ongkir');
	}
}