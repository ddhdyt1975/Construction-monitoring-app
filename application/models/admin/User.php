<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class User extends CI_Model {

    var $table = 'user';
  
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
    

    function getCity(){
        $query = $this->db->query('SELECT *
            FROM
            city
            INNER JOIN province ON province.province_id = city.province_id
        ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getUsertypes(){
        $query = $this->db->query('SELECT * FROM usertype WHERE usertype_id NOT IN ("super")');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function addUser($data){
        $insert = $this->db->insert('user', $data);
        return 'Inserted';
    }

    function get_datatables($id, $com){ 
        $query = $this->db->query('SELECT
            `user`.user_id,
            `user`.user_fname,
            `user`.user_mname,
            `user`.user_lname,
            `user`.user_email,
            `user`.user_address,
            `user`.city_id,
            `user`.user_status,
            `user`.usertype_id,
            `user`.user_password,
            `user`.user_phone,
            `user`.user_photo,
            `user`.registered_date,
            `user`.oauth_provider,
            `user`.gender,
            `user`.locale,
            `user`.link,
            `user`.created,
            `user`.modified,
            `user`.oauth_uid,
            usertype.usertype_id,
            usertype.usertype_name,
            city.city_id,
            city.city_name,
            city.province_id,
            city.zip_code,
            province.province_id,
            province.province_name,
            province.zip_code
           FROM
            `user`
            INNER JOIN usertype ON usertype.usertype_id = `user`.usertype_id
            INNER JOIN city ON `user`.city_id = city.city_id
            INNER JOIN province ON city.province_id = province.province_id
            WHERE
            `user`.user_id NOT IN ("'.$id.'")
            AND `user`.company = "'.$com.'"
            AND `user`.usertype_id NOT IN ("super")');
        return $query->result();
    }

    function count_filtered(){
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function save($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function delete_by_id($id){
        $this->db->where('user_id', $id);
        $this->db->delete($this->table);
    }

    public function get_by_id($id){
        $this->db->from($this->table);
       
        $query = $this->db->query('SELECT *
        FROM
        user
        INNER JOIN usertype ON user.usertype_id = usertype.usertype_id
        INNER JOIN city ON user.city_id = city.city_id
        INNER JOIN province ON province.province_id = city.province_id WHERE user.user_id = "'.$id.'" ');

        return $query->row();
    }


    public function update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

}
