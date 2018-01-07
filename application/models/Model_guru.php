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
}
/* End of file ${TM_FILENAME:${1/(.+)/lModel_guru.php/}} */
/* Location: ./${TM_FILEPATH/.+((?:application).+)/Model_guru/:application/models/${1/(.+)/lModel_guru.php/}} */
