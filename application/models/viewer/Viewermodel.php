<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Viewermodel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


	function validate($data) {

		$condition = "user.usertype_id = usertype.usertype_id AND " . "user_email =" . "'" . $data['username'] . "' AND " . "user_password =" . "'" . $data['password'] . "' AND user.usertype_id = 'utv' " ;

		$this->db->select('*');
		$this->db->from('user,usertype');
		$this->db->where($condition);

		$query = $this->db->get();

 	 	return $query->row();
	}


    public function getBasicData($id){
        $query = $this->db->query('SELECT `user`.user_fname,
		`user`.user_mname,
		`user`.user_lname,
		`user`.user_phone,
		`user`.user_photo,
		`user`.gender 
        FROM
        `user`
        INNER JOIN city ON city.city_id = `user`.city_id
        INNER JOIN province ON province.province_id = city.province_id 
        WHERE user_id ="'.$id.'" ');
        return $query->row();
    }


    public function getLoginData($id){
        $query = $this->db->query('SELECT 
		`user`.user_email,
		`user`.user_password
        FROM
        `user`
        INNER JOIN city ON city.city_id = `user`.city_id
        INNER JOIN province ON province.province_id = city.province_id 
        WHERE user_id ="'.$id.'" ');
        return $query->row();
    }


    public function getProjectsData($id){
        $query = $this->db->query('SELECT
		project.project_title
		FROM `project`
		WHERE project.project_owner  ="'.$id.'" ');
        return $query->result();
    }

    public function getProjectsDetialsData($id, $name){
    	$query = $this->db->query('SELECT *,    
            DATE_FORMAT(project.start_project,"%M %d, %Y") AS ddate,
            DATE_FORMAT(project.expected_end_date,"%M %d, %Y") AS edate,
            city.city_name,
            province.province_name
            FROM
            project
            INNER JOIN `user` ON project.user_id = `user`.user_id
            INNER JOIN project_details ON project_details.project_code = project.project_code
            INNER JOIN city ON city.city_id = project.city_id
            INNER JOIN province ON province.province_id = city.province_id
            WHERE project.project_code = project_details.project_code AND project.project_title = "'.$name.'" AND project.project_owner = "'.$id.'" ');
        return $query->row();
    }

    public function getTasks($id){
        $query = $this->db->query('SELECT project.project_code,project_dtask.projdtsk_id, project_task.projtsk_id, project.project_title, project.project_status, project_task.projtsk_name, project_dtask.projdtsk_percent, project_dtask.projdtsk_date,project_dtask.projdtsk_update  FROM project_task INNER JOIN project_dtask ON project_task.projtsk_id = project_dtask.projtsk_id INNER JOIN project ON project.project_code = project_dtask.project_code AND project.project_code = "'.$id.'" ORDER BY project_dtask.projdtsk_percent DESC');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getPhotoDetails($project_title, $date) {
        $query = $this->db->query('SELECT photo.photo_id, photo.project_code, photo.photo, photo.photo_upload_date, photo.photo_comment
             FROM project INNER JOIN photo ON project.project_code = photo.project_code WHERE photo.project_code = "'.$project_title.'" AND photo.photo_upload_date =  "'.$date.'"');
        return $query->result();
    }

    function getPhotoDetails2($project_title) {
        $query = $this->db->query('SELECT photo.photo_id, photo.project_code, photo.photo, photo.photo_upload_date, photo.photo_comment, DATE_FORMAT(photo.photo_upload_date,"%m/%d/%Y") FROM project INNER JOIN photo ON project.project_code = photo.project_code WHERE photo.project_code = "'.$project_title.'"');
        return $query->result();
    }

    public function updateViewer($where, $data){
        $this->db->update("user", $data, $where);
        return $this->db->affected_rows();
    }

    public function updateViewerL($where, $data){
        $this->db->update("user", $data, $where);
        return $this->db->affected_rows();
    }

    public function user_img($path, $userid) {
        $updateData = array('user_photo' => $path);
        $this->db->where("user_id",$userid);
        $this->db->update("user",$updateData);
    }

}