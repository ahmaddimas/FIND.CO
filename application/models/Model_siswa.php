<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_siswa extends CI_Model {
    public function checkUser($data = array()){
        $this->db->select('*');
        $this->db->from('tb_siswa');
        $this->db->where(array('oauth_uid'=>$data['id']));
        $query = $this->db->get();
        $check = $query->num_rows();

        if($check > 0){
            $result = $query->row_array();
            // $data['modified'] = date("Y-m-d H:i:s");
            // $update = $this->db->update($this->tableName,$data,array('id'=>$result['id']));
            $userData = $result;
            $userData['id_user'] = $result['id_siswa'];
        }else{
            // $data['created'] = date("Y-m-d H:i:s");
            // $data['modified']= date("Y-m-d H:i:s");
            $insert = $this->db->insert('tb_siswa',array(
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

    public function updateProfile() {
        if (!empty($this->input->post('nis'))) $userData['nis'] = $this->input->post('nis');
        if (!empty($this->input->post('kelas'))) $userData['kelas'] = $this->input->post('kelas');
        if (!empty($this->input->post('telp'))) $userData['telp_siswa'] = $this->input->post('telp');
        $this->db->where('id_siswa', $this->session->userdata(md5('UserData'))['id_user'])->update('tb_siswa', $userData);
        if ($this->db->affected_rows() > 0) {
            $userData = $this->session->userdata(md5('UserData'));
            if (!empty($this->input->post('nis'))) $userData['nis'] = $this->input->post('nis');
            if (!empty($this->input->post('kelas'))) $userData['kelas'] = $this->input->post('kelas');
            if (!empty($this->input->post('telp'))) $userData['telp_siswa'] = $this->input->post('telp');
            $this->session->set_userdata(md5('UserData'), $userData);
            return true;
        } else {
            return false;
        }
    }

    public function getPilihan($id) {
        $this->db->select('p.id_perusahaan, p.nama_perusahaan, p.kota, p.telp_perusahaan, rp.kuota');
        $this->db->from('tb_siswa AS s');
        $this->db->join('tb_perusahaan_siswa AS ps', 'ps.id_siswa = s.id_siswa', 'inner');
        $this->db->join('tb_perusahaan AS p', 'p.id_perusahaan = ps.id_perusahaan', 'inner');
        $this->db->join('tb_rekap_perusahaan AS rp', 'rp.id_perusahaan = p.id_perusahaan', 'inner');
        $this->db->where('s.id_siswa', $id);
        return $this->db->get()->row_array();
    }
}
/* End of file ${TM_FILENAME:${1/(.+)/lModel_siswa.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Model_siswa/:application/models/${1/(.+)/lModel_siswa.php/}} */
