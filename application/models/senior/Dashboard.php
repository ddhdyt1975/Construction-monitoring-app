<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Dashboard extends CI_Model {

    public function __construct() {
      parent::__construct();
    }

    public function getData($id){
        $query = $this->db->query('SELECT *,DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate, DATE_FORMAT(registered_date,"%h:%i %p") AS time FROM `user` INNER JOIN city ON city.city_id = `user`.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id INNER JOIN company_details ON company_details.company_id = `user`.company WHERE user_id = "'.$id['user_id'].'"');
        return $query->row();
    }

    public function count_all1($data, $com){
        $query = $this->db->query('SELECT * FROM project INNER JOIN user ON project.user_id = user.user_id WHERE user.company = "'.$com.'" ');
        return $query->num_rows();
    }

   
    public function count_all5($data, $com){
        $query = $this->db->query('SELECT COUNT(`user`.user_id) AS total FROM `user` WHERE `user`.user_id NOT IN ("'.$data['user_id'].'") 
            AND `user`.company = "'.$com.'"
            AND `user`.usertype_id NOT IN ("super")');
        return $query->row('total');
    }
  
   

    function get_datatables($data, $com){
        $query = $this->db->query('SELECT project.project_code, project.project_title, project.project_desc,CONCAT(`user`.user_fname," ",`user`.user_lname) AS PM, CONCAT(project.project_address,", ",city.city_name,", ",province.province_name,", ",province.zip_code) AS addr FROM project INNER JOIN city ON city.city_id = project.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN `user` ON `user`.user_id = project.user_id  WHERE user.company = "'.$com.'" ');
        return $query->result();
    }

   
    function get_datatables5($data, $com){
        $query = $this->db->query('SELECT CONCAT(user.user_fname,"  ",user.user_lname) AS name, user.user_email, usertype.usertype_name, CONCAT(user.user_address,", ",city.city_name,", ",province.province_name,", ",province.zip_code) AS addr, `user`.user_photo  FROM user INNER JOIN usertype ON usertype.usertype_id = user.usertype_id INNER JOIN city ON user.city_id = city.city_id INNER JOIN province ON city.province_id = province.province_id WHERE `user`.user_id NOT IN ("'.$data['user_id'].'") AND `user`.company = "'.$com.'" AND `user`.usertype_id NOT IN ("super")');
        return $query->result();
    }

    public function getTasks($id){
        $query = $this->db->query('SELECT project.project_code,project_dtask.projdtsk_id, project_task.projtsk_id, project.project_title, project.project_desc, project.project_status, project_task.projtsk_name, project_dtask.projdtsk_percent, project_dtask.projdtsk_date,project_dtask.projdtsk_update  FROM project_task INNER JOIN project_dtask ON project_task.projtsk_id = project_dtask.projtsk_id INNER JOIN project ON project.project_code = project_dtask.project_code AND project.project_code = "'.$id.'"');
       // if($query->num_rows() > 0){
            return $query->result();
        ///
    }
}