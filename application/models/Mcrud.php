<?php

class Mcrud extends CI_Model {

	public function get_all_data($tabel) {
		$q = $this->db->get($tabel);
		return $q;
	}

	public function insert($tabel, $data) {
		$this->db->insert($tabel, $data);
	}

	public function get_by_id($tabel, $id) {
		return $this->db->get_where($tabel, $id);
	}

	public function update($tabel, $data, $pk, $id) {
		$this->db->where($pk, $id);
		$this->db->update($tabel, $data);
	}

	public function delete($tabel, $pk, $id) {
		$this->db->where($pk, $id);
		$this->db->delete($tabel);
	}

	public function insert_order($data) {
        $this->db->insert('tbl_order', $data);
        $lastId = $this->db->insert_id();
        return (isset($lastId)) ? $lastId : FALSE;
    }
}