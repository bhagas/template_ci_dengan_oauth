<?php 

class Backoffice_kecamatan extends CI_Controller {
        
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('is_logged_in')) {
			redirect(base_url('index.php/home'));
		}
		header('Access-Control-Allow-Origin: *');
    	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$this->load->model('model_kecamatan');
	}

	public function show()
	{
		$data['kecamatan'] = $this->model_kecamatan->get_kecamatan();
		$this->load->view('template_backoffice/header');
		$this->load->view('content_backoffice/kecamatan/kecamatan', $data);
		$this->load->view('template_backoffice/footer');
	}

	public function json()
	{
		$data = $this->model_kecamatan->get_kecamatan();	
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function geo()
	{
		# Build GeoJSON feature collection array
		$geojson = array(
		   'type'      => 'FeatureCollection',
		   'features'  => array()
		);

		$data['kecamatan'] = $this->model_kecamatan->get_kecamatan_geo();

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

}

/* End of file jalan.php */
/* Location: ./application/controllers/jalan.php */