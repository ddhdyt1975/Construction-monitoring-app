<?php

class HumanA extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url','file'));
        $this->load->model(array('hr/Attendance'));
    }

    public function index() {
        $user2 = $this->session->userdata['logged_in']['user_id'];
        $user3 = $this->session->userdata['logged_in']['company'];

        $data['user_info'] = $this->Attendance->getData($user2);
        $this->load->view("hr/header.php",$data);
        $this->load->view("hr/attendance.php" );
        $this->load->view("hr/footer.php");
    }

  
    public function do_upload() {
        $filename='';
        $file_element_name = 'userfile';
        $status="";
         $data['error'] = '';  
             if ($status != "error") {
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = '*';
                $config['max_size'] = 1024 * 8;
                $config['encrypt_name'] = FALSE;
                $config['overwrite'] = TRUE;
                
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($file_element_name)){
                    $status = 'error';
                    $data['error'] = $this->upload->display_errors();
                }
                else { 
                    $data = $this->upload->data();
                    $save_path = base_url().'assets/uploads/'.$data['upload_data']['file_name'].$data['file_name'];
                    $status = "success";
                    $filename = $data['upload_data']['file_name'].$data['file_name'];
                    


                    $data2 = array(
                        'file_name' => $data['upload_data']['file_name'].$data['file_name'],
                        'user_id' => $this->session->userdata['logged_in']['user_id'],
                        'upload_date' => date("Y-m-d H:i:s"),
                        'company_id' => $this->session->userdata['logged_in']['company']
                    );
                    
                     
                    $this->Attendance->delete_by_evaluate($filename);
                    
                    $insert = $this->Attendance->upload_att($data2);
                    $file =  "assets/uploads/".$filename;
                    $file_contents = file_get_contents($file);
                    $fh = fopen($file, "w");
                    $file_contents1 = preg_replace("/\t/", " ", $file_contents);
                    fwrite($fh, $file_contents1);
                    fclose($fh);


                    $file =  "assets/uploads/".$filename;
                    $file_contents = file_get_contents($file);
                    $fh = fopen($file, "w");
                    $file_contents1 = preg_replace("/\x20+/", " ", $file_contents);
                    fwrite($fh, $file_contents1);
                    fclose($fh);
    
                    $data = base_url().'assets/uploads/'.$filename;
                    $this->Attendance->savedata2($data, $filename);
                    
                    if(file_exists($save_path)) {
                        $msg = "Successfully Updated!"; 
                    }
                    else {
                        $status = FALSE;
                        $msg = "Something went wrong when saving the file, please try again.";
                    }
                }
                @unlink($_FILES[$file_element_name]);


                
                echo json_encode(array('status'=>TRUE,'message' =>$msg));
            }
            else{
                echo "error1";
            }
         
    }


    public function load_file_raw($filename){
        $lines = file(base_url()."./assets/uploads/".$filename);
        $data = array();
        foreach ($lines as $row){  
            preg_match("'^(.{10})(.{2})(.*)$'",$row,$n);
            $lols = array();
            $lols[] = trim(substr($row, 1,5));
            $lols[] = trim(substr($row, 6, 11));
            $lols[] = trim(substr($row, 18, 9));
            $data[] = $lols;
        }

        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

       
    public function ajax_list(){
        $userid2 = ($this->session->userdata['logged_in']['company']);
        $list = $this->Attendance->get_datatables($userid2);
        $data = array();
        foreach ($list as $supplier) {
            $date = new DateTime($supplier->upload_date);
            $row = array();
            $row[] = $supplier->file_name;
            $row[] = $date->format('M d, Y - h:i:s a ');
            $row[] = $supplier->user_lname.", ".$supplier->user_fname;
            $row[] = '<center><a class="btn btn-xs btn-default"  data-toggle="tooltip" data-placement="bottom" title="View raw file - '.$supplier->file_name.'" onclick="viewraw('."'".$supplier->file_name."'".')"><i class="glyphicon glyphicon-text"></i> View Raw</a>
                <a class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="bottom" title="Delete raw file - '.$supplier->file_name.'. Note: this will permanently delete your file." onclick="deletefile('."'".$supplier->file_id."'".')" ><i class="glyphicon glyphicon-text"></i> Delete</a></center>';
                    
            $data[] = $row;
        }
        $output = array(   
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function de($id){
          
        $filename = $this->Attendance->get_by_id($id);
        $path  =  'assets/uploads/';
        $files = glob($path.$filename->file_name); 

        foreach($files as $file){ 
            if(is_file($file))
                unlink($file);
        }

        $this->Attendance->delete_by_id($id);
        $this->Attendance->delete_by_evaluate($filename->file_name);
        echo json_encode("ok");

    }

     

      public function triall(){

                    
                 
 
               //  $data = "http://localhost/obraone/assets/uploads/22_attlog.dat";
               // $this->Attendance->savedata2($data, '22_attlog.php');
      }
}
