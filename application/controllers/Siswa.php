<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
	}

	public function index() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 'usiswa') {
                redirect('Auth');
            }
        }

		$data = [
			'main_view'	=> 'siswa/dashboard',
			'userData'	=> $this->session->userdata(md5('UserData'))
		];
		$this->load->view('siswa/layout', $data);
	}
}
