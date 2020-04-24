<?php

class ThreadSM extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('senior/Thread'));
    }

    public function index() {
         
        $user = array('user_id' => $this->session->userdata['logged_in']['user_id']);
       
        $data['user_info'] = $this->Thread->getData($user);
        $this->load->view("senior/header.php", $data);
        $this->load->view("senior/thread.php", $data);
        $this->load->view("senior/footer.php");
    }

    public function addPost( ){
        $user = $this->session->userdata['logged_in']['user_id'];
        $data = array(
            'thread_type' => 'text',
            'thread_message' => $this->input->post('post_mes'),
            'thread_user' => $user,
            'thread_date' => date("Y-m-d h:i:s")
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
            'thread_date' => date("Y-m-d h:i:s")
        );
        $insert = $this->Thread->addR($data);
        echo json_encode(array("status" => TRUE));
    }

    public function seeAct(){
        $data = $this->Thread->getAct();
        echo json_encode($data);                
    }

    public function seeActD($id){
        $data = $this->Thread->getActD($id);
        echo json_encode($data);                
    }

  
}
