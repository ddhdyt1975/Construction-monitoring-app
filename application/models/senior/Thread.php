<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Thread extends CI_Model {

    public function __construct() {
      parent::__construct();
    }

    public function addP($data){
        $this->db->insert("tread_main", $data);
        return $this->db->insert_id();
    }

    public function getLst($id1, $id2){
        $query = $this->db->query('SELECT
            tread_main.thread_id,
            tread_main.thread_type,
            tread_main.thread_message,
            tread_main.thread_user,
            tread_main.thread_date,
            DATE_FORMAT(tread_main.thread_date,"%h:%i %p") AS time,
            `user`.user_id,
            `user`.user_fname,
            `user`.user_mname,
            `user`.user_lname,
            `user`.user_email,
            `user`.user_address,
            `user`.user_phone,
            `user`.user_photo,
            thread_sub.thread_id2,
            thread_sub.thread_id,
            thread_sub.thread_message AS umes,
            thread_sub.thread_user,
            thread_sub.thread_date,
            user2.user_id AS uid,
            CONCAT(user2.user_fname," ",user2.user_lname) AS uName,
            user2.user_email AS uemail,
            user2.user_address AS uadd,
            user2.user_photo AS uphoto,
            thread_sub.thread_date as udate,
            DATE_FORMAT(thread_sub.thread_date,"%h:%i %p") AS time2
            FROM
            tread_main
            INNER JOIN thread_sub ON tread_main.thread_id = thread_sub.thread_id
            INNER JOIN `user` ON `user`.user_id = tread_main.thread_user
            INNER JOIN `user` AS user2 ON thread_sub.thread_user = user2.user_id
            WHERE tread_main.thread_id = "'.$id1.'" AND thread_sub.thread_id2 > "'.$id2.'"
        ');
        return $query->result();
    }

    public function addR($data){
        $this->db->insert("thread_sub", $data);
        return $this->db->insert_id();
    }

    public function getActD($id){
        $query = $this->db->query('SELECT
            tread_main.thread_id,
            tread_main.thread_type,
            tread_main.thread_message,
            tread_main.thread_user,
            tread_main.thread_date,
            DATE_FORMAT(tread_main.thread_date,"%h:%i %p") AS time,
            `user`.user_id,
            `user`.user_fname,
            `user`.user_mname,
            `user`.user_lname,
            `user`.user_email,
            `user`.user_address,
            `user`.user_phone,
            `user`.user_photo,
            thread_sub.thread_id2,
            thread_sub.thread_id,
            thread_sub.thread_message AS umes,
            thread_sub.thread_user,
            user2.user_id AS uid,
            CONCAT(user2.user_fname," ",user2.user_lname) AS uName,
            user2.user_email AS uemail,
            user2.user_address AS uadd,
            user2.user_photo AS uphoto,
            thread_sub.thread_date as udate2,
            DATE_FORMAT(thread_sub.thread_date,"%h:%i %p") AS time2
            FROM
            tread_main
            INNER JOIN thread_sub ON tread_main.thread_id = thread_sub.thread_id
            INNER JOIN `user` ON `user`.user_id = tread_main.thread_user
            INNER JOIN `user` AS user2 ON thread_sub.thread_user = user2.user_id
            WHERE tread_main.thread_id = "'.$id.'"
        ');
        return $query->result();
    }

    public function getAct(){
        $query = $this->db->query('SELECT
            tread_main.thread_id,
            tread_main.thread_type,
            tread_main.thread_message,
            tread_main.thread_user,
            tread_main.thread_date,
            `user`.user_id,
            `user`.user_fname,
            `user`.user_mname,
            `user`.user_lname,
            `user`.user_email,
            `user`.user_address,
            `user`.city_id,
            usertype.usertype_name,
            `user`.user_photo,
            `user`.registered_date,
            `user`.user_phone,
            DATE_FORMAT(thread_date,"%h:%i %p") time
            FROM
            tread_main
            INNER JOIN `user` ON tread_main.thread_user = `user`.user_id
            INNER JOIN usertype ON `user`.usertype_id = usertype.usertype_id
        ');
        return $query->result();
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
        $query = $this->db->query('SELECT *,DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate, DATE_FORMAT(registered_date,"%h:%i %p") AS time FROM `user` INNER JOIN city ON city.city_id = `user`.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id  INNER JOIN company_details ON company_details.company_id = `user`.company WHERE user_id = "'.$id['user_id'].'"');
        return $query->row();
    }
}