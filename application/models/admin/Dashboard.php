<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Dashboard extends CI_Model {

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

    public function count_all1($com){
        $query = $this->db->query('SELECT
            *
            FROM
            project
            INNER JOIN city ON city.city_id = project.city_id
            INNER JOIN province ON province.province_id = city.province_id INNER JOIN `user` ON `user`.user_id = project.user_id WHERE user.company ="'.$com.'" ');
        return $query->num_rows();
    }

    public function count_all2($com){
        $query = $this->db->query('SELECT
            *
            FROM
            material
            WHERE company_id = "'.$com.'"
            GROUP BY
            material.material_id
        ');
        return $query->num_rows();
    }

    public function count_all3($com){
        $query = $this->db->query('SELECT *
            FROM `equipment`
            WHERE company_id = "'.$com.'"
            GROUP BY
            equipment.equipment_id
        ');
        return $query->num_rows();
    }

    public function count_all4($data){
        $query = $this->db->query('SELECT   COUNT(*) AS total  FROM supplier  WHERE supplier.company_id = "'.$data.'" ');
        return $query->row('total');
    }
    
    public function count_all5($data,$data2){
        $query = $this->db->query('SELECT
            CONCAT(
                    user.user_fname,
                    " ",
                    user.user_mname,
                    " ",
                    user.user_lname
                ) AS `NAME`,
            `user`.user_email,
            usertype.usertype_name,
            CONCAT(
                    user.user_address,
                    ", ",
                    city.city_name,
                    ", ",
                    province.province_name,
                    ", ",
                    province.zip_code
                ) AS addr,
            `user`.company
            FROM
            `user`
            INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id
            INNER JOIN city ON `user`.city_id = city.city_id
            INNER JOIN province ON city.province_id = province.province_id
            WHERE
            `user`.user_id NOT IN ("'.$data.'")
            AND `user`.company = "'.$data2.'"
            AND `user`.usertype_id NOT IN ("super")' );
        return $query->num_rows();
    }

    function get_datatables($com){        
        $query = $this->db->query('SELECT
            *
            FROM
            project
            INNER JOIN city ON city.city_id = project.city_id
            INNER JOIN province ON province.province_id = city.province_id INNER JOIN `user` ON `user`.user_id = project.user_id WHERE user.company ="'.$com.'" ');
        return $query->result();
    }

    function get_datatables2($com){
        $query = $this->db->query('SELECT *,DATE_FORMAT(material.material_date,"%M %d, %Y") AS ddate FROM material INNER JOIN supplier ON material.supplier_id = supplier.supplier_id WHERE material.company_id = "'.$com.'" ');
        return $query->result();
    }

    function get_datatables3($com){
        $query = $this->db->query('SELECT *,DATE_FORMAT(equipment.equipment_date,"%M %d, %Y") AS ddate FROM equipment INNER JOIN supplier ON equipment.supplier_id = supplier.supplier_id WHERE equipment.company_id = "'.$com.'" ');
        return $query->result();
    }


    function get_datatables4($data){
         $query = $this->db->query('SELECT   *, city.zip_code as zip FROM  city INNER JOIN province ON city.province_id = province.province_id INNER JOIN supplier ON supplier.city_id = city.city_id    WHERE supplier.company_id = "'.$data.'" ');
        return $query->result();
    }

    function get_datatables5($data, $data2){
        $query = $this->db->query('SELECT DATE_FORMAT(user.registered_date,"%M %d, %Y %h:%i %p") AS ddate, CONCAT(user.user_fname," ",user.user_mname," ",user.user_lname) AS name, user.user_email, usertype.usertype_name, CONCAT(user.user_address,", ",city.city_name,", ",province.province_name,", ",province.zip_code) AS addr, user.user_photo 
            FROM
            `user`
            INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id
            INNER JOIN city ON `user`.city_id = city.city_id
            INNER JOIN province ON city.province_id = province.province_id
            WHERE
            `user`.user_id NOT IN ("'.$data.'")
            AND `user`.company = "'.$data2.'"
            AND `user`.usertype_id NOT IN ("super") ');
        return $query->result();
    }

    function get_datatables51($data){
        $this->db->from('user');
        $query = $this->db->query('SELECT DATE_FORMAT(user.registered_date,"%M %d, %Y %h:%i %p") AS ddate, user.oauth_provider, CONCAT(user.user_fname," ",user.user_lname) AS name, user.user_email, usertype.usertype_name, CONCAT(user.user_address,", ",city.city_name,", ",province.province_name,", ",province.zip_code) AS addr, user.user_photo  FROM user INNER JOIN usertype ON usertype.usertype_id = user.usertype_id INNER JOIN city ON user.city_id = city.city_id INNER JOIN province ON city.province_id = province.province_id WHERE user.user_id NOT IN  ("'.$data.'") AND user.usertype_id ="utv"');
        return $query->result();
    }

    public function getProjects2($com){
        $query = $this->db->query('SELECT * FROM project LEFT JOIN user ON user.user_id = project.user_id WHERE user.company ="'.$com.'" ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    public function getTasks($id){
        $query = $this->db->query('SELECT project.project_code,project_dtask.projdtsk_id, project_task.projtsk_id, project.project_title, project.project_desc, project.project_status, project_task.projtsk_name, project_dtask.projdtsk_percent, project_dtask.projdtsk_date,project_dtask.projdtsk_update  FROM project_task INNER JOIN project_dtask ON project_task.projtsk_id = project_dtask.projtsk_id INNER JOIN project ON project.project_code = project_dtask.project_code AND project.project_code = "'.$id.'"');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

}