<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Setting extends CI_Model {

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
            WHERE user_id ="'.$id.'"');return $query->row();
    }

////////////////////TASK///////////////////////////////////////
    public function getTasks($com){
    	$query = $this->db->query('SELECT * FROM project_task WHERE company_id = "'.$com.'" ');
    	return $query->result();
    }

    public function checkTname($taskname){
    	$query = $this->db->query('SELECT * FROM project_task WHERE projtsk_name = "'.$taskname.'" ');
    	return $query->result();	
    }

    public function getlastTaskid(){
    	$query = $this->db->query('SELECT MAX(projtsk_id) AS id FROM project_task');
    	return $query->row('id');	
    }

    public function addtask($data){
    	$this->db->insert("project_task", $data);
        return $this->db->insert_id();
    }

    public function gettask_by_id($taskid){
    	$query = $this->db->query('SELECT * FROM project_task WHERE projtsk_id = "'.$taskid.'" ');
    	return $query->row();	
    }

	public function updatetask($where, $data){
        $this->db->update('project_task', $data, $where);
        return $this->db->affected_rows();    
    }    

    public function deletetask_by_id($id){
        $this->db->where('projtsk_id', $id);
        $this->db->delete("project_task");
    }

////////////////////TASK///////////////////////////////////////

////////////////////UNIT///////////////////////////////////////

    public function getUnits(){
    	$query = $this->db->query('SELECT * FROM units');
    	return $query->result();
    }

    public function checkUname($unitname){
    	$query = $this->db->query('SELECT * FROM units WHERE unit_name = "'.$unitname.'" ');
    	return $query->result();	
    }

    public function checkAUname($unitname){
    	$query = $this->db->query('SELECT * FROM units WHERE unit_acro = "'.$unitname.'" ');
    	return $query->result();	
    }

    public function getlastunitid(){
    	$query = $this->db->query('SELECT MAX(unit_id) AS id FROM units');
    	return $query->row('id');	
    }

    public function addunit($data){
    	$this->db->insert("units", $data);
        return $this->db->insert_id();
    }

    public function getunit_by_id($uid){
    	$query = $this->db->query('SELECT * FROM units WHERE unit_id = "'.$uid.'" ');
    	return $query->row();	
    }

    public function updateunit($where, $data){
        $this->db->update('units', $data, $where);
        return $this->db->affected_rows();    
    }    

    public function deleteunit_by_id($id){
        $this->db->where('unit_id', $id);
        $this->db->delete("units");
    }


////////////////////UNIT///////////////////////////////////////


///////////////////COMPANY////////////////////////////////////////

    public function updatecomN($where, $data){
        $this->db->update('company_details', $data, $where);
        return $this->db->affected_rows();    
    }  

    public function checkCname($compname){
        $query = $this->db->query('SELECT * FROM company_details WHERE company_name = "'.$compname.'" ');
        return $query->result();    
    }


    function comp_img($path, $userid, $name) {
        // $updateData = array('user_photo' => $path);

        // $userid2 = array('user_id' => $userid);
        // $this->db->update("user", $updateData, $userid2);

        $query = $this->db->query('UPDATE company_details 
            INNER JOIN `user` ON `user`.company = company_details.company_id
            SET company_details.comp_logo = "'.$name.'", company_details.path = "'.$path.'"
            WHERE 
            `user`.user_id = "'.$userid.'"
        ');


        return $this->db->affected_rows();
    }

///////////////////COMPANY////////////////////////////////////////
}