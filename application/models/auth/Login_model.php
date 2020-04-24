<?php

class Login_model extends CI_Model {
	function validate($data) {

		$condition = "user.usertype_id = usertype.usertype_id AND " . "user_email =" . "'" . $data['username'] . "' AND " . "user_password =" . "'" . $data['password'] . "'" ;

		$this->db->select('*');
		$this->db->from('user,usertype');
		$this->db->where($condition);

		$query = $this->db->get();

		// if($query->num_rows() == 1) {
		 	return $query->result();
		// }
		// else {
		// 	return NULL;
		// }

		print_r($query->result());

	}

	function validate2($data) {

		$condition = "user.usertype_id = usertype.usertype_id AND " . "user_email =" . "'" . $data['username'] . "' " ;

		$this->db->select('*');
		$this->db->from('user,usertype');
		$this->db->where($condition);

		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query->result();
		}
		else {
			return NULL;
		}


	}


	function insertDatang($where, $userData, $userData2){
		$this->db->select('*'); 
		$this->db->from('user');
        $this->db->where('user.user_id', $where['user_id']); 
        $query2 = $this->db->get();

        if($query2 ->num_rows() > 0){
            $this->db->update('user', $userData2, $where);
            return $this->db->affected_rows();
        }else{
            $this->db->insert('user', $userData);
			return $this->db->insert_id();
        }    	
	}
}
?>
