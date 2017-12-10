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
				'userData'	=> $this->session->userdata(md5('UserData')),
	            'perusahaan'=> $this->model_siswa->getPerusahaan()
			];
			$this->load->view('siswa/layout', $data);
		} elseif (strcasecmp($this->uri->segment(3), 'pilih') == 0) {
			if (isset($_GET['p1']) && !empty(isset($_GET['p1'])) && isset($_GET['p2']) && !empty(isset($_GET['p2']))) {
				$data['p1'] = $_GET['p1'];
				$data['p2'] = $_GET['p2'];
				if ($this->model_siswa->setPilihanPerusahaan($data)) {
					redirect('Siswa/Profile');
				} else {
					$this->session->set_flashdata('notif', 'Gagal mengirim pilihan!');
					$this->session->set_flashdata('classNotif', 'warning');
				}
			}

			$data = [
				'main_view'			=> 'siswa/pilih_perusahaan',
				'userData'			=> $this->session->userdata(md5('UserData')),
				'data_perusahaan'	=> $this->model_siswa->getPilihan($this->session->userdata(md5('UserData'))['id_user']),
	            'perusahaan'		=> $this->model_siswa->getPerusahaan()
			];
			$this->load->view('siswa/layout', $data);
		} elseif (strcasecmp($this->uri->segment(3), 'get') == 0 && isset($_GET['pid'])) {
			echo json_encode($this->model_siswa->getPerusahaanById($_GET['pid']));
		} else {
			redirect('Siswa/Perusahaan/All');
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
			'main_view'			=> 'siswa/profile',
			'userData'			=> $this->session->userdata(md5('UserData')),
			'data_perusahaan'	=> $this->model_siswa->getPilihan($this->session->userdata(md5('UserData'))['id_siswa'])
		];
		$this->load->view('siswa/layout', $data);
	}
}