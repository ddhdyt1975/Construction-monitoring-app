<?php

class Viewer extends CI_Model {


	public function getData($id){
        $query = $this->db->query('SELECT *,DATE_FORMAT(registered_date,"%M %d, %Y") AS ddate, DATE_FORMAT(registered_date,"%h:%i %p") AS time FROM `user` INNER JOIN city ON city.city_id = `user`.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id WHERE user_id = "'.$id.'"');
        return $query->row();
    }

}?>