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
			'main_view'		=> 'admin/dashboard',
			'adminData'		=> $this->session->userdata(md5('UserData')),
            'xsiswa'        => $this->model_admin->getSiswaWithGroup(),
            'siswa'         => $this->model_admin->getSiswa(),
            'perusahaan'    => $this->model_admin->getPerusahaan(),
            'rekap'         => $this->model_admin->getRekapPerusahaan(),
            'guru'          => $this->model_admin->getGuru(),
            'monitoring'    => $this->model_admin->getMonitoring()
		];
		$this->load->view('admin/layout', $data);
	}

	public function About() {
        if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 1) {
                redirect('auth');
            }
        }

		$data = [
			'main_view'			=> 'about',
			'adminData'		=> $this->session->userdata(md5('UserData')),
		];
		$this->load->view('admin/layout', $data);
	}

    public function Profile() {
        if (!$this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) !== 1) {
                redirect('auth');
            }
        }

		if (isset($_POST['updateProfile'])) {
            if ($this->input->post('currentPassword') || $this->input->post('newPassword')) {
                $this->form_validation->set_rules('currentPassword', 'Current Password', 'trim|required');
                $this->form_validation->set_rules('newPassword', 'New Password', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('notif', validation_errors());
                    $this->session->set_flashdata('classNotif', 'warning');
                }
            }
            if ($this->model_admin->updateProfile()) {
                $this->session->set_flashdata('notif', 'Data berhasil diperbarui!');
                $this->session->set_flashdata('classNotif', 'success');
            } else {
                $this->session->set_flashdata('notif', 'Data gagal diperbarui!');
                $this->session->set_flashdata('classNotif', 'warning');
            }
            redirect('admin/profile');
		}

		$data = [
			'main_view'			=> 'admin/profile',
			'adminData'			=> $this->model_admin->getUserById($this->session->userdata(md5('UserData'))['id_user'])
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
            if ($this->uri->segment(4) != "") {
                if (isset($_POST['updateIndustry'])) {
                    $config['upload_path'] = './assets/images/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['max_size']  = '2048';
                    $this->load->library('upload', $config);
                    if ($_FILES['image']['name'] != "") {
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
        if (strcasecmp($uri3, 'hapus') == 0 && $this->uri->segment(4) != "" && $this->session->userdata(md5('Logged_Role')) == 2) {
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
            // ajax request siswa
            if (strcasecmp($this->uri->segment(4), 'get') == 0) {
                $response['statusCode'] = 0;
                if (isset($_GET['uid'])) {
                    $result = $this->model_admin->getPilihanSiswa(substr($_GET['uid'], 1));
                    if (!empty($result)) {
                        $response = $result;
                        $response['statusCode'] = 1;
                    }
                }
                echo json_encode($response);
                return;
            }
            // ajax post for set siswa
            if (strcasecmp($this->uri->segment(4), 'set') == 0 && $this->session->userdata(md5('Logged_Role')) == 1) {
                $response['statusCode'] = 0;
                if (isset($_POST['uid']) && isset($_POST['pid'])) {
                    if ($this->model_admin->setPilihanSiswa(substr($_POST['uid'], 1), $_POST['pid'])) {
                        $response['statusCode'] = 1;
                    }
                }
                echo json_encode($response);
                return;
            }
            // ajax post for reset siswa
            if (strcasecmp($this->uri->segment(4), 'reset') == 0 && $this->session->userdata(md5('Logged_Role')) == 1) {
                $response['statusCode'] = 0;
                if (isset($_POST['uid'])) {
                    if ($this->model_admin->resetPilihanSiswa(substr($_POST['uid'], 1))) {
                        $response['statusCode'] = 1;
                    }
                }
                echo json_encode($response);
                return;
            }
            // ajax post for reject siswa
            if (strcasecmp($this->uri->segment(4), 'reject') == 0 && $this->session->userdata(md5('Logged_Role')) == 1) {
                $response['statusCode'] = 0;
                if (isset($_POST['uid'])) {
                    if ($this->model_admin->rejectPilihanSiswa(substr($_POST['uid'], 1))) {
                        $response['statusCode'] = 1;
                    }
                }
                echo json_encode($response);
                return;
            }
            // delete siswa
            if (strcasecmp($this->uri->segment(4), 'delete') == 0 && $this->uri->segment(5) != "" && $this->session->userdata(md5('Logged_Role')) == 2) {
                if ($this->model_admin->deleteSiswa($this->uri->segment(5))) {
                    $this->session->set_flashdata('notif', 'Siswa berhasil dihapus!');
                    $this->session->set_flashdata('classNotif', 'success');
                } else {
                    $this->session->set_flashdata('notif', 'Siswa gagal dihapus!');
                    $this->session->set_flashdata('classNotif', 'warning');
                }
                redirect('admin/users/siswa');
            }
            if (strcasecmp($this->uri->segment(4), 'tambah') == 0) {
                if (isset($_POST['addProfile'])) {
                    if ($this->model_admin->addSiswa()) {
        				$this->session->set_flashdata('notif', 'Data berhasil ditambahkan!');
        				$this->session->set_flashdata('classNotif', 'success');
        			} else {
        				$this->session->set_flashdata('notif', 'Data gagal ditambahkan!');
        				$this->session->set_flashdata('classNotif', 'warning');
        			}
                    redirect('admin/users/siswa');
                }

                $data = [
        			'main_view'		    => 'admin/form_siswa',
        			'adminData'		    => $this->session->userdata(md5('UserData'))
        		];
        		$this->load->view('admin/layout', $data);
                return;
            }
            if (strcasecmp($this->uri->segment(4), 'edit') == 0 && $this->uri->segment(5) != "") {
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
            // ajax post for set guru
            if (strcasecmp($this->uri->segment(4), 'set') == 0 && $this->session->userdata(md5('Logged_Role')) == 1) {
                $response['statusCode'] = 0;
                if (isset($_POST['uid']) && isset($_POST['pid'])) {
                    if ($this->model_admin->setGuruPembimbing(substr($_POST['uid'], 1), $_POST['pid'])) {
                        $response['statusCode'] = 1;
                    }
                }
                echo json_encode($response);
                return;
            }
            // ajax post for reset guru
            if (strcasecmp($this->uri->segment(4), 'reset') == 0 && $this->session->userdata(md5('Logged_Role')) == 1) {
                $response['statusCode'] = 0;
                if (isset($_POST['uid'])) {
                    if ($this->model_admin->resetGuruPembimbing(substr($_POST['uid'], 1))) {
                        $response['statusCode'] = 1;
                    }
                }
                echo json_encode($response);
                return;
            }
            // delete guru
            if (strcasecmp($this->uri->segment(4), 'delete') == 0 && $this->uri->segment(5) != "" && $this->session->userdata(md5('Logged_Role')) == 2) {
                if ($this->model_admin->deleteGuru($this->uri->segment(5))) {
                    $this->session->set_flashdata('notif', 'Guru berhasil dihapus!');
                    $this->session->set_flashdata('classNotif', 'success');
                } else {
                    $this->session->set_flashdata('notif', 'Guru gagal dihapus!');
                    $this->session->set_flashdata('classNotif', 'warning');
                }
                redirect('admin/users/guru');
            }
            if (strcasecmp($this->uri->segment(4), 'tambah') == 0) {
                if (isset($_POST['addProfile'])) {
                    if ($this->model_admin->addGuru()) {
                        $this->session->set_flashdata('notif', 'Data berhasil ditambahkan!');
                        $this->session->set_flashdata('classNotif', 'success');
                    } else {
                        $this->session->set_flashdata('notif', 'Data gagal ditambahkan!');
                        $this->session->set_flashdata('classNotif', 'warning');
                    }
                    redirect('admin/users/guru');
                }

                $data = [
                    'main_view'         => 'admin/form_guru',
                    'adminData'         => $this->session->userdata(md5('UserData'))
                ];
                $this->load->view('admin/layout', $data);
                return;
            }
            if (strcasecmp($this->uri->segment(4), 'edit') == 0 && $this->uri->segment(5) != "") {
                if (isset($_POST['updateProfile'])) {
                    if ($this->model_admin->updateGuruProfile($this->uri->segment(5))) {
        				$this->session->set_flashdata('notif', 'Data berhasil diperbarui!');
        				$this->session->set_flashdata('classNotif', 'success');
        			} else {
        				$this->session->set_flashdata('notif', 'Data gagal diperbarui!');
        				$this->session->set_flashdata('classNotif', 'warning');
        			}
                    redirect('admin/users/guru');
                }

                $data = [
        			'main_view'		=> 'admin/form_edit_guru',
        			'adminData'		=> $this->session->userdata(md5('UserData')),
                    'guru'          => $this->model_admin->getGuruByIdWithGroup($this->uri->segment(5)),
                    'dataGuru'      => $this->model_admin->getGuruById($this->uri->segment(5))
        		];
        		$this->load->view('admin/layout', $data);
                return;
            }
            $data = [
    			'main_view'     => 'admin/guru',
    			'adminData'     => $this->session->userdata(md5('UserData')),
                'guru'          => $this->model_admin->getGuru(),
                'perusahaan'    => $this->model_admin->getPerusahaanForGuru()
    		];
    		$this->load->view('admin/layout', $data);
        }
	}
}
/* End of file ${TM_FILENAME:${1/(.+)/lAdmin.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Admin/:application/controllers/${1/(.+)/lAdmin.php/}} */
