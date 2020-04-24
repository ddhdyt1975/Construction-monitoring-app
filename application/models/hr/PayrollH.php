<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class PayrollH extends CI_Model {

    var $table = 'additionals';
    var $table1 = 'deductions';

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

    function getEmployees($data) {
        $query = $this->db->query('SELECT
            project_worker.pworker_id,
            project_worker.pworker_mname,
            project_worker.pworker_lname,
            project_worker.pworker_fname
            FROM
            project_worker
            WHERE
            company_id ="'.$data.'" ');
        return $query->result();
    }

    function get_dtr_by_id1($id, $s,$s1,$s2, $e,$e1,$e2 ){
        $query = $this->db->query('SELECT
            worker_designation.desig_date,
            worker_designation.time,
            DATE_FORMAT(desig_date,"%M %d, %Y") AS ddate,
            DATE_FORMAT(time,"%h:%i %p") AS dtime,
            project.project_title,
            employee_type.description,
            employee_type.salary,
            project_worker.status
            FROM
            worker_designation
            INNER JOIN project ON worker_designation.project_code = project.project_code
            INNER JOIN project_worker ON project_worker.pworker_id = worker_designation.pworker_id
            INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id
            WHERE   worker_designation.pworker_id="'.$id.'" AND desig_date BETWEEN "'.$s2.'-'.$s.'-'.$s1.'" AND "'.$e2.'-'.$e.'-'.$e1.'" 
            ORDER By worker_designation.desig_date ASC');
        return $query->result();

//         select 
// desig_date,
//     MIN(case when  time BETWEEN "06:00:00" AND "12:00:00"  then time end) TIMEIN,
//     MIN(case when  time BETWEEN "12:01:00" AND "24:00:00" then time end) TIMEOUT
// from worker_designation
// INNER JOIN project ON worker_designation.project_code = project.project_code
// INNER JOIN project_worker ON project_worker.pworker_id = worker_designation.pworker_id
// INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id
// WHERE   worker_designation.pworker_id = "2181008" AND desig_date BETWEEN "2018-05-01" AND "2018-05-10" 
// GROUP BY desig_date

    }


    function get_dtr_by_id($id, $s,$s1,$s2, $e,$e1,$e2, $pr){
        $query = $this->db->query('SELECT
            worker_designation.desig_date,
            worker_designation.time,
            DATE_FORMAT(desig_date,"%M %d, %Y") AS ddate,
            DATE_FORMAT(time,"%h:%i %p") AS dtime,
            project.project_title,
            employee_type.description,
            employee_type.salary,
            project_worker.status
            FROM
            worker_designation
            INNER JOIN project ON worker_designation.project_code = project.project_code
            INNER JOIN project_worker ON project_worker.pworker_id = worker_designation.pworker_id
            INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id
            WHERE worker_designation.project_code = "'.$pr.'" AND worker_designation.pworker_id="'.$id.'" AND desig_date BETWEEN "'.$s2.'-'.$s.'-'.$s1.'" AND "'.$e2.'-'.$e.'-'.$e1.'" ORDER By worker_designation.desig_date ASC');
        return $query->result();
    }

    function get_dtr_by_id2($id, $s,$s1,$s2, $e,$e1,$e2, $pr){
        $query = $this->db->query('SELECT
            worker_designation.desig_date,
            worker_designation.time,
            DATE_FORMAT(desig_date,"%M %d, %Y") AS ddate,
            DATE_FORMAT(time,"%h:%i %p") AS dtime,
            project.project_title,
            employee_type.description,
            employee_type.salary,
            project_worker.status
            FROM
            worker_designation
            INNER JOIN project ON worker_designation.project_code = project.project_code
            INNER JOIN project_worker ON project_worker.pworker_id = worker_designation.pworker_id
            INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id
            WHERE worker_designation.project_code = "'.$pr.'" AND  worker_designation.pworker_id="'.$id.'" AND desig_date BETWEEN "'.$s2.'-'.$s.'-'.$s1.'" AND "'.$e2.'-'.$e.'-'.$e1.'" 
            ORDER BY desig_date ASC');
        return $query->result();
    }


    function getadded($id, $s,$s1,$s2, $e,$e1,$e2){
        $query = $this->db->query('SELECT
            additional_type.description,
            additionals.amount
            FROM
            additionals 
            INNER JOIN additional_type ON additional_type.additionaltype_id = additionals.additionaltype_id
            WHERE additionals.emp_id="'.$id.'" AND   additionals.start_date >= "'.$s2.'-'.$s.'-'.$s1.'"  AND additionals.end_date <= "'.$e2.'-'.$e.'-'.$e1.'" '); 
        return $query->result();
    }

    function getdded($id, $s,$s1,$s2, $e,$e1,$e2){
        $query = $this->db->query('SELECT
            deductions.deductiontype_id,
            deduction_type.description,
            deductions.amount
            FROM
            deductions 
            INNER JOIN deduction_type ON deduction_type.deductiontype_id = deductions.deductiontype_id
            WHERE deductions.emp_id="'.$id.'" AND   deductions.start_date >= "'.$s2.'-'.$s.'-'.$s1.'"  AND deductions.end_date <= "'.$e2.'-'.$e.'-'.$e1.'" '); 
        return $query->result();
    }

    function getdded2($id, $s,$s1,$s2, $e,$e1,$e2){
        $query = $this->db->query('SELECT
            *
            FROM
            `loans`
            INNER JOIN deduction_type ON deduction_type.deductiontype_id = loans.deductiontype_id
            WHERE loan_id = "'.$id.'" AND deduction_starts  <= "'.$s2.'-'.$s.'-'.$s1.'"  '); 
        return $query->row();
    }

    function displayded2($id, $s,$s1,$s2, $e,$e1,$e2){
        $query = $this->db->query('SELECT
            deduction_type.description,
            loan_payments.amount_paid,
            loan_payments.loan_payment_id
            FROM
            loan_payments
            INNER JOIN loans ON loan_payments.loan_id = loans.loan_id
            INNER JOIN deduction_type ON deduction_type.deductiontype_id = loans.deductiontype_id
            WHERE emp_id = '.$id.' AND  cast(date_of_payment1 as date) BETWEEN "'.$s2.'-'.$s.'-'.$s1.'" AND  "'.$e2.'-'.$e.'-'.$e1.'"  
            '); 
        return $query->result();
    }

    function displayded21($id, $s,$s1,$s2, $e,$e1,$e2){
        $query = $this->db->query('SELECT
            SUM(loan_payments.amount_paid) amount_paid
            FROM
            loan_payments
            INNER JOIN loans ON loan_payments.loan_id = loans.loan_id
            INNER JOIN deduction_type ON deduction_type.deductiontype_id = loans.deductiontype_id
            WHERE emp_id = '.$id.' AND  cast(date_of_payment1 as date) BETWEEN "'.$s2.'-'.$s.'-'.$s1.'" AND  "'.$e2.'-'.$e.'-'.$e1.'"  
            '); 
        return $query->row();
    }

    public function save_loan_payment($data){
        $this->db->insert('loan_payments', $data);
        return $this->db->insert_id();
    }


    public function getAdditionaltype_id() {
        $query = $this->db->query('SELECT additional_type.additionaltype_id, additional_type.description, additional_type.note FROM additional_type');
        return $query->result();
    }  

    public function getDeductionstype_id() {
        $query = $this->db->query('SELECT deduction_type.deductiontype_id, deduction_type.description FROM deduction_type WHERE type="DEDUCTION"');
        return $query->result();
    }

    public function getDeductionstype_id2() {
        $query = $this->db->query('SELECT deduction_type.deductiontype_id, deduction_type.description FROM deduction_type WHERE type="LOAN"');
        return $query->result();
    }

    public function getAddnote($id) {
        $query = $this->db->query('SELECT additional_type.note FROM additional_type WHERE additional_type.additionaltype_id = "'.$id.'" ');
        return $query->result();
    }

    public function getDecnote($id) {
        $query = $this->db->query('SELECT deduction_type.note FROM deduction_type WHERE deduction_type.deductiontype_id = "'.$id.'" ');
        return $query->result();
    }

    public function save_additional($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function save_deduction($data){
        $this->db->insert($this->table1, $data);
        return $this->db->insert_id();
    }

    public function getprofile($id){
        $query = $this->db->query('SELECT project_worker.pworker_fname, project_worker.pworker_mname,project_worker.pworker_lname, project_worker.worker_photo FROM project_worker WHERE project_worker.pworker_id = "'.$id.'"');
        return $query->result();
    }

    function get_datatables($com){
        $query = $this->db->query('SELECT project_worker.pworker_id, project_worker.pworker_fname, project_worker.pworker_mname, project_worker.pworker_lname, project_worker.pworker_add, project_worker.city_id, project_worker.pworker_gender, project_worker.civil_status, project_worker.worker_photo, project_worker.user_id, project_worker.created, project_worker.dob, project_worker.contact_no, project_worker.sss, project_worker.philhealth, project_worker.pag_ibig, project_worker.bank_no, project_worker.`status`, project_worker.worker_type_id, project_worker.company_id, city.city_name, province.province_name, province.zip_code, employee_type.description, project_worker.tax_code, project_worker.blood_type, project_worker.tin_number, project_worker.height, project_worker.weight FROM project_worker INNER JOIN city ON city.city_id = project_worker.city_id INNER JOIN province ON province.province_id = city.province_id INNER JOIN `user` ON project_worker.user_id = `user`.user_id INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id WHERE project_worker.company_id="'.$com.'" ');
        return $query->result();
    }

   public function get_datatables1($worker_id) {
        $query = $this->db->query('SELECT additionals.amount, additionals.start_date, additionals.end_date, additionals.created_at, additional_type.description, additionals.additional_id FROM additionals INNER JOIN additional_type ON additionals.additionaltype_id = additional_type.additionaltype_id WHERE additionals.emp_id = "'.$worker_id.'"');
        return $query->result();
    }

    public function get_datatables2($worker_id) {
        $query = $this->db->query('SELECT deduction_type.description, deductions.amount, deductions.start_date, deductions.end_date, deductions.created_at, deductions.deduction_id FROM deduction_type INNER JOIN deductions ON deductions.deductiontype_id = deduction_type.deductiontype_id WHERE deductions.emp_id = "'.$worker_id.'"');
        return $query->result();
    }

    public function delete_addtionl($addt_id) {
        $this->db->where('additional_id', $addt_id);
        $this->db->delete($this->table);
    }

    public function delete_deduc($deduc_id) {
        $this->db->where('deduction_id', $deduc_id);
        $this->db->delete($this->table1);
    }

    public function insert_loan($data) {
        $this->db->insert('loans', $data);
        return $this->db->insert_id();       
    }

    public function get_datatables_loans($id) {
        $query = $this->db->query('SELECT
            deduction_type.description,
            loans.terms,
            loans.deduction_amt,
            loans.deduction_starts,
            loans.deduction_period,
            loans.original_loan,
            loans.date_loan_granted,
            loans.loan_id,
            loans.interest
        FROM
            loans
        INNER JOIN deduction_type ON loans.deductiontype_id = deduction_type.deductiontype_id
        WHERE emp_id = "'.$id.'" ');
        return $query->result();
    }

    public function getpaid($id){
        $query = $this->db->query('SELECT
            SUM(loan_payments.amount_paid) total_paid
            FROM
            loan_payments
            INNER JOIN loans ON loan_payments.loan_id = loans.loan_id 
            WHERE loan_payments.loan_id  ="'.$id.'" ');
        return $query->row();
    }

    public function delete_loan($loan_id) {
        $this->db->where('loan_id', $loan_id);
        $this->db->delete("loans");
    }

    public function loan_del($loan_id) {
        $this->db->where('loan_payment_id', $loan_id);
        $this->db->delete("loan_payments");
    }

    public function get_datatables_loans_pay($id) {
        $query = $this->db->query('SELECT
            loan_payments.loan_payment_id,
            loan_payments.date_of_payment1,
            loan_payments.amount_paid
        FROM
            loan_payments
        WHERE
            loan_id = "'.$id.'" ');
        return $query->result();
    }
 
    // function get_dtr_by_id13($id,$start,$end ){
    //     $query = $this->db->query('SELECT
    //         worker_designation.desig_date,
    //         worker_designation.time,
    //         DATE_FORMAT(desig_date,"%M %d, %Y") AS ddate,
    //         DATE_FORMAT(time,"%h:%i %p") AS dtime,
    //         project.project_title,
    //         employee_type.description,
    //         employee_type.salary,
    //          project_worker.status
    //         FROM
    //         project_worker
    //         INNER JOIN project ON worker_designation.project_code = project.project_code
    //         INNER JOIN project_worker ON project_worker.pworker_id = worker_designation.pworker_id
    //         INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id
    //         WHERE worker_designation.desig_date BETWEEN "'.$start.'" AND "'.$end.'" 
    //         AND worker_designation.pworker_id ="'.$id.'"');
    //     return $query->result();
    // }

    function get_dtr_by_id13($id, $s,$s1 ){
        $query = $this->db->query('SELECT
            worker_designation.desig_date,
            worker_designation.time,
            DATE_FORMAT(desig_date,"%M %d, %Y") AS ddate,
            DATE_FORMAT(time,"%h:%i %p") AS dtime,
            project.project_title,
            employee_type.description,
            employee_type.salary,
            project_worker.status
            FROM
            worker_designation
            INNER JOIN project ON worker_designation.project_code = project.project_code
            INNER JOIN project_worker ON project_worker.pworker_id = worker_designation.pworker_id
            INNER JOIN employee_type ON project_worker.worker_type_id = employee_type.emptype_id
            WHERE   worker_designation.pworker_id="'.$id.'" AND desig_date BETWEEN "'.$s.'" AND "'.$s1.'" 
            ORDER By worker_designation.desig_date ASC');
        return $query->result();
    }
}