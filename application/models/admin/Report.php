<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Report extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
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
    
    public function getProjects($com){
        $query = $this->db->query('SELECT project_code, project_title FROM project  INNER JOIN `user` ON project.user_id = `user`.user_id WHERE user.company = "'.$com.'" ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getProjDetails($project_title) {
        $query = $this->db->query('SELECT *
            FROM
            project
            INNER JOIN city ON project.city_id = city.city_id
            INNER JOIN province ON city.province_id = province.province_id
            INNER JOIN `user` ON `user`.user_id = project.user_id
            INNER JOIN project_details ON project_details.project_code = project.project_code 
            WHERE project.project_code  = "'.$project_title.'" ');
        return $query->row();
    }

    function getEUDetails($project_title, $date, $date2,$date3) {
        $query = $this->db->query('SELECT
            equipment_used.eu_id,
            equipment_used.equipment_id,
            equipment_used.eu_date,
            equipment_used.eu_quantity,
            equipment_used.project_code,
            equipment_used.received_from,
            DATE_FORMAT(eu_date,"%m/%d/%Y"),
            equipment.equipment_name
            FROM
            equipment_used
            INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id WHERE equipment_used.project_code = "'.$project_title.'" AND DATE_FORMAT(eu_date,"%m/%d/%Y")  = "'.$date.'/'.$date2.'/'.$date3.'" GROUP BY
            equipment_used.eu_id ');
        return $query->result();
    }

    function getEUDetails1($project_title, $date, $date2,$date3) {
        $query = $this->db->query('SELECT
            equipment_used.eu_id,
            equipment_used.equipment_id,
            equipment_used.eu_date,
            equipment_used.eu_quantity,
            equipment_used.project_code,
            equipment_used.received_from,
            DATE_FORMAT(eu_date,"%m/%d/%Y"),
            equipment.equipment_name
            FROM
            equipment_used
            INNER JOIN equipment ON equipment.equipment_id = equipment_used.equipment_id  WHERE equipment_used.project_code ="'.$project_title.'" AND DATE_FORMAT(eu_date,"%m/%d/%Y")  = "'.$date.'/'.$date2.'/'.$date3.'" AND received_from = ""');
        return $query->result();
    }

    function getMUDetails($project_title, $date, $date2,$date3) {
        $query = $this->db->query('SELECT DATE_FORMAT(mu_date,"%m/%d/%Y"), material.material_name, material_used.mu_quantity, material.material_unit, material_used.received_from, unit_acro FROM material_used INNER JOIN material ON material_used.material_id = material.material_id INNER JOIN units ON material.material_unit = units.unit_id  WHERE material_used.project_code  = "'.$project_title.'" AND  DATE_FORMAT(mu_date,"%m/%d/%Y") = "'.$date.'/'.$date2.'/'.$date3.'" AND received_from = ""');
        return $query->result();
    }

    function getMUDetails2($project_title, $date, $date2,$date3) {
        $query = $this->db->query('SELECT DATE_FORMAT(mu_date,"%m/%d/%Y"),material.material_name, material_used.mu_quantity, material.material_unit, material_used.received_from, unit_acro
        FROM material_used INNER JOIN material ON material_used.material_id = material.material_id
        INNER JOIN units ON material.material_unit = units.unit_id  
        WHERE material_used.project_code  = "'.$project_title.'" AND  DATE_FORMAT(mu_date,"%m/%d/%Y") = "'.$date.'/'.$date2.'/'.$date3.'" GROUP BY
        material_used.mu_id');
        return $query->result();
    }
    
    function getActDetails($project_title, $date, $date2,$date3) {
        $query = $this->db->query('SELECT *, DATE_FORMAT(update_date,"%m/%d/%Y") FROM updated_task INNER JOIN project_task ON project_task.projtsk_id = updated_task.task_id WHERE updated_task.project_code = "'.$project_title.'" AND DATE_FORMAT(update_date,"%m/%d/%Y") = "'.$date.'/'.$date2.'/'.$date3.'" ');
        return $query->result();
    }

    function getActCom($project_title, $date, $date2,$date3) {
        $query = $this->db->query('SELECT *, DATE_FORMAT(project_task_comment.prjtsk_comment_date,"%m/%d/%Y"), project_task.projtsk_name FROM project_task_comment INNER JOIN project_dtask ON project_dtask.projdtsk_id = project_task_comment.projdtsk_id INNER JOIN project_task ON project_task.projtsk_id = project_dtask.projtsk_id WHERE DATE_FORMAT(project_task_comment.prjtsk_comment_date,"%m/%d/%Y") = "'.$date.'/'.$date2.'/'.$date3.'"  AND project_task_comment.projdtsk_id = "'.$project_title.'" ');
        return $query->result();
    }

    function getActCom2($project_title, $date, $date2,$date3) {
       $query = $this->db->query('SELECT *, DATE_FORMAT(project_task_comment.prjtsk_comment_date,"%m/%d/%Y"), project_task.projtsk_name, project_dtask.projdtsk_percent FROM project_task_comment INNER JOIN project_dtask ON project_dtask.projdtsk_id = project_task_comment.projdtsk_id INNER JOIN project_task ON project_task.projtsk_id = project_dtask.projtsk_id WHERE DATE_FORMAT(project_task_comment.prjtsk_comment_date,"%m/%d/%Y") <> "'.$date.'/'.$date2.'/'.$date3.'"  AND project_task_comment.project_code = "'.$project_title.'" ');
       return $query->result();
    }

    function getWorkDetails($project_title, $date, $date2,$date3) {
        $query = $this->db->query('SELECT
                employee_type.description
            FROM
                worker_designation
            INNER JOIN project_worker ON project_worker.pworker_id = worker_designation.pworker_id
            INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id
            WHERE
                project_code = "'.$project_title.'"
            AND DATE_FORMAT(desig_date, "%m/%d/%Y")=  "'.$date.'/'.$date2.'/'.$date3.'" 
            GROUP BY
                worker_designation.pworker_id');
        return $query->result();
    }

    function getWandTDetails($project_title, $date, $date2,$date3) {
        $query = $this->db->query('SELECT *, DATE_FORMAT(rep_date,"%m/%d/%Y") FROM `project_report` WHERE project_report.project_code = "'.$project_title.'" AND DATE_FORMAT(rep_date,"%m/%d/%Y") =   "'.$date.'/'.$date2.'/'.$date3.'"');
        return $query->result();
    }

    function getPhotoDetails($project_title, $date, $date2,$date3) {
        $query = $this->db->query('SELECT photo.photo_id, photo.project_code, photo.photo, photo.photo_upload_date, photo.photo_comment, DATE_FORMAT(photo.photo_upload_date,"%m/%d/%Y") FROM project INNER JOIN photo ON project.project_code = photo.project_code WHERE photo.project_code = "'.$project_title.'" AND DATE_FORMAT(photo.photo_upload_date,"%m/%d/%Y") =  "'.$date.'/'.$date2.'/'.$date3.'"');
        return $query->result();
    }

    function addW($where, $data, $data2){
        $this->db->from('project_report');
        $this->db->where('reportid', $data['reportid']); 
        $query = $this->db->get();
        if($query->num_rows() != 0){
            $this->db->update('project_report', $data2, $where);
            return $this->db->affected_rows();
            
        }else{
            $this->db->insert('project_report', $data);
            return $this->db->insert_id();
        }
    }

    function addWRK($data){
        $this->db->insert("worker", $data);
        return $this->db->insert_id();
    }

    public function getw_by_id($id){
        $query = $this->db->query('SELECT * FROM `worker` WHERE projdtsk_id = "'.$id.'"');
        return $query->row();
    }

    public function upW($where, $data){
        $this->db->update('worker', $data, $where);
        return $this->db->affected_rows();
    }

    function project_img($path, $userid, $d, $date, $date2, $date3 ) {
        $updateData = array('photo' => $path,
            'photo_id' => $d,
            'project_code' => $userid,
            'photo_upload_date' => $date3.'-'.$date.'-'.$date2,
        );
        $this->db->insert("photo",$updateData);
    }

    public function getph_by_id($id){
        $query = $this->db->query(' SELECT * FROM photo  WHERE photo.photo_id = "'.$id.'"');
        return $query->row();
    }


    function addPP($where, $data){
        $this->db->update('photo', $data, $where);
        return $this->db->affected_rows();
    }
    
   function getNXTDetails($project_title, $date, $date2,$date3) {
        $query = $this->db->query('SELECT DATE_FORMAT(postDate,"%m/%d/%Y"), nextdayact.project_code, nextdayact.nextAct, nextdayact.postDate, nextdayact.next_id, nextdayact.status, project_task.projtsk_name FROM nextdayact INNER JOIN project_task ON nextdayact.task = project_task.projtsk_id INNER JOIN project ON project.project_code = nextdayact.project_code WHERE DATE_FORMAT(postDate,   "%m/%d/%Y") = "'.$date.'/'.$date2.'/'.$date3.'" AND  nextdayact.project_code = "'.$project_title.'" ');
        return $query->result();
    }
}
