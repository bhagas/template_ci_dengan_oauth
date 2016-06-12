<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('is_logged_in')) {
			redirect(base_url('index.php/home'));
		}
		$this->load->model('model_user');
	}

	public function index($id_user=false)
	{
		$data['users'] = $this->model_user->get($id_user);

		if ($id_user!=false) {
			$this->load->view('template_backoffice/header');
			$this->load->view('content_backoffice/user/edit_user', $data);
			$this->load->view('template_backoffice/footer');
		}
		else{
			$this->load->view('template_backoffice/header');
			$this->load->view('content_backoffice/user/list_user', $data);
			$this->load->view('template_backoffice/footer');
		}
	}

	public function add()
	{
		$this->load->view('template_backoffice/header');
		$this->load->view('content_backoffice/user/add_user', $data);
		$this->load->view('template_backoffice/footer');
	}

	public function submit()
	{

		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password2]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<h6 class="w-500 alert bg-red">','</h6>');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('template_backoffice/header');
			$this->load->view('content_backoffice/user/add_user');
			$this->load->view('template_backoffice/footer');
		}
		else
		{
			$insert = $this->model_user->add();
			if ($insert==true) {
				redirect('user');
			}
			else{
				echo "gagal dimasukkan";
			}
			
		}

	}

	public function edit()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password2]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<h6 class="w-500 alert bg-red">','</h6>');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['users'] = $this->model_user->get($this->input->post('id_user'));

			$this->load->view('template_backoffice/header');
			$this->load->view('content_backoffice/user/edit_user', $data);
			$this->load->view('template_backoffice/footer');
		}
		else
		{
			$update = $this->model_user->edit();
			if ($update==true) {
				redirect('user');
			}
			else{
				echo "gagal dimasukkan";
			}
			
		}
	}

	public function delete($id_user)
	{
		$this->model_user->delete($id_user);
		redirect('user');
	}

	public function users()
	{
		
		$data['kabupaten'] 		= $this->model_kabupaten->get_kabupaten();

		for ($i=0; $i < count($data['kabupaten']); $i++) { 
			$username = str_replace(' ', '', $data['kabupaten'][$i]['nama_kabupaten']);
			$id_kabupaten = $data['kabupaten'][$i]['id_kabupaten'];
			// $data['kabupaten'][$i]['nama_kabupaten'] = strtolower($username);
			$username_lower = strtolower($username);
			for ($j=1; $j < 3; $j++) { 
				$object['username'] 	= $username_lower.'_'.$j;
				$object['password'] 	= $username_lower.'_'.$j;
				$object['fullname'] 	= $username_lower.'_'.$j;
				$object['id_kabupaten']	= $id_kabupaten;
				$object['email'] 		= $username_lower.'_'.$j;
				$object['telp'] 		= $username_lower.'_'.$j;
				$object['nip'] 			= $username_lower.'_'.$j;
				$this->model_user->create($object);

			}
		}

		$this->output->set_content_backoffice_type('application/json')->set_output(json_encode($data));
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */