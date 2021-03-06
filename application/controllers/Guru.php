<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('model_guru');
	}

	public function index() {
		redirect('guru/dashboard');
	}

	public function Dashboard() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 'uguru') {
                redirect('auth');
            }
        }

		$data = [
			'main_view'			=> 'guru/dashboard',
			'userData'			=> $this->model_guru->getGuruByIdWithGroup($this->session->userdata(md5('UserData'))['id_guru']),
			'data_perusahaan'	=> $this->model_guru->getBimbingan($this->session->userdata(md5('UserData'))['id_guru']),
            'siswa'         	=> $this->model_guru->getSiswaWithGroup(),
            'dsiswa'         	=> $this->model_guru->getSiswaDibimbing(),
            'perusahaan'    	=> $this->model_guru->getPerusahaan()
		];
		$this->load->view('guru/layout', $data);
		// echo json_encode($this->model_guru->getBimbingan($data['userData']['id_user']));
	}

	public function About() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 'uguru') {
                redirect('auth');
            }
        }

		$data = [
			'main_view'			=> 'about',
			'userData'			=> $this->model_guru->getGuruByIdWithGroup($this->session->userdata(md5('UserData'))['id_guru']),
		];
		$this->load->view('guru/layout', $data);
	}

	public function Perusahaan() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 'uguru') {
                redirect('auth');
            }
        }
		if (strcasecmp($this->uri->segment(3), 'get') == 0 && isset($_GET['pid'])) {
			echo json_encode($this->model_guru->getPerusahaanById($_GET['pid']));
		}
		$data = [
			'main_view'			=> 'guru/perusahaan',
			'userData'			=> $this->model_guru->getGuruByIdWithGroup($this->session->userdata(md5('UserData'))['id_guru']),
			'data_perusahaan'	=> $this->model_guru->getBimbingan($this->session->userdata(md5('UserData'))['id_guru']),
			'perusahaan'		=> $this->model_guru->getPerusahaan()
		];
		$this->load->view('guru/layout', $data);
	}

	public function Monitor() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 'uguru') {
                redirect('auth');
            }
        }
		if (strcasecmp($this->uri->segment(3), 'get') == 0) {
			$response['statusCode'] = 0;
			if (isset($_POST['mid'])) {
				if ($result = $this->model_guru->getDataMonitoringById( $_POST['mid'] )) {
					$response['statusCode'] = 1;
					$response = $result;
				}
			}
			echo json_encode($response);
			return;
		}
		if (strcasecmp($this->uri->segment(3), 'add') == 0) {
			if (isset($_POST['submitMonitor'])) {
				if ($this->model_guru->addMonitoring()) {
					$this->session->set_flashdata('notif', 'Data berhasil ditambahkan!');
					$this->session->set_flashdata('classNotif', 'success');
				} else {
					$this->session->set_flashdata('notif', 'Data gagal ditambahkan!');
					$this->session->set_flashdata('classNotif', 'warning');
				}
				redirect('guru/monitor');
			}
			return;
		}
		if (strcasecmp($this->uri->segment(3), 'edit') == 0 && $this->uri->segment(4) != "") {
			if (isset($_POST['submitMonitor'])) {
				if ($this->model_guru->updateMonitoring($this->uri->segment(4))) {
					$this->session->set_flashdata('notif', 'Data berhasil diperbarui!');
					$this->session->set_flashdata('classNotif', 'success');
				} else {
					$this->session->set_flashdata('notif', 'Data gagal diperbarui!');
					$this->session->set_flashdata('classNotif', 'warning');
				}
				redirect('guru/monitor');
			}
			return;
		}
		if (strcasecmp($this->uri->segment(3), 'delete') == 0 && $this->uri->segment(4) != "") {
			if ($this->model_guru->deleteMonitoring($this->uri->segment(4))) {
				$this->session->set_flashdata('notif', 'Data berhasil dihapus!');
				$this->session->set_flashdata('classNotif', 'success');
			} else {
				$this->session->set_flashdata('notif', 'Data gagal dihapus!');
				$this->session->set_flashdata('classNotif', 'warning');
			}
			redirect('guru/monitor');
			return;
		}
		$data = [
			'main_view'			=> 'guru/monitor_view',
			'userData'			=> $this->model_guru->getGuruByIdWithGroup($this->session->userdata(md5('UserData'))['id_guru']),
			'data_perusahaan'	=> $this->model_guru->getBimbingan($this->session->userdata(md5('UserData'))['id_guru']),
			// 'perusahaan'		=> $this->model_guru->getBimbinganPerusahaan(),
			'monitor'			=> $this->model_guru->getDataMonitoring()
		];
		$this->load->view('guru/layout', $data);
	}

	public function Profile() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 'uguru') {
                redirect('auth');
            }
        }

		if (isset($_POST['updateProfile'])) {
			if ($this->model_guru->updateProfile()) {
				$this->session->set_flashdata('notif', 'Data berhasil diperbarui!');
				$this->session->set_flashdata('classNotif', 'success');
			} else {
				$this->session->set_flashdata('notif', 'Data gagal diperbarui!');
				$this->session->set_flashdata('classNotif', 'warning');
			}
		}

		$data = [
			'main_view'			=> 'guru/profile',
			'userData'			=> $this->model_guru->getGuruByIdWithGroup($this->session->userdata(md5('UserData'))['id_guru']),
			'data_perusahaan'	=> $this->model_guru->getBimbingan($this->session->userdata(md5('UserData'))['id_guru'])
		];
		$this->load->view('guru/layout', $data);
	}
}
