<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_admin extends CI_Model {
    public function __construct() {
        parent::__construct();
        //Do your magic here
    }

    public function checkUser() {
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', sha1($this->input->post('password')));
        $result = $this->db->get('tb_admin');
        if ($result->num_rows() === 1) {
            $this->session->set_userdata(md5('Logged_In'), true);
            $this->session->set_userdata(md5('Logged_Role'), $result->row()->role);
            $this->session->set_userdata(md5('UserData'), $result->row_array());
            return true;
        } else {
            return false;
        }
    }

    public function getPerusahaan() {
        $this->db->select('*, MAX(rp.tahun_rekap) AS tahun_rekap');
        $this->db->from('tb_perusahaan AS p');
        $this->db->join('tb_rekap_perusahaan AS rp', 'rp.id_perusahaan = p.id_perusahaan', 'left');
        $this->db->group_by('p.id_perusahaan');
        return $this->db->get()->row();
    }
}
/* End of file ${TM_FILENAME:${1/(.+)/lModel_admin.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Model_admin/:application/models/${1/(.+)/lModel_admin.php/}} */
