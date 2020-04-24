<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Attendance extends CI_Model {

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
        $query = $this->db->query('SELECT *,DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate, DATE_FORMAT(registered_date,"%h:%i %p") AS time FROM `user` INNER JOIN city ON city.city_id = `user`.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id INNER JOIN company_details ON company_details.company_id = `user`.company WHERE user_id = "'.$id['user_id'].'"');
        return $query->row();
    }


    function getAllProjects($data) {
        $condition = "user_id =" . "'" . $data['user_id'] . "'" ;
        $this->db->select('project_title,project_code');
        $this->db->from('project');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result();
    }

    function getCity(){
        $query = $this->db->query('SELECT * FROM city INNER JOIN province ON city.province_id = province.province_id');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getAllWorkerType(){
        $query = $this->db->query('SELECT   * FROM  worker_type ');
        return $query->result();
    }

    public function savewt($data){
        $this->db->insert('worker_type', $data);
        return $this->db->insert_id();
    }

    public function saveworker($data){
        $this->db->insert('project_worker', $data);
        return $this->db->insert_id();
    }

    public function updateworker($where, $data){
        $this->db->update('project_worker', $data, $where);
        return $this->db->affected_rows(); 
    }


    public function countworker(){
        $query = $this->db->query('SELECT project_worker.pworker_id AS id FROM   project_worker ORDER BY project_worker.pworker_id DESC LIMIT 1');
        return $query->row('id');
    }
    
    public function get_worker_id($id){
        $query = $this->db->query('SELECT * FROM project_worker WHERE user_id = "'.$id['user_id'].'"');
        return $query->result();
    }

    public function get_worker_id2($id, $date, $date2, $date3, $proj){
        $query = $this->db->query('SELECT
                                    project_worker.pworker_fname,
                                    project_worker.pworker_lname,
                                    project_worker.pworker_mname,
                                    worker_type.woker_type_desc,
                                    worker_designation.pworker_id AS desig_id,
                                    worker_designation.desig_date,
                                    project_worker.pworker_id
                                    FROM
                                    worker_designation
                                    INNER JOIN project_worker ON worker_designation.pworker_id = project_worker.pworker_id
                                    INNER JOIN worker_type ON worker_designation.worker_type_id = worker_type.worker_type_id
                                    INNER JOIN project ON project.project_code = worker_designation.project_code
                                    WHERE  project_worker.user_id ="'.$id['user_id'].'" AND DATE_FORMAT(desig_date,"%m/%d/%Y") = "'.$date.'/'.$date2.'/'.$date3.'" AND worker_designation.project_code = "'.$proj.'" ');
        return $query->result();
    }

    public function checkD($pid, $date, $date2, $date3){
        $query = $this->db->query('SELECT
            *
            FROM
            project_worker
            INNER JOIN worker_designation ON worker_designation.pworker_id = project_worker.pworker_id
            WHERE DATE_FORMAT(desig_date,"%m/%d/%Y") = "'.$date.'/'.$date2.'/'.$date3.'" AND worker_designation.pworker_id = "'.$pid.'"  ');

        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    public function getWorker($id){
        $query = $this->db->query('SELECT * FROM project_worker INNER JOIN city ON project_worker.city_id = city.city_id INNER JOIN province ON city.province_id = province.province_id WHERE pworker_id = "'.$id.'"');
        return $query->result();
    }

    public function getWorkerAss($id, $date1, $date2, $date3){
        $query = $this->db->query('SELECT
            *,
            DATE_FORMAT(desig_date,"%m/%d/%Y") AS datee
            FROM
            project_worker
            INNER JOIN worker_designation ON worker_designation.pworker_id = project_worker.pworker_id
            INNER JOIN project ON worker_designation.project_code = project.project_code
            INNER JOIN worker_type ON worker_designation.worker_type_id = worker_type.worker_type_id
            INNER JOIN city ON city.city_id = project_worker.city_id
            INNER JOIN province ON province.province_id = city.province_id
            WHERE DATE_FORMAT(desig_date,"%m/%d/%Y") = "'.$date1.'/'.$date2.'/'.$date3.'" AND worker_designation.pworker_id = "'.$id.'"  ');
        return $query->result();
    }
   
    function worker_img($path, $userid) {

        $updateData = array('worker_photo' => $path);

        $this->db->where("pworker_id",$userid);
        $this->db->update("project_worker",$updateData);
    }
    
    function designateworker($data){
        $this->db->insert('worker_designation', $data);
        return $this->db->insert_id();
    }

    function designateworkerTrans($where,$data1,$data2,$data3){
        
        $this->db->update("worker_designation", $data1, $where);
        $this->db->update("worker_designation", $data2, $where);
        $this->db->update("worker_designation", $data3, $where);
        return $this->db->insert_id();
    }
}