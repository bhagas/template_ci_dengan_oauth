<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_kabupaten extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_kabupaten($id_kab = false)
	{
		$this->db->select('id_kabupaten, nama_kabupaten');
		$this->db->from('master_kabupaten');
		if($id_kab != false){
			$this->db->where('id_kabupaten', $id_kab);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function get_nama_kabupaten($id_kab)
	{
		$this->db->select('nama_kabupaten');
		$this->db->from('master_kabupaten');
		$this->db->where('id_kabupaten', $id_kab);
		$query = $this->db->get();
		$result = $query->row();
		return $result->nama_kabupaten;
	}

	public function get_kabupaten_geo($id_kab)
	{
		$this->db->select('	asWkb(master_kabupaten.the_geom) as wkb,  
							master_kabupaten.nama_kabupaten, 
							master_kabupaten.id_kabupaten');
		$this->db->from('master_kabupaten');
		if($id_kab!=""){
			$this->db->where('master_kabupaten.id_kabupaten', $id_kab);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function get_jumlah_perusahaan($id_kab)
	{
		$this->db->select('count(id_perusahaan) as jumlah_perusahaan');
		$this->db->from('perusahaan');
		if($id_kab!=""){
			$this->db->where('fdkab', $id_kab);
		}
	 	$this->db->where('perusahaan.deleted ', 0);
		$query = $this->db->get();
		$result = $query->row();
		if ( $result->jumlah_perusahaan != null) {
			return $result->jumlah_perusahaan;
		}else{
			return 0;
		}
	}

	public function get_jumlah_produksi($id_kab, $tahun = false)
	{
		$this->db->select('sum(nilai_volume_produksi_perusahaan.volume_produksi) as jumlah_produksi');
		$this->db->from('perusahaan');
		$this->db->join('master_kabupaten', 'perusahaan.fdkab = master_kabupaten.id_kabupaten', 'left');
		$this->db->join('nilai_volume_produksi_perusahaan', 'perusahaan.id_perusahaan = nilai_volume_produksi_perusahaan.id_perusahaan', 'left');
		
		if($id_kab!=""){
			$this->db->where('perusahaan.fdkab', $id_kab);
		}

		if ( $tahun != false ) {
			$this->db->where('tahun', $tahun);
		}

	 	$this->db->where('perusahaan.deleted ', 0);
		$query = $this->db->get();
		$result = $query->row();
		if ( $result->jumlah_produksi != null ) {
			return $result->jumlah_produksi;
		}else{
			return 0;
		}
	}
	
	public function get_jumlah_tenaga_kerja($id_kab, $tahun = false)
	{
		$this->db->select('sum(fpria) as fpria, sum(fwanita) as fwanita');
		$this->db->from('perusahaan');
		if($id_kab!=""){
			$this->db->where('perusahaan.fdkab', $id_kab);
		}
	 	$this->db->where('perusahaan.deleted ', 0);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function get_jumlah_tenaga_kerja_tematik($id_kab, $tahun = false)
	{
		$this->db->select('sum(tenaga_kerja_perusahaan.fpria) as fpria, sum(tenaga_kerja_perusahaan.fwanita) as fwanita');
		$this->db->from('tenaga_kerja_perusahaan');
		$this->db->join('perusahaan', 'perusahaan.id_perusahaan = tenaga_kerja_perusahaan.id_perusahaan', 'left');
		if($id_kab!=""){
			$this->db->where('perusahaan.fdkab', $id_kab);
		}
		if ( $tahun != false ) {
			$this->db->where('tenaga_kerja_perusahaan.tahun', $tahun);
		}
	 	$this->db->where('perusahaan.deleted ', 0);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

}

/* End of file model_jenis_jalan.php */
/* Location: ./application/models/model_jenis_jalan.php */