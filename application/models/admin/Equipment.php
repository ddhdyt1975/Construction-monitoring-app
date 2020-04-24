<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Equipment extends CI_Model {

  var $table = 'equipment';

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

    function getCity(){
        $query = $this->db->query('SELECT *
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

    function getlastid(){
        $query = $this->db->query('SELECT
            MAX(equipment.equipment_id) as id
            FROM
            equipment');
        return $query->row('id');
    }

    function checkname($name, $com){
        $query = $this->db->query('SELECT
                *
                FROM
                equipment
                WHERE equipment_name = "'.$name.'" And company_id = "'.$com.'" ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getSuppliers($user){
        
        $query = $this->db->query('SELECT * FROM supplier WHERE supplier.company_id = "'.$user.'" ' );

        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getUsertypes(){
    
        $query = $this->db->query('SELECT * FROM usertype');

        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function get_datatables($com){
        $query = $this->db->query('SELECT *,DATE_FORMAT(equipment.equipment_date,"%M %d, %Y") AS ddate
        FROM
        equipment
        INNER JOIN supplier ON equipment.supplier_id = supplier.supplier_id
        WHERE equipment.company_id = "'.$com.'"
        ');
        return $query->result();
    }

    function get_datatables_proj(){
        $query = $this->db->query('SELECT
            DATE_FORMAT(equipment_receive.equipment_date,"%M %d, %Y") AS ddate,
            equipment_receive.receiver_from,
            equipment_receive.equipment_quantity,
            project.project_title,
            equipment.equipment_name
            FROM
            equipment_receive
            INNER JOIN project ON project.project_code = equipment_receive.project_code
            INNER JOIN equipment ON equipment.equipment_id = equipment_receive.equipment_id
            WHERE
            receiver_from = "wrhs"
            GROUP BY
            equipment_receive.equipment_id
        ');
        return $query->result();
    }


    function get_datatables_stock($com){
        $query = $this->db->query('SELECT
                equipment.equipment_name,
                admin_stock_equipment.quantity,
                admin_stock_equipment.equipment_id,
                equipment.equipment_date
                FROM
                equipment
                INNER JOIN admin_stock_equipment ON admin_stock_equipment.equipment_id = equipment.equipment_id
                WHERE equipment.company_id = "'.$com.'"
                GROUP BY admin_stock_equipment.equipment_id
        ');
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

    public function savetostock($data){
        $this->db->insert('admin_stock_equipment', $data);
        return $this->db->insert_id();
    }

    public function delete_by_id($id){
        $query = $this->db->query('SELECT * FROM admin_stock_equipment INNER JOIN equipment  ON equipment.equipment_id = admin_stock_equipment.equipment_id WHERE equipment.ii="'.$id.'" ');
        if ($query->num_rows() > 0){
            $query3 = $this->db->query('UPDATE admin_stock_equipment INNER JOIN equipment ON equipment.equipment_id = admin_stock_equipment.equipment_id  SET quantity = quantity - equipment.equipment_quantity  WHERE  equipment.ii="'.$id.'" ');
        }

        $this->db->where('ii', $id);
        $this->db->delete($this->table);
    }

    public function get_by_id($id) { 
        $query = $this->db->query('SELECT * FROM equipment INNER JOIN supplier ON equipment.supplier_id = supplier.supplier_id WHERE  equipment.ii = "'.$id.'" ');
        return $query->row();
    }

    public function get_by_id2($id) {
        $query = $this->db->query('SELECT *
        FROM
        equipment
        INNER JOIN admin_stock_equipment ON admin_stock_equipment.equipment_id = equipment.equipment_id
        WHERE
        equipment.equipment_id = "'.$id.'" ');
        return $query->row();
    }

    public function update($where, $where2, $data, $data2, $data3, $data4, $data5, $data6, $data7){
        $query = $this->db->query('SELECT * FROM admin_stock_equipment WHERE equipment_id = "'.$data['equipment_id'].'" ');
        if ($query->num_rows() > 0){
            // $query3 = $this->db->query('UPDATE admin_stock_equipment INNER JOIN equipment SET quantity = quantity + ( '.$data['equipment_quantity'].' - equipment.equipment_quantity)  WHERE  equipment.ii="'.$where['ii'].'" AND 
            //                             equipment.equipment_date = "'.$data['equipment_date'].'"  ');
            //return $this->db->affected_rows();

            $query3 = $this->db->query('UPDATE admin_stock_equipment INNER JOIN equipment ON equipment.equipment_id = admin_stock_equipment.equipment_id SET quantity = quantity + ( '.$data['equipment_quantity'].' - equipment.equipment_quantity)  WHERE  admin_stock_equipment.equipment_id = "'.$data['equipment_id'].'"   AND equipment.ii="'.$where['ii'].'" ');
        }
        else{
            $query2 = $this->db->query('INSERT INTO admin_stock_equipment VALUES ("", "'.$data['equipment_id'].'", "'.$data['equipment_quantity'].'") ');
            //return $this->db->insert_id();
        }

        $this->db->update($this->table, $data2, $where2);
        $this->db->update($this->table, $data3, $where);
        $this->db->update($this->table, $data4, $where);
        $this->db->update($this->table, $data5, $where);
        $this->db->update($this->table, $data6, $where);
        $this->db->update($this->table, $data7, $where);
        return $this->db->affected_rows();
    }

    public function updatestock($data){
        
        $query4 = $this->db->query('SELECT * FROM equipment WHERE equipment_id = "'.$data['equipment_id'].'" and equipment_date = "'.$data['equipment_date'].'" ');
        if ($query4->num_rows() > 0){
            $query5 = $this->db->query('UPDATE equipment SET equipment_quantity = equipment_quantity +  "'.$data['equipment_quantity'].'" WHERE equipment_id = "'.$data['equipment_id'].'" and equipment_date = "'.$data['equipment_date'].'"  ');
           // return $this->db->affected_rows();
        }
        else{
            $this->db->insert($this->table, $data);
           // return $this->db->insert_id();
        }

        $query = $this->db->query('SELECT * FROM admin_stock_equipment WHERE equipment_id = "'.$data['equipment_id'].'" ');
        if ($query->num_rows() > 0){
            $query3 = $this->db->query('UPDATE admin_stock_equipment SET quantity = quantity +  "'.$data['equipment_quantity'].'" WHERE equipment_id="'.$data['equipment_id'].'" ');
            //return $this->db->affected_rows();
        }
        else{
            $query2 = $this->db->query('INSERT INTO admin_stock_equipment VALUES ("", "'.$data['equipment_id'].'", "'.$data['equipment_quantity'].'") ');
            //return $this->db->insert_id();
        }

       
    }

}
