<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('model_siswa');
	}

	public function index() {
		redirect('Siswa/Dashboard');
	}

	public function Dashboard() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 'usiswa') {
                redirect('Auth');
            }
        }

		$data = [
			'main_view'			=> 'siswa/dashboard',
			'userData'			=> $this->session->userdata(md5('UserData')),
			'data_perusahaan'	=> $this->model_siswa->getPilihan($this->session->userdata(md5('UserData'))['id_user'])
		];
		$this->load->view('siswa/layout', $data);
		// echo json_encode($this->model_siswa->getPilihan($data['userData']['id_user']));
	}

	public function Perusahaan() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 'usiswa') {
                redirect('Auth');
            }
        }

		if (strcasecmp($this->uri->segment(3), 'all') == 0) {
			$data = [
				'main_view'	=> 'siswa/perusahaan',
				'userData'	=> $this->session->userdata(md5('UserData'))
			];
			$this->load->view('siswa/layout', $data);
		}
	}

	public function Profile() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 'usiswa') {
                redirect('Auth');
            }
        }

		if (isset($_POST['updateProfile'])) {
			if ($this->model_siswa->updateProfile()) {
				$this->session->set_flashdata('notif', 'Data berhasil diperbarui!');
				$this->session->set_flashdata('classNotif', 'success');
			} else {
				$this->session->set_flashdata('notif', 'Data gagal diperbarui!');
				$this->session->set_flashdata('classNotif', 'warning');
			}
		}

		$data = [
			'main_view'	=> 'siswa/profile',
			'userData'	=> $this->session->userdata(md5('UserData')),
			'data_perusahaan'	=> $this->model_siswa->getPilihan($this->session->userdata(md5('UserData'))['id_user'])
		];
		$this->load->view('siswa/layout', $data);
	}
}
