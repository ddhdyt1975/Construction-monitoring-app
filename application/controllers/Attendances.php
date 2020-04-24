<?php

class Attendances extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('admin/attendance'));
    }

     public function index() {

        
    }

}
