<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Supplier extends CI_Model {

    var $table = 'supplier';
    var $table2 = 'equipment';
    var $table3 = 'material';

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
    
    function addUser($data){
        $insert = $this->db->insert('user', $data);
        return 'Inserted';
    }

    function getCity(){
        $query = $this->db->query('SELECT
                                    *
                                    FROM
                                    city
                                    INNER JOIN province ON city.province_id = province.province_id');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getSuppliers($user){
        $query = $this->db->query('SELECT * FROM supplier');$query = $this->db->query('SELECT * FROM supplier WHERE supplier.company_id = "'.$user.'" ' );
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function get_datatables($com){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT
                                *
                                FROM
                                supplier
                                INNER JOIN city ON city.city_id = supplier.city_id
                                INNER JOIN province ON province.province_id = city.province_id
                                WHERE supplier.company_id="'.$com.'" ');
        return $query->result();
    }

    function checkname($supname){
        $query = $this->db->query('SELECT * FROM supplier WHERE supplier_name = "'.$supname.'" ');
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
        $this->db->where('supplier_id', $id);
        $this->db->delete($this->table);
    }

    public function get_by_id($id){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT
                                *
                                FROM
                                supplier
                                INNER JOIN city ON city.city_id = supplier.city_id
                                INNER JOIN province ON province.province_id = city.province_id WHERE supplier.supplier_id = "'.$id.'" ');
        return $query->row();
    }

    public function get_item_id($id){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT *,DATE_FORMAT(material.material_date,"%M %d, %Y") AS ddate FROM material NATURAL JOIN supplier WHERE material.supplier_id = supplier.supplier_id AND supplier.supplier_id = "'.$id.'"');
        return $query->result();
    }

    public function get_sups_id($id){
        $this->db->from($this->table);
        $query = $this->db->query('SELECT *, DATE_FORMAT(equipment.equipment_date,"%M %d, %Y") AS ddate FROM equipment NATURAL JOIN supplier WHERE equipment.supplier_id = supplier.supplier_id AND supplier.supplier_id = "'.$id.'"');
        return $query->result();
    }

    public function update($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function save2($data){
        $this->db->insert($this->table2, $data);
        return $this->db->insert_id();
    }

    public function save3($data){
        $this->db->insert($this->table3, $data);
        return $this->db->insert_id();
    }
}
