<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Material extends CI_Model {

 var $table = 'material';
  
    public function __construct(){
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

    public function getUnits(){
        $query = $this->db->query('SELECT * FROM units');
        return $query->result();
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

    function checkname($name,$com){
        $query = $this->db->query('SELECT
                *
                FROM
                material
                WHERE material_name = "'.$name.'" AND material.company_id = "'.$com.'" ');
        if($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return NULL;
        }
    }

    function getlastid(){
        $query = $this->db->query('SELECT
            MAX(material.material_id) as id
            FROM
            material');
        return $query->row('id');
    }

    function get_datatables($com){
        $query = $this->db->query('SELECT *, DATE_FORMAT(material.material_date,"%M %d, %Y") AS ddate
        FROM
        material
        INNER JOIN supplier ON supplier.supplier_id = material.supplier_id
        INNER JOIN units ON units.unit_id = material.material_unit
        WHERE material.company_id = "'.$com.'"
        ');
        return $query->result();
    }

    function get_datatables_r(){
        $query = $this->db->query('SELECT
            project.project_code,
            material.material_name,
            SUM(material_receive.material_quantity) AS material_quantity,
            DATE_FORMAT(material_receive.material_date,"%M %d, %Y") AS ddate,
            project.project_title,
            units.unit_acro,
            units.unit_name
            FROM
            material_receive
            INNER JOIN project ON project.project_code = material_receive.project_code
            INNER JOIN material ON material.material_id = material_receive.material_id
            INNER JOIN units ON units.unit_id = material.material_unit
            WHERE receiver_from ="wrhs"
            GROUP BY
            material_receive.project_code,
            material_receive.material_id
        ');
        return $query->result();
    }

    function get_datatables_stock($com){
        $query = $this->db->query('SELECT *
            FROM
            admin_stock
            INNER JOIN material ON material.material_id = admin_stock.material_id
            INNER JOIN units ON material.material_unit = units.unit_id
            WHERE material.company_id = "'.$com.'"
            GROUP BY material.material_id
        ');
        return $query->result();
    }

    public function savestock($data){
        $this->db->insert("admin_stock", $data);
        return $this->db->insert_id();
    }

    public function save($data){  
        $this->db->insert("material", $data);
        return $this->db->insert_id();
    }


    public function update_stock($where, $data, $data2){
        $query2 = $this->db->query('SELECT * FROM admin_stock WHERE material_id = "'.$where['material_id'].'" ');
        if ($query2->num_rows() > 0){
            $query3 = $this->db->query('UPDATE admin_stock SET quantity = quantity + "'.$data['material_quantity'].'" WHERE material_id = "'.$where['material_id'].'" ');
        }      

        $query = $this->db->query('SELECT * FROM material WHERE material_id = "'.$where['material_id'].'" AND  material_date = "'.$where['material_date'].'"');
        if ($query->num_rows() > 0){
            $query4 = $this->db->query('UPDATE material SET material_quantity = material_quantity +  "'.$data['material_quantity'].'" WHERE material_id = "'.$where['material_id'].'"  AND material_date = "'.$where['material_date'].'"');
            return $this->db->affected_rows();
        }
        else{
            $this->db->insert("material", $data2);
            return $this->db->insert_id();
        }
        
    }

    public function update($where,$where2, $data, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $com){
       
        $query = $this->db->query('SELECT * FROM admin_stock  WHERE material_id = "'.$data['material_id'].'" AND company_id = "'.$com.'" ');
        if ($query->num_rows() > 0){
            // $query3 = $this->db->query('UPDATE admin_stock  INNER JOIN material SET quantity = quantity + ( '.$data['material_quantity'].' - material.material_quantity)  WHERE  material.ii="'.$where['ii'].'" AND 
                                        // material.material_date = "'.$data['material_date'].'"  ');
            $query3 = $this->db->query('UPDATE admin_stock  INNER JOIN material ON material.material_id = admin_stock.material_id SET quantity = quantity + ( '.$data['material_quantity'].' - material.material_quantity)  WHERE  admin_stock.material_id = "'.$data['material_id'].'"   AND material.ii="'.$where['ii'].'" ');
        }
        else{
            $query2 = $this->db->query('INSERT INTO admin_stock  VALUES ("", "'.$data['material_id'].'", "'.$data['material_quantity'].'"),"'.$com.'" ');
             
        }


        $this->db->update($this->table, $data, $where);
        $this->db->update($this->table, $data2, $where2);
        $this->db->update($this->table, $data3, $where);
        $this->db->update($this->table, $data4, $where);
        $this->db->update($this->table, $data5, $where);
        $this->db->update($this->table, $data6, $where2);
        $this->db->update($this->table, $data7, $where);
        $this->db->update($this->table, $data8, $where);
        return $this->db->affected_rows();
    
    }

     
    public function delete_by_id($id){
           
        $query = $this->db->query('SELECT * FROM admin_stock INNER JOIN material ON material.material_id = admin_stock.material_id  WHERE material.ii = "'.$id.'" ');
        if ($query->num_rows() > 0){
            $query3 = $this->db->query('UPDATE admin_stock  INNER JOIN material ON material.material_id = admin_stock.material_id  SET quantity = quantity - material.material_quantity  WHERE  material.ii="'.$id.'" ');
        } 

        $this->db->where('ii', $id);
        $this->db->delete($this->table);
    }

    public function get_by_id($id){
        $query = $this->db->query('SELECT 
                                    *
                                    FROM
                                    admin_stock
                                    INNER JOIN material ON admin_stock.material_id = material.material_id 
                                    WHERE 
                                    admin_stock.material_id = "'.$id['material_id'].'" ');
        return $query->row();
    }

    public function get_by_id2($id){
        $query = $this->db->query('SELECT 
                                    *
                                    FROM
                                    material
                                    INNER JOIN supplier ON material.supplier_id = supplier.supplier_id 
                                    WHERE 
                                    material.ii= "'.$id.'" ');
        return $query->row();
    }

   

}
