<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_kecamatan extends CI_Model {



	public function get_kecamatan_geo()
	{
		$this->db->select('asWkb(the_geom) as wkb, nama_kecamatan');
		$this->db->from('master_kecamatan');

		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function get_kecamatan_geo2()
	{
		$this->db->select('asWkb(the_geom) as wkb, nama_kecamatan');
		$this->db->from('master_kecamatan');

		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function get_kecamatan()
	{
		$this->db->select('id_kecamatan, nama_kecamatan');
		$this->db->from('master_kecamatan');

		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function get_kabupaten_kecamatan( $id_kecamatan )
	{
		$this->db->select('master_kabupaten.id_kabupaten as id_kabupaten');
		$this->db->from('master_kecamatan');
		$this->db->where('master_kecamatan.id_kecamatan', $id_kecamatan);
		$this->db->join('master_kabupaten', 'master_kecamatan.id_kabupaten = master_kabupaten.id_kabupaten', 'left');
		$query = $this->db->get();
		$result = $query->row();
		return $result->id_kabupaten;
	}

	public function get_nama_kecamatan( $id_kecamatan )
	{
		$this->db->select('nama_kecamatan');
		$this->db->from('master_kecamatan');
		$this->db->where('id_kecamatan', $id_kecamatan );
		$query = $this->db->get();
		$result = $query->row();
		return $result->nama_kecamatan;
	}

	public function get_kecamatan_by_kabupaten( $id_kabupaten = false )
	{
		$this->db->select('id_kecamatan, id_kabupaten, UPPER(nama_kecamatan) as nama_kecamatan');
		$this->db->from('master_kecamatan');
		if ($id_kabupaten != false) {
			$this->db->where('master_kecamatan.id_kabupaten', $id_kabupaten);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function get_kecamatan_kelurahan_by_kabupaten($id_kabupaten = false, $id_kecamatan = false)
	{
		$this->db->select('id_desa, desa');
		$this->db->from('master_desa');
		$this->db->where('master_desa.id_kabupaten', $id_kabupaten);
		$this->db->where('master_desa.id_kecamatan', $id_kecamatan);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

}

/* End of file model_jalan.php */
/* Location: ./application/models/model_jalan.php */