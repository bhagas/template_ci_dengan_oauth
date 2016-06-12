<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($id_user=false)
	{
		$this->db->select('id_user, username, pwd, fullname, NIP, email, telp, is_admin, id_kabupaten');
		$this->db->where('deleted', 0);
		if ($id_user!=false) {
			$this->db->where('id_user', $id_user);
		}
		$this->db->from('user');
		$query 	= $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function add()
	{
		$username 		= $this->input->post('username');
		$password 		= $this->input->post('password');
		$fullname 		= $this->input->post('fullname');
		$is_admin 		= $this->input->post('is_admin');
		$id_kabupaten 	= $this->input->post('id_kabupaten');
		$email 			= $this->input->post('email');
		$telp 			= $this->input->post('telp');
		$nip 			= $this->input->post('nip');

		$object  	= array('username' 		=> $username,
							'pwd' 			=> $this->encrypt->sha1($password),
							'fullname' 		=> $fullname,
							'is_admin' 		=> $is_admin,
							'id_kabupaten' 	=> $id_kabupaten,
							'email'			=> $email,
							'telp' 			=> $telp,
							'NIP' 			=> $nip );

		$query = $this->db->insert('user', $object);

		if ($query) {
			return true;
		}
		else{
			return false;
		}
	}

	public function edit()
	{
		$username 		= $this->input->post('username');
		$fullname 		= $this->input->post('fullname');
		$is_admin 		= $this->input->post('is_admin');
		$id_kabupaten 	= $this->input->post('id_kabupaten');
		$email 			= $this->input->post('email');
		$telp 			= $this->input->post('telp');
		$nip 			= $this->input->post('nip');

		if ($this->input->post('password')!='') {
			$password 	= $this->input->post('password');
			$object  	= array('username' 		=> $username,
								'pwd' 			=> $this->encrypt->sha1($password),
								'is_admin' 		=> $is_admin,
								'id_kabupaten' 	=> $id_kabupaten,
								'fullname' 		=> $fullname,
								'email'			=> $email,
								'telp' 			=> $telp,
								'NIP' 			=> $nip );
		}
		else{
			$object  	= array('username' 		=> $username,
								'fullname' 		=> $fullname,
								'is_admin' 		=> $is_admin,
								'id_kabupaten' 	=> $id_kabupaten,
								'email'			=> $email,
								'telp' 			=> $telp,
								'NIP' 			=> $nip );
		}
		$this->db->where('id_user', $this->input->post('id_user'));
		$query = $this->db->update('user', $object);

		if ($query) {
			return true;
		}
		else{
			return false;
		}
	}

	public function delete($id_user)
	{
		$object = array('deleted' => 1);
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $object);
	}

	public function create($object)
	{
		$username 		= $object['username'];
		$password 		= $object['password'];
		$fullname 		= $object['fullname'];
		$is_admin 		= 0;
		$id_kabupaten 	= $object['id_kabupaten'];
		$email 			= $object['email'];
		$telp 			= $object['telp'];
		$nip 			= $object['nip'];

		$object  	= array('username' 		=> $username,
							'pwd' 			=> $this->encrypt->sha1($password),
							'fullname' 		=> $fullname,
							'is_admin' 		=> $is_admin,
							'id_kabupaten' 	=> $id_kabupaten,
							'email'			=> $email,
							'telp' 			=> $telp,
							'NIP' 			=> $nip );

		$query = $this->db->insert('user', $object);

		if ($query) {
			return true;
		}
		else{
			return false;
		}
	}

}

/* End of file model_user.php */
/* Location: ./application/models/model_user.php */