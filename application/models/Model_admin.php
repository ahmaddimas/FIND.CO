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
            $userData = $result->row_array();
            $userData['id_user'] = $result->row_array()['id_admin'];
            $this->session->set_userdata(md5('Logged_In'), true);
            $this->session->set_userdata(md5('Logged_Role'), $result->row()->role);
            $this->session->set_userdata(md5('UserData'), $userData);
            return true;
        } else {
            return false;
        }
    }

    public function getUserById($id) {
        return $this->db->where('id_admin', $id)->get('tb_admin')->row_array();
    }

    public function getPerusahaanById($id) {
        $this->db->select('*, MAX(rp.tahun_rekap) AS tahun_rekap');
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

    public function addPerusahaan($file) {
        $this->db->insert('tb_perusahaan', array(
            'nama_perusahaan'   => $this->input->post('perusahaan'),
            'telp_perusahaan'   => $this->input->post('telp'),
            'alamat'            => $this->input->post('alamat'),
            'kota'              => $this->input->post('kota'),
            'provinsi'          => $this->input->post('provinsi'),
            'fax'               => $this->input->post('fax'),
            'cp'                => $this->input->post('cp'),
            'picture_url'       => 'assets/images/'.$file['file_name']
        ));
        $id = $this->db->insert_id();
        $this->db->insert('tb_rekap_perusahaan', array(
            'id_perusahaan' => $id,
            'kuota'         => $this->input->post('kuota'),
            'tahun_rekap'   => date('Y')
        ));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusPerusahaan($id) {
        $this->db->where('id_perusahaan', $id)->delete('tb_perusahaan');
        $this->db->where('id_perusahaan', $id)->delete('tb_rekap_perusahaan');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePerusahaan($file = "") {
        $id = $this->uri->segment(4); $bool = true;
        $array = [
            'nama_perusahaan'   => $this->input->post('perusahaan'),
            'telp_perusahaan'   => $this->input->post('telp'),
            'alamat'            => $this->input->post('alamat'),
            'kota'              => $this->input->post('kota'),
            'provinsi'          => $this->input->post('provinsi'),
            'fax'               => $this->input->post('fax'),
            'cp'                => $this->input->post('cp')
        ];
        if ($file != "") {
            $current_photo = $this->db->where('id_perusahaan', $id)->get('tb_perusahaan')->row()->picture_url;
            $path = './'.$current_photo;
            unlink($path);
            $file = 'assets/images/'.$file;
            $array['picture_url'] = $file;
        }
        $this->db->where('id_perusahaan', $id)->update('tb_perusahaan', $array);
        if ($this->db->affected_rows() == 0) {
            $bool = false;
        }
        $rekap  = $this->db->where('id_perusahaan', $id)
                            ->order_by('tahun_rekap', 'desc')
                            ->limit(1)->get('tb_rekap_perusahaan')->row();
        if (date('Y') !== $rekap->tahun_rekap) {
            $this->db->insert('tb_rekap_perusahaan', array(
                'id_perusahaan' => $id,
                'kuota'         => $this->input->post('kuota'),
                'tahun_rekap'   => date('Y')
            ));
        } else {
            $this->db->where('id_rekap', $rekap->id_rekap)->update('tb_rekap_perusahaan', array(
                'kuota' => $this->input->post('kuota')
            ));
        }
        if ($this->db->affected_rows() == 0 && !$bool) {
            $bool = false;
        }
        if ($this->db->affected_rows() > 0) {
            $bool = true;
        }
        return $bool;
    }

    public function getSiswaById($id) {
        return $this->db->where('id_siswa', $id)->get('tb_siswa')->row();
    }

    public function getPilihanSiswa($id) {
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

    public function setPilihanSiswa($uid, $pid) {
        $this->db->where('id_siswa', $uid)->update('tb_perusahaan_siswa', array(
            'status'    => '-'
        ));
        $this->db->where('id_siswa', $uid)->where('id_perusahaan', $pid)->update('tb_perusahaan_siswa', array(
            'status'    => 'diterima'
        ));
        $this->db->select('rp.id_rekap');
        $this->db->from('tb_perusahaan AS p');
        $this->db->join('tb_rekap_perusahaan AS rp', 'rp.id_perusahaan = p.id_perusahaan', 'left');
        $this->db->where('rp.tahun_rekap = (SELECT MAX(tahun_rekap) FROM tb_rekap_perusahaan WHERE id_perusahaan = p.id_perusahaan)');
        $this->db->where('p.id_perusahaan', $pid);
        $rid = $this->db->get()->row()->id_rekap;
        $this->db->where('id_rekap', $rid)->set('kuota', 'kuota - 1', FALSE)->update('tb_rekap_perusahaan');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function resetPilihanSiswa($uid) {
        $psid = $this->db->where('id_siswa', $uid)->where('status', 'diterima')->get('tb_perusahaan_siswa')->row()->id_perusahaan;
        $this->db->where('id_siswa', $uid)->update('tb_perusahaan_siswa', array(
            'status'    => 'menunggu'
        ));
        $this->db->select('rp.id_rekap');
        $this->db->from('tb_perusahaan AS p');
        $this->db->join('tb_rekap_perusahaan AS rp', 'rp.id_perusahaan = p.id_perusahaan', 'left');
        $this->db->where('rp.tahun_rekap = (SELECT MAX(tahun_rekap) FROM tb_rekap_perusahaan WHERE id_perusahaan = p.id_perusahaan)');
        $this->db->where('p.id_perusahaan', $psid);
        $rid = $this->db->get()->row()->id_rekap;
        $this->db->where('id_rekap', $rid)->set('kuota', 'kuota + 1', FALSE)->update('tb_rekap_perusahaan');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function rejectPilihanSiswa($uid) {
        $this->db->where('id_siswa', $uid)->update('tb_perusahaan_siswa', array(
            'status'    => 'ditolak'
        ));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
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

    public function getSiswa() {
        $this->db->select('*, s.id_siswa AS id_siswa, s.picture_url AS picture_url');
        $this->db->from('tb_siswa AS s');
        $this->db->join('tb_perusahaan_siswa AS ps', 'ps.id_siswa = s.id_siswa', 'left');
        $this->db->join('tb_perusahaan AS p', 'p.id_perusahaan = ps.id_perusahaan', 'left');
        $this->db->join('tb_rekap_perusahaan AS rp', 'rp.id_perusahaan = p.id_perusahaan', 'left');
        $this->db->where('rp.tahun_rekap = (SELECT MAX(tahun_rekap) FROM tb_rekap_perusahaan WHERE id_perusahaan = p.id_perusahaan)');
        $this->db->order_by('s.angkatan', 'desc');
        return $this->db->get()->result();
    }

    public function addSiswa() {
        $this->db->insert('tb_siswa', array(
            'nis'   => $this->input->post('nis'),
            'nama_siswa'  => $this->input->post('nama'),
            'email_siswa'   => $this->input->post('email'),
            'kelas'         => $this->input->post('kelas'),
            'telp_siswa'    => $this->input->post('telp'),
            'jk_siswa'      => $this->input->post('jk'),
            'angkatan'      => $this->input->post('angkatan'),
            'jurusan'       => $this->input->post('jurusan')
        ));
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateSiswaProfile($id) {
        if (!empty($this->input->post('nis'))) $userData['nis'] = $this->input->post('nis');
        if (!empty($this->input->post('kelas'))) $userData['kelas'] = $this->input->post('kelas');
        if (!empty($this->input->post('telp'))) $userData['telp_siswa'] = $this->input->post('telp');
        if (!empty($userData)) {
            $this->db->where('id_siswa', $id)->update('tb_siswa', $userData);
            if ($this->db->affected_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getGuruById($id) {
        return $this->db->where('id_guru', $id)->get('tb_guru_pembimbing')->row();
    }

    public function getGuru() {
        $this->db->select('*');
        $this->db->from('tb_guru_pembimbing');
        return $this->db->get()->result();
    }

    public function updateGuruProfile($id) {
        if (!empty($this->input->post('telp'))) $userData['telp_guru'] = $this->input->post('telp');
        if (!empty($userData)) {
            $this->db->where('id_guru', $id)->update('tb_guru_pembimbing', $userData);
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
/* End of file ${TM_FILENAME:${1/(.+)/lModel_admin.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Model_admin/:application/models/${1/(.+)/lModel_admin.php/}} */
