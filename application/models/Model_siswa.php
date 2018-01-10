<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_siswa extends CI_Model {
    public function __construct() {
        parent::__construct();
        //Do your magic here
    }

    public function checkUser($data = array()){
        $this->db->select('*');
        $this->db->from('tb_siswa');
        $this->db->where(array('email_siswa'=>$data['email']));
        $query = $this->db->get();
        $check = $query->num_rows();

        if($check > 0){
            $result = $query->row_array();
            $this->db->where('id_siswa', $result['id_siswa'])->update('tb_siswa', array(
                'oauth_uid'     => $data['id'],
                'nama_siswa'    => $data['given_name'],
                'angkatan'      => substr($data['family_name'], 0, -3),
                'jurusan'       => substr($data['family_name'], -3),
                'jk_siswa'      => !empty($data['gender'])?$data['gender']:'',
                'picture_url'   => !empty($data['picture'])?$data['picture']:''
            ));
            $userData = $result;
            $userData['id_user'] = $result['id_siswa'];
        }else{
            $this->db->insert('tb_siswa', array(
                'oauth_uid'     => $data['id'],
                'nama_siswa'    => $data['given_name'],
                'email_siswa'   => $data['email'],
                'angkatan'      => substr($data['family_name'], 0, -3),
                'jurusan'       => substr($data['family_name'], -3),
                'jk_siswa'      => !empty($data['gender'])?$data['gender']:'',
                'picture_url'   => !empty($data['picture'])?$data['picture']:''
            ));
            $userID = $this->db->insert_id();
            $userData = $this->db->where('id_siswa', $userID)->get('tb_siswa')->row_array();
            $userData['id_user'] = $userID;
        }

        return $userData;
    }

    public function getSiswaById($id) {
        return $this->db->where('id_siswa', $id)->get('tb_siswa')->row_array();
    }

    public function updateProfile() {
        if ($this->input->post('nis')) $userData['nis'] = $this->input->post('nis');
        if ($this->input->post('kelas')) $userData['kelas'] = $this->input->post('kelas');
        if ($this->input->post('telp')) $userData['telp_siswa'] = $this->input->post('telp');
        if (!empty($userData)) {
            $this->db->where('id_siswa', $this->session->userdata(md5('UserData'))['id_user'])->update('tb_siswa', $userData);
            if ($this->db->affected_rows() > 0) {
                $userData = $this->session->userdata(md5('UserData'));
                if (!$this->input->post('nis')) $userData['nis'] = $this->input->post('nis');
                if (!$this->input->post('kelas')) $userData['kelas'] = $this->input->post('kelas');
                if (!$this->input->post('telp')) $userData['telp_siswa'] = $this->input->post('telp');
                $this->session->set_userdata(md5('UserData'), $userData);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getPilihan($id) {
        $this->db->select('*');
        $this->db->from('tb_siswa AS s');
        $this->db->join('tb_perusahaan_siswa AS ps', 'ps.id_siswa = s.id_siswa', 'right');
        $this->db->join('tb_perusahaan AS p', 'p.id_perusahaan = ps.id_perusahaan', 'right');
        $this->db->join('tb_rekap_perusahaan AS rp', 'rp.id_perusahaan = p.id_perusahaan', 'left');
        $this->db->where('rp.tahun_rekap = (SELECT MAX(tahun_rekap) FROM tb_rekap_perusahaan WHERE id_perusahaan = p.id_perusahaan)');
        $this->db->where('s.id_siswa', $id);
        $this->db->group_by('p.id_perusahaan');
        $this->db->order_by('ps.indeks', 'asc');
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

    public function setPilihanPerusahaan($data) {
        $userData = $this->session->userdata(md5('UserData'));
        $current = $this->db->where('id_siswa', $userData['id_siswa'])->get('tb_perusahaan_siswa');
        $action = $current->num_rows() == 0 ? 'new':'update';
        foreach ($data as $key => $value) {
            $index = $key == 'p1' ? 1:2;
            if ($action == 'new') {
                $this->db->insert('tb_perusahaan_siswa', array(
                    'id_siswa'      => $userData['id_siswa'],
                    'id_perusahaan' => $value,
                    'indeks'        => $index,
                    'status'        => 'menunggu'
                ));
            } else {
                $this->db->where('id_siswa', $userData['id_siswa'])
                        ->where('indeks', $index)->update('tb_perusahaan_siswa', array(
                            'id_perusahaan' => $value,
                            'status'        => 'menunggu'
                        ));
            }
        }
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
/* End of file ${TM_FILENAME:${1/(.+)/lModel_siswa.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Model_siswa/:application/models/${1/(.+)/lModel_siswa.php/}} */
