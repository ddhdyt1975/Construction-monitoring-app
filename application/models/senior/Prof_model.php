<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Prof_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function view_m($data){
        $query = $this->db->query('SELECT
                                    project_request.request_id,
                                    project.project_code,
                                    project_request.request_severity,
                                    project.project_title AS p1,
                                    project_request.req_date,
                                    p2.project_title,
                                    user1.user_fname,
                                    user1.user_lname,
                                    user1.user_photo
                                    FROM
                                    project_request
                                    INNER JOIN project ON project_request.req_from = project.project_code
                                    INNER JOIN `user` ON `user`.user_id = project.user_id
                                    INNER JOIN project AS p2 ON p2.project_code = project_request.req_to
                                    INNER JOIN `user` AS user1 ON user1.user_id = p2.user_id
                                    INNER JOIN usertype ON usertype.usertype_id = user1.usertype_id
                                    WHERE
                                    project.user_id = "'.$data.'"');
        return $query->result();
    }
    
    public function count_rr($data){
        $query = $this->db->query('SELECT
                                    project_request.request_id,
                                    project.project_code,
                                    project.user_id
                                    FROM
                                    project_request
                                    INNER JOIN project ON project_request.req_from = project.project_code
                                    WHERE
                                    project.user_id = "'.$data.'"');
        return $query->num_rows();
    }
    
    public function getData($id){
        $query = $this->db->query('SELECT *,DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate, DATE_FORMAT(registered_date,"%h:%i %p") AS time FROM `user` INNER JOIN city ON city.city_id = `user`.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id  INNER JOIN company_details ON company_details.company_id = `user`.company  WHERE user_id = "'.$id['user_id'].'"');
        return $query->row();
    }
    function user_details($user_id) {
        $userid = $user_id;
        $query = $this->db->query('SELECT * FROM  user WHERE user_id = "'.$user_id.'" ');
        return $query->row();
    }

    function getCity(){
        $query = $this->db->query('SELECT * FROM city NATURAL JOIN province');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function user_img($path, $userid) {
        $updateData = array('user_photo' => $path);
        $this->db->where("user_id",$userid);
        $this->db->update("user",$updateData);
    }
    
    function update_prof($user_id,$data) {
        $this->db->where("user_id",$user_id);
        $this->db->update("user",$data);
    } 
    
    function update_mail($user_id,$mail) {
        $updateData = array('user_email' => $mail );
        $this->db->where("user_id",$user_id);
        $this->db->update("user",$updateData);
    }
    
    function fetch_pwrod($userid){
        $query = $this->db->query('SELECT user_password FROM  user WHERE user_id = "'.$userid.'" ');
        return $query->row();
    }
    
    function update_pword($user_id,$newPword) {
        $updateData = array('user_password' => $newPword);
        $this->db->where("user_id",$user_id);
        $this->db->update("user",$updateData);
    }  
}
