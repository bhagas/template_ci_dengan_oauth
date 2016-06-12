<?php 

class Backoffice_kelurahan extends CI_Controller {
        
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('is_logged_in')) {
			redirect(base_url('index.php/home'));
		}
		header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('model_kelurahan');
	}

	public function show()
	{
		$data['kelurahan'] = $this->model_kelurahan->get_kelurahan_by_kecamatan($id_kecamatan=false);
		$this->load->view('template_backoffice/header');
		$this->load->view('content_backoffice/kelurahan/kelurahan', $data);
		$this->load->view('template_backoffice/footer');
	}

	public function json($id_kecamatan=false)
	{
		$data = $this->model_kelurahan->get_kelurahan_by_kecamatan($id_kecamatan);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_kelurahan($id_kelurahan=false)
	{
		$data['kelurahan'] = $this->model_kelurahan->get_kelurahan($id_kelurahan);
		$this->load->view('template/header');
		$this->load->view('content/kelurahan/kelurahan', $data);
		$this->load->view('template/footer');
	}

	public function get_kelurahan_by_kecamatan($id_kecamatan=false)
	{
		$data = $this->model_kelurahan->get_kelurahan_by_kecamatan($id_kecamatan);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function geo()
	{
		# Build GeoJSON feature collection array
		$geojson = array(
		   'type'      => 'FeatureCollection',
		   'features'  => array()
		);

		$data['desa'] = $this->model_kelurahan->get_desa_geo();

		foreach ($data['desa'] as $item) {
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
}

/* End of file jalan.php */
/* Location: ./application/controllers/jalan.php */