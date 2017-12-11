<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_admin');
    }

    public function index() {
        redirect('admin/dashboard');
    }

	public function Dashboard() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 1) {
                redirect('auth');
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
                redirect('auth');
            }
        }
        // get action of perusahaan from uri segment 3
        $uri3 = $this->uri->segment(3);
        // tambah perusahaan
        if (strcasecmp($uri3, 'tambah') == 0) {
            if (isset($_POST['addIndustry'])) {
                $config['upload_path'] = './assets/images/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']  = '2048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')){
                    if ($this->model_admin->addPerusahaan($this->upload->data())) {
                        $this->session->set_flashdata('notif', 'Tambah Perusahaan Berhasil');
                        $this->session->set_flashdata('classNotif', 'success');
                        redirect('admin/perusahaan');
                    } else {
                        $this->session->set_flashdata('notif', 'Tambah Perusahaan Gagal');
                        $this->session->set_flashdata('classNotif', 'danger');
                    }
                }
                else{
                    $this->session->set_flashdata('notif', $this->upload->display_errors());
                    $this->session->set_flashdata('classNotif', 'danger');
                }
            }

            $data = [
    			'main_view'		=> 'admin/form_perusahaan',
    			'adminData'		=> $this->session->userdata(md5('UserData'))
    		];
    		$this->load->view('admin/layout', $data);
            return;
        }
        // end of tambah perusahaan
        // edit perusahaan
        if (strcasecmp($uri3, 'edit') == 0) {
            if (!empty($this->uri->segment(4))) {
                if (isset($_POST['updateIndustry'])) {
                    $config['upload_path'] = './assets/images/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['max_size']  = '2048';
                    $this->load->library('upload', $config);
                    if (!empty($_FILES['image']['name'])) {
                        if ($this->upload->do_upload('image')) {
                            if ($this->model_admin->updatePerusahaan($this->upload->data()['file_name'])) {
                                $this->session->set_flashdata('notif', 'Perusahaan Berhasil Diperbarui!');
                                $this->session->set_flashdata('classNotif', 'success');
                                redirect('admin/perusahaan');
                            } else {
                                $this->session->set_flashdata('notif', 'Perusahaan Gagal Diperbarui!');
                                $this->session->set_flashdata('classNotif', 'success');
                            }
                        } else {
                            $this->session->set_flashdata('notif', $this->upload->display_errors());
                            $this->session->set_flashdata('classNotif', 'success');
                        }
                    } else {
                        if ($this->model_admin->updatePerusahaan()) {
                            $this->session->set_flashdata('notif', 'Perusahaan Berhasil Diperbarui!');
                            $this->session->set_flashdata('classNotif', 'success');
                            redirect('admin/perusahaan');
                        } else {
                            $this->session->set_flashdata('notif', 'Perusahaan Gagal Diperbarui!');
                            $this->session->set_flashdata('classNotif', 'success');
                        }
                    }
                }

                $data = [
        			'main_view'		    => 'admin/form_edit_perusahaan',
        			'adminData'		    => $this->session->userdata(md5('UserData')),
                    'data_perusahaan'   => $this->model_admin->getPerusahaanById($this->uri->segment(4))
        		];
        		$this->load->view('admin/layout', $data);
                return;
            }
        }
        // end of edit perusahaan
        // hapus perusahaan
        if (strcasecmp($uri3, 'hapus') == 0 && !empty($this->uri->segment(4))) {
            if ($this->model_admin->hapusPerusahaan($this->uri->segment(4))) {
                $this->session->set_flashdata('notif', 'Perusahaan Berhasil Dihapus!');
                $this->session->set_flashdata('classNotif', 'success');
            } else {
                $this->session->set_flashdata('notif', 'Perusahaan Gagal Dihapus!');
                $this->session->set_flashdata('classNotif', 'danger');
            }
            redirect('admin/perusahaan');
        }
        // end of hapus perusahaan

		$data = [
			'main_view'		=> 'admin/perusahaan',
			'adminData'		=> $this->session->userdata(md5('UserData')),
            'perusahaan'    => $this->model_admin->getPerusahaan()
		];
		$this->load->view('admin/layout', $data);
	}

	public function Users() {
		if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 1) {
                redirect('auth');
            }
        }

        if (strcasecmp($this->uri->segment(3), 'siswa') == 0) {
            if (strcasecmp($this->uri->segment(4), 'edit') == 0 && !empty($this->uri->segment(5))) {
                if (isset($_POST['updateProfile'])) {
                    if ($this->model_admin->updateSiswaProfile($this->uri->segment(5))) {
        				$this->session->set_flashdata('notif', 'Data berhasil diperbarui!');
        				$this->session->set_flashdata('classNotif', 'success');
        			} else {
        				$this->session->set_flashdata('notif', 'Data gagal diperbarui!');
        				$this->session->set_flashdata('classNotif', 'warning');
        			}
                    redirect('admin/users/siswa');
                }

                $data = [
        			'main_view'		    => 'admin/form_edit_siswa',
        			'adminData'		    => $this->session->userdata(md5('UserData')),
                    'siswa'             => $this->model_admin->getSiswaById($this->uri->segment(5)),
                    'data_perusahaan'   => $this->model_admin->getPilihanSiswa($this->uri->segment(5))
        		];
        		$this->load->view('admin/layout', $data);
                return;
            }
            $data = [
    			'main_view'		=> 'admin/siswa',
    			'adminData'		=> $this->session->userdata(md5('UserData')),
                'xsiswa'        => $this->model_admin->getSiswaWithGroup(),
                'siswa'         => $this->model_admin->getSiswa()
    		];
    		$this->load->view('admin/layout', $data);
            // echo json_encode($data['xsiswa']);
            // var_dump($data['xsiswa']);
        }
        if (strcasecmp($this->uri->segment(3), 'guru') == 0) {
            if (strcasecmp($this->uri->segment(4), 'edit') == 0 && !empty($this->uri->segment(5))) {
                if (isset($_POST['updateProfile'])) {
                    if ($this->model_admin->updateSiswaProfile($this->uri->segment(5))) {
        				$this->session->set_flashdata('notif', 'Data berhasil diperbarui!');
        				$this->session->set_flashdata('classNotif', 'success');
        			} else {
        				$this->session->set_flashdata('notif', 'Data gagal diperbarui!');
        				$this->session->set_flashdata('classNotif', 'warning');
        			}
                    redirect('admin/users/guru');
                }

                $data = [
        			'main_view'		    => 'admin/form_edit_guru',
        			'adminData'		    => $this->session->userdata(md5('UserData')),
                    'guru'              => $this->model_admin->getGuruById($this->uri->segment(5)),
                    'data_perusahaan'   => $this->model_admin->getPilihanSiswa($this->uri->segment(5))
        		];
        		$this->load->view('admin/layout', $data);
                return;
            }
            $data = [
    			'main_view' => 'admin/guru',
    			'adminData' => $this->session->userdata(md5('UserData')),
                'guru'      => $this->model_admin->getGuru()
    		];
    		$this->load->view('admin/layout', $data);
        }
	}
}
/* End of file ${TM_FILENAME:${1/(.+)/lAdmin.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Admin/:application/controllers/${1/(.+)/lAdmin.php/}} */
