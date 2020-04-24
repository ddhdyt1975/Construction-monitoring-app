<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Super extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

     public function getData($id){
        $query = $this->db->query('SELECT *,
            DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate,
            DATE_FORMAT(registered_date,"%h:%i %p") AS time
            FROM
            `user`
 	        INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id
            WHERE user_id ="'.$id.'"');
        return $query->row();
    }
}