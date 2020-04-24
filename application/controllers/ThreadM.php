<?php

class ThreadM extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('manager/Thread'));
    }

    public function index() {
         
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
       
        $data['user_info'] = $this->Thread->getData($user);
        $this->load->view("manager/header.php", $data);
        $this->load->view("manager/thread.php", $data);
        $this->load->view("manager/footer.php");
    }

    public function addPost( ){
        $user = $this->session->userdata['logged_in']['user_id'];
        $data = array(
            'thread_type' => 'text',
            'thread_message' => $this->input->post('post_mes'),
            'thread_user' => $user,
            'thread_date' => date("Y-m-d H:i:s")
        );
        $insert = $this->Thread->addP($data);
        echo json_encode(array("status" => TRUE));
    }
    public function getLst($id1, $id2){
        $data = $this->Thread->getLst($id1, $id2);
        echo json_encode($data);
    }

    public function addReply($id){
        $user = $this->session->userdata['logged_in']['user_id'];
        $data = array(
            'thread_id' => $id,
            'thread_message' => $this->input->post('reply_mes'),
            'thread_user' => $user,
            'thread_date' => date("Y-m-d H:i:s")
        );
        $insert = $this->Thread->addR($data);
        echo json_encode(array("status" => TRUE));  
    }

    public function seeAct(){
        $com = $this->session->userdata['logged_in']['company'];
        $data = $this->Thread->getAct($com);
        echo json_encode($data);                
    }

    public function seeActD($id){
        $data = $this->Thread->getActD($id);
        echo json_encode($data);                
    }

  
}
