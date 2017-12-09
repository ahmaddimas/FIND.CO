<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('google');
        $this->load->model('model_siswa');
        $this->load->model('model_admin');
    }

    public function index() {
        if ($this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) === 'usiswa') {
                redirect('Siswa');
            }
        }

        if (isset($_GET['code'])) {
            // authenticate user
            $this->google->getAuthenticate();
            //get user info from google
            $gpInfo = $this->google->getUserInfo();
            // set user role from email
            $emailp = substr($gpInfo['email'], strpos($gpInfo['email'], '@'));
            if (strpos($emailp, 'smktelkom-mlg.sch.id') !== false) {
                $role = strpos($emailp, 'student') !== false ? 'usiswa':'uguru';
                //preparing data for database insertion
                if ($role === 'usiswa') {
                    // insert or update user data to the database
                    $userData = $this->model_siswa->checkUser($gpInfo);
                } else {
                    $userData['nama_guru']     = $gpInfo['given_name'];
                    $userData['email_guru']    = $gpInfo['email'];

                    // insert or update user data to the database
                    // $userID = $this->model_siswa->checkUser($userData);
                }
                // store status & user info in session
                $this->session->set_userdata(md5('Logged_In'), true);
                $this->session->set_userdata(md5('Logged_Role'), $role);
                $this->session->set_userdata(md5('UserData'), $userData);
                //redirect to profile page
                redirect('Auth');
                // echo json_encode($gpInfo);
                // return;
            } else {
                $this->load->view('error_login');
                return;
            }
        }
        // redirect to google login page
        redirect($this->google->loginURL());
    }

    public function LogInAdmin() {
        if ($this->session->userdata(md5('Logged_In'))) {
            if ($this->session->userdata(md5('Logged_Role')) === 'uroot') {
                redirect('Admin');
            }else {
                redirect('Auth');
            }
        }

        if (isset($_POST['AdminLogin'])) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run()) {
                if ($this->model_admin->checkUser()) {
                    redirect('Admin');
                } else {
                    $this->session->set_flashdata('notif', 'Gagal Login!');
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
            }
        }

        $this->load->view('admin/v_login');
    }

    public function Logout() {
        //delete login status & user info from session
        $this->session->unset_userdata(md5('Logged_In'));
        $this->session->unset_userdata(md5('Logged_Role'));
        $this->session->unset_userdata(md5('UserData'));
        $this->session->sess_destroy();

        //redirect to login page
        redirect('Auth');
    }
}
/* End of file ${TM_FILENAME:${1/(.+)/lAuth.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Auth/:application/controllers/${1/(.+)/lAuth.php/}} */
