<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_guru extends CI_Model {
    public function __construct() {
        parent::__construct();
        //Do your magic here
    }

    public function checkUser($data = array()){
        $this->db->select('*');
        $this->db->from('tb_guru_pembimbing');
        $this->db->where(array('email_guru'=>$data['email']));
        $query = $this->db->get();
        $check = $query->num_rows();

        if($check > 0){
            $result = $query->row_array();
            $this->db->where('id_guru', $result['id_guru'])->update('tb_guru_pembimbing',array(
                'oauth_uid'     => $data['id'],
                'nama_guru'     => $data['given_name'],
                'email_guru'    => $data['email'],
                'jk_guru'       => !empty($data['gender'])?$data['gender']:'',
                'picture_url'   => !empty($data['picture'])?$data['picture']:''
            ));
            $userData = $result;
            $userData['id_user'] = $result['id_guru'];
        }else{
            $this->db->insert('tb_guru_pembimbing' ,array(
                'oauth_uid'     => $data['id'],
                'nama_guru'     => $data['given_name'],
                'email_guru'    => $data['email'],
                'jk_guru'       => !empty($data['gender'])?$data['gender']:'',
                'picture_url'   => !empty($data['picture'])?$data['picture']:''
            ));
            $userID = $this->db->insert_id();
            $userData = $this->db->where('id_guru', $userID)->get('tb_guru_pembimbing')->row_array();
            $userData['id_user'] = $userID;
        }

        return $userData;
    }

    public function updateProfile() {
        if ($this->input->post('telp')) $userData['telp_guru'] = $this->input->post('telp');
        if (!empty($userData)) {
            $this->db->where('id_guru', $this->session->userdata(md5('UserData'))['id_user'])->update('tb_guru_pembimbing', $userData);
            if ($this->db->affected_rows() > 0) {
                $userData = $this->session->userdata(md5('UserData'));
                if ($this->input->post('telp')) $userData['telp_guru'] = $this->input->post('telp');
                $this->session->set_userdata(md5('UserData'), $userData);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getGuru() {
        $this->db->select('*, g.id_guru AS id_guru');
        $this->db->from('tb_guru_pembimbing AS g');
        $this->db->join('tb_guru_perusahaan AS gp', 'gp.id_guru = g.id_guru', 'left');
        $this->db->group_by('g.id_guru');
        return $this->db->get()->result();
    }

    public function getGuruByIdWithGroup($id) {
        $this->db->select('*, g.id_guru AS id_guru');
        $this->db->from('tb_guru_pembimbing AS g');
        $this->db->join('tb_guru_perusahaan AS gp', 'gp.id_guru = g.id_guru', 'left');
        $this->db->where('g.id_guru', $id);
        $this->db->group_by('g.id_guru');
        return $this->db->get()->row_array();
    }

    public function getBimbingan($id) {
        $this->db->select('*, g.id_guru AS id_guru');
        $this->db->from('tb_guru_pembimbing AS g');
        $this->db->join('tb_guru_perusahaan AS gp', 'gp.id_guru = g.id_guru', 'right');
        $this->db->join('tb_perusahaan AS p', 'p.id_perusahaan = gp.id_perusahaan', 'right');
        $this->db->join('tb_rekap_perusahaan AS rp', 'rp.id_perusahaan = p.id_perusahaan', 'left');
        $this->db->where('rp.tahun_rekap = (SELECT MAX(tahun_rekap) FROM tb_rekap_perusahaan WHERE id_perusahaan = p.id_perusahaan)');
        $this->db->where('g.id_guru', $id);
        return $this->db->get()->result();
    }

    public function getPerusahaanById($id) {
        $this->db->select('*');
        $this->db->from('tb_perusahaan AS p');
        $this->db->join('tb_rekap_perusahaan AS rp', 'rp.id_perusahaan = p.id_perusahaan', 'left');
        $this->db->where('rp.tahun_rekap = (SELECT MAX(tahun_rekap) FROM tb_rekap_perusahaan WHERE id_perusahaan = p.id_perusahaan)');
        $this->db->where('p.id_perusahaan', $id);
        $this->db->group_by('p.id_perusahaan');
        return $this->db->get()->row();
    }

    public function getPerusahaan() {
        $this->db->select('*');
        $this->db->from('tb_perusahaan AS p');
        $this->db->join('tb_rekap_perusahaan AS rp', 'rp.id_perusahaan = p.id_perusahaan', 'left');
        $this->db->where('rp.tahun_rekap = (SELECT MAX(tahun_rekap) FROM tb_rekap_perusahaan WHERE id_perusahaan = p.id_perusahaan)');
        $this->db->group_by('p.id_perusahaan');
        return $this->db->get()->result();
    }

    public function getSiswaWithGroup() {
        $this->db->select('*, s.id_siswa AS id_siswa, s.picture_url AS picture_url');
        $this->db->from('tb_siswa AS s');
        $this->db->join('tb_perusahaan_siswa AS ps', 'ps.id_siswa = s.id_siswa', 'left');
        $this->db->join('tb_perusahaan AS p', 'p.id_perusahaan = ps.id_perusahaan', 'left');
        $this->db->group_by('s.id_siswa');
        $this->db->order_by('s.angkatan', 'desc');
        return $this->db->get()->result();
    }

    public function getSiswaDibimbing() {
        $this->db->select('*, g.id_guru AS id_guru');
        $this->db->from('tb_guru_pembimbing AS g');
        $this->db->join('tb_guru_perusahaan AS gp', 'gp.id_guru = g.id_guru', 'right');
        $this->db->join('tb_perusahaan_siswa AS ps', 'ps.id_perusahaan = gp.id_perusahaan', 'right');
        $this->db->join('tb_siswa AS s', 's.id_siswa = ps.id_siswa', 'left');
        $this->db->where('ps.status', 'diterima');
        $this->db->where('g.id_guru', $this->session->userdata(md5('UserData'))['id_user']);
        return $this->db->get()->result();
    }

    public function getDataMonitoring() {
        $this->db->select('*');
        $this->db->from('tb_monitoring AS m');
        $this->db->join('tb_guru_pembimbing AS g', 'g.id_guru = m.id_guru', 'left');
        $this->db->join('tb_perusahaan AS p', 'p.id_perusahaan = m.id_perusahaan', 'left');
        $this->db->where('m.id_guru', $this->session->userdata(md5('UserData'))['id_user']);
        return $this->db->get()->result();
    }

    public function getDataMonitoringById($id) {
        $this->db->select('*');
        $this->db->from('tb_monitoring AS m');
        $this->db->join('tb_guru_pembimbing AS g', 'g.id_guru = m.id_guru', 'left');
        $this->db->join('tb_perusahaan AS p', 'p.id_perusahaan = m.id_perusahaan', 'left');
        $this->db->where('m.id_monitoring', $id);
        return $this->db->get()->row();
    }

    public function addMonitoring() {
        $this->db->insert('tb_monitoring', array(
            'id_guru'       => $this->session->userdata(md5('UserData'))['id_user'],
            'tgl_monitoring'=> $this->input->post('tgl_monitoring'),
            'id_perusahaan' => $this->input->post('nama_perusahaan'),
            'keterangan'       => $this->input->post('keterangan')
        ));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateMonitoring($id) {
        if ($this->input->post('telp') != "") $userData['telp_guru'] = $this->input->post('telp');
        if (!empty($userData)) {
            $this->db->where('id_monitoring', $id)->update('tb_monitoring', $userData);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
/* End of file ${TM_FILENAME:${1/(.+)/lModel_guru.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Model_guru/:application/models/${1/(.+)/lModel_guru.php/}} */
