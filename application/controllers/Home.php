<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//Do your magic here
	}

	public function index() {
		$data = [
			'main_view'	=> 'main'
		];
		$this->load->view('layout', $data);
	}
}