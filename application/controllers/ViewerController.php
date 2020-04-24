<?php
class ViewerController extends CI_Controller {

    function __construct() {
        parent::__construct(); 
        $this->load->model(array('viewer/Viewermodel'));
    }

	function validate_credentials() {
        $pp= $this->input->post('password');
        $p = md5($pp);
        $data = array(
            'username' => $this->input->post('email'),
            'password' => $p
        );
        
        $res = $this->Viewermodel->validate($data);

        $response['user'] = $res;
        echo json_encode($response);
    }


	public function getBasicData(){
        
        $res = $this->Viewermodel->getBasicData($this->input->post('userid'));
		$response['user'] = $res;
        echo json_encode($response);
    }

    public function getLoginData(){
        
        $res = $this->Viewermodel->getLoginData($this->input->post('userid'));
		$response['user'] = $res;
        echo json_encode($response);
    }

    public function getProjectsData(){
        
        $res = $this->Viewermodel->getProjectsData($this->input->post('userid'));
		$response['projects'] = $res;
        echo json_encode($response);   
    }

    public function getProjectsDetailsData(){
        
        $res = $this->Viewermodel->getProjectsDetialsData($this->input->post('userid'), $this->input->post('projectname'));
		$response['projects'] = $res;
        echo json_encode($response);   
    }

    public function getTasks(){
        $list = $this->Viewermodel->getTasks($this->input->post('pid'));
        $response['tasks'] = $list;
        echo json_encode($response);
    }

    function PhotoDetails() {
        $data = $this->Viewermodel->getPhotoDetails($this->input->post('pid'),$this->input->post('date'));
        $response['photos'] = $data;
        echo json_encode($response);
    }

    function updateViewer() {
        $data = array(
            'user_fname' => $this->input->post('fname'),
            'user_mname' => $this->input->post('mname'),
            'user_lname' => $this->input->post('lname'),
            'user_phone' => $this->input->post('phone'),
            'gender' => $this->input->post('gender'),
        );


        $data = $this->Viewermodel->updateViewer(array('user_id' => $this->input->post('userid')), $data);
        $response["update"] = "OK";
        echo json_encode();
    }

    function updateViewerL() {
        $data = array(
            'user_email' => $this->input->post('user_email'),
            'user_password' => md5($this->input->post('user_password')),
        );


        $data = $this->Viewermodel->updateViewerL(array('user_id' => $this->input->post('userid')), $data);
        $response["update"] = "OK";
        echo json_encode();
    }

        
     public function upload_file() {

        //$data = $this->Viewermodel->getPhotoDetails($this->input->post('pid'),$this->input->post('date'));
         
        $file_element_name ='pic';
        $status="";
        $savep="";
        if ($status != "error") {
            $config['upload_path'] = './assets/upimages/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024 * 8;
            $config['encrypt_name'] = FALSE;
            
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($file_element_name)){
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
          
            else {
                $data = $this->upload->data();
                $save_path = base_url().'assets/upimages/'.$data['file_name'];
                $savep = $save_path;
                $userid = $this->input->post('userid');
                $imagedb = $this->Viewermodel->user_img($save_path,$userid);
                $status = "success";
            
                if(file_exists($save_path)) {
                    $msg = "Successfully Updated! ";
                }
                
                else {
                    $status = FALSE;
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
        @unlink($_FILES[$file_element_name]);
        }
       echo json_encode(array('status' => TRUE, 'error' => $savep, 'message' => "Uploaded successfully"));
    }

}

 