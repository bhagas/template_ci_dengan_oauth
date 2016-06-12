<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('is_logged_in')) {
			redirect(base_url('index.php/home'));
		}
		header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('model_kabupaten');
		$this->load->model('model_kecamatan');
	}

	public function index($id_kab=false)
	{
		$data = $this->model_kabupaten->get_kabupaten($id_kab);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function kecamatan_kab($id_kab = false)
	{
		// echo "string";
		$data = $this->model_kecamatan->get_kecamatan_by_kabupaten($id_kab);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function kecamatan_kelurahan_kab($id_kab = false, $id_kec = false)
	{
		// echo "string";
		$data = $this->model_kecamatan->get_kecamatan_kelurahan_by_kabupaten($id_kab, $id_kec);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function geo($id_kab=false)
	{
		# Build GeoJSON feature collection array
		$geojson = array(
		   'type'      => 'FeatureCollection',
		   'features'  => array()
		);

		$data['kecamatan'] = $this->model_kabupaten->get_kabupaten_geo($id_kab);

		foreach ($data['kecamatan'] as $item) {
			$properties = $item;

			unset($properties['wkb']);
			unset($properties['the_geom']);

			$feature = array(
		         'type' => 'Feature',
		         'properties' => $properties,
		         'geometry' => json_decode($this->geophp->wkb_to_json($item['wkb']))
		    );
		    # Add feature arrays to feature collection array
		    array_push($geojson['features'], $feature);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($geojson));
	}

	public function geo_tematik( $id_kab=false )
	{
		$tahun = $this->input->get('tahun');
		# Build GeoJSON feature collection array
		$geojson = array(
		   'type'      => 'FeatureCollection',
		   'features'  => array()
		);

		$data['kecamatan'] = $this->model_kabupaten->get_kabupaten_geo($id_kab);

		foreach ($data['kecamatan'] as $item) {
			$properties = $item;

			unset($properties['wkb']);
			unset($properties['the_geom']);
			$properties['jumlah_perusahaan'] 	= $this->model_kabupaten->get_jumlah_perusahaan($item['id_kabupaten'], $tahun);
			$properties['jumlah_produksi'] 		= $this->model_kabupaten->get_jumlah_produksi($item['id_kabupaten'], $tahun);
			$properties['jumlah_tenaga_kerja'] 	= $this->model_kabupaten->get_jumlah_tenaga_kerja_tematik($item['id_kabupaten'], $tahun);

			$feature = array(
		         'type' => 'Feature',
		         'properties' => $properties,
		         'geometry' => json_decode($this->geophp->wkb_to_json($item['wkb']))
		    );
		    # Add feature arrays to feature collection array
		    array_push($geojson['features'], $feature);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($geojson));
	}

	public function geowkt($id_kab=false)
	{
		# Build GeoJSON feature collection array
		$json = 'POINT (110.66476821899414 -6.591627560804745)';
		$wkt = $this->geophp->wkt_to_json($json);
		
		echo $wkt;
	}
}

/* End of file perusahaan.php */
/* Location: ./application/controllers/perusahaan.php */