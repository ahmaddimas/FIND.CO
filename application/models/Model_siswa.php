<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model_siswa extends CI_Model {
    public function checkUser($data = array()){
        $this->db->select('*');
        $this->db->from('tb_siswa');
        $this->db->where(array('oauth_uid'=>$data['oauth_uid']));
        $query = $this->db->get();
        $check = $query->num_rows();

        if($check > 0){
            $result = $query->row_array();
            // $data['modified'] = date("Y-m-d H:i:s");
            // $update = $this->db->update($this->tableName,$data,array('id'=>$result['id']));
            $userID = $result['id_siswa'];
        }else{
            // $data['created'] = date("Y-m-d H:i:s");
            // $data['modified']= date("Y-m-d H:i:s");
            $insert = $this->db->insert('tb_siswa',$data);
            $userID = $this->db->insert_id();
        }

        return $userID?$userID:false;
    }
}
/* End of file ${TM_FILENAME:${1/(.+)/lModel_siswa.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Model_siswa/:application/models/${1/(.+)/lModel_siswa.php/}} */
