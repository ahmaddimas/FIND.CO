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
}
/* End of file ${TM_FILENAME:${1/(.+)/lModel_admin.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Model_admin/:application/models/${1/(.+)/lModel_admin.php/}} */