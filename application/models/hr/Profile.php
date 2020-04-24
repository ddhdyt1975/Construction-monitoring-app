<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Profile extends CI_Model {

  var $table = 'user';

    public function __construct() {
        parent::__construct();
    }

    public function getData($id){
         $query = $this->db->query('SELECT *,
            DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate,
            DATE_FORMAT(registered_date,"%h:%i %p") AS time
            FROM
            `user`
            INNER JOIN city ON city.city_id = `user`.city_id
            INNER JOIN province ON province.province_id = city.province_id
            INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id
            INNER JOIN company_details ON company_details.company_id = `user`.company
            WHERE user_id ="'.$id.'"');
         return $query->row();
    }

    public function getp_by_id($id) { 
        $query = $this->db->query('SELECT *,DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate, DATE_FORMAT(registered_date,"%h:%i %p") AS time FROM `user` INNER JOIN city ON city.city_id = `user`.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id INNER JOIN company_details ON company_details.company_id = `user`.company WHERE user_id = "'.$id.'"');
        return $query->row();
    }

    function getCity(){
        $query = $this->db->query('SELECT * FROM city INNER JOIN province ON city.province_id = province.province_id ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }


    function user_img($path, $userid) {
        $updateData = array('user_photo' => $path);
        $userid2 = array('user_id' => $userid);
        $this->db->update("user", $updateData, $userid2);
        return $this->db->affected_rows();
    }

    public function update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function fetch_pwrod($userid){

        $query = $this->db->query('SELECT user_password FROM  user WHERE user_id = "'.$userid.'" ');

        return $query->row();
    }

    function update_pword($user_id,$newPword, $email) {

        $updateData = array('user_password' => $newPword,
            'user_email' => $email
            );
        $this->db->where("user_id",$user_id);
        $this->db->update("user",$updateData);
    }  
    
}