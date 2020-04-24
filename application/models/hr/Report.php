<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Report extends CI_Model {

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

    function getAllProjects($data1, $data2) {
        $query = $this->db->query("SELECT
            project_title, project_code
            FROM
            project 
            INNER JOIN `user` ON `user`.company = project.company_id
            WHERE `user`.company = '".$data2."' AND `user`.user_id ='".$data1."' ");
 
        return $query->result();
    }

    function getEmp($id, $s,$s1,$s2, $e,$e1,$e2){
        $query = $this->db->query('SELECT
            worker_designation.pworker_id,
            UPPER(project_worker.pworker_lname) pworker_lname,
            UPPER(project_worker.pworker_fname) pworker_fname,
            employee_type.description,
            employee_type.salary
            FROM
            worker_designation
            INNER JOIN project_worker ON project_worker.pworker_id = worker_designation.pworker_id
            INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id
            WHERE worker_designation.project_code="'.$id.'" AND desig_date BETWEEN "'.$s2.'-'.$s.'-'.$s1.'" AND "'.$e2.'-'.$e.'-'.$e1.'" 
            GROUP BY worker_designation.pworker_id 
            ORDER BY project_worker.pworker_lname ASC');
        return $query->result();
    }

    function getLoan($id, $s,$s1,$s2, $e,$e1,$e2){
        $query = $this->db->query('SELECT
            project_worker.pworker_id,
            project_worker.pworker_lname,
            project_worker.pworker_fname,
            employee_type.description ED,
            SUM(case when deduction_type.description = "Shoes" then loan_payments.amount_paid end) Shoes,
            SUM(case when deduction_type.description = "Helmet" then loan_payments.amount_paid end) Helmet,
            SUM(case when deduction_type.description = "Safety Gear" then loan_payments.amount_paid end) Safety_Gear,
            SUM(case when deduction_type.description = "Uniform" then loan_payments.amount_paid end) Uniform,
            SUM(case when deduction_type.description = "Avela" then loan_payments.amount_paid end) Avela
            FROM
            loans
            INNER JOIN loan_payments ON loan_payments.loan_id = loans.loan_id
            INNER JOIN project_worker ON loans.emp_id = project_worker.pworker_id
            INNER JOIN employee_type ON employee_type.emptype_id = project_worker.worker_type_id
            INNER JOIN deduction_type ON loans.deductiontype_id = deduction_type.deductiontype_id
            WHERE project_worker.company_id = "'.$id.'"  AND deduction_starts  <= "'.$s2.'-'.$s.'-'.$s1.'" AND type ="LOAN"
            GROUP BY emp_id');
        return $query->result();
    }

}