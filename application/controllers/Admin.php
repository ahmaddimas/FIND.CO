<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_admin');
    }

    public function index() {
        redirect('Admin/Dashboard');
    }

	public function Dashboard() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 1) {
                redirect('Auth');
            }
        }

		$data = [
			'main_view'			=> 'admin/dashboard',
			'adminData'			=> $this->session->userdata(md5('UserData'))
		];
		$this->load->view('admin/layout', $data);
	}

	public function Perusahaan() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 1) {
                redirect('Auth');
            }
        }
        $uri3 = $this->uri->segment(3);
        if (strcasecmp($uri3, 'tambah') == 0) {
            $data = [
    			'main_view'		=> 'admin/form_perusahaan',
    			'adminData'		=> $this->session->userdata(md5('UserData'))
    		];
    		$this->load->view('admin/layout', $data);
            return;
        }

		$data = [
			'main_view'		=> 'admin/perusahaan',
			'adminData'		=> $this->session->userdata(md5('UserData')),
            'perusahaan'    => $this->model_admin->getPerusahaan()
		];
		$this->load->view('admin/layout', $data);
	}
}
/* End of file ${TM_FILENAME:${1/(.+)/lAdmin.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Admin/:application/controllers/${1/(.+)/lAdmin.php/}} */
