<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
           $this->load->library('session');
        $this->load->model('auth/Login_model');
    }

    function index() {
        $this->load->view("public/header.php" );  
        $this->load->view("public/login_form.php");
        $this->load->view("public/footer.php");
    }
    
    function redirect_profile($res){
        if(empty($res)){
            $this->index();
        }

        else if ($res[0]->usertype_id == 'hr' && $res[0]->user_status == 'OK' ) {
            $session_data = array (
                'user_email' => $res[0]->user_email,
                'user_id' => $res[0]->user_id,
                'usertype_name' => $res[0]->usertype_name,
                'user_fname' => $res[0]->user_fname,
                'user_mname' => $res[0]->user_mname,
                'user_lname' => $res[0]->user_lname,
                'user_photo' => $res[0]->user_photo,
                'company' => $res[0]->company,
                'position' => $res[0]->usertype_id
                );
            $this->session->set_userdata('logged_in', $session_data); 
            redirect('HumanR');
        }

        else if ($res[0]->usertype_id == 'super' && $res[0]->user_status == 'OK' ) {
            $session_data = array (
                'user_email' => $res[0]->user_email,
                'user_id' => $res[0]->user_id,
                'usertype_name' => $res[0]->usertype_name,
                'user_fname' => $res[0]->user_fname,
                'user_mname' => $res[0]->user_mname,
                'user_lname' => $res[0]->user_lname,
                'user_photo' => $res[0]->user_photo,
                'position' => $res[0]->usertype_id
                );
            $this->session->set_userdata('logged_in', $session_data); 
            redirect('SuperAdmin');
        }

        else if ($res[0]->usertype_id == 'ut1' && $res[0]->user_status == 'OK' ) {
            $session_data = array (
                'user_email' => $res[0]->user_email,
                'user_id' => $res[0]->user_id,
                'usertype_name' => $res[0]->usertype_name,
                'user_fname' => $res[0]->user_fname,
                'user_mname' => $res[0]->user_mname,
                'user_lname' => $res[0]->user_lname,
                'user_photo' => $res[0]->user_photo,
                'company' => $res[0]->company,
                'position' => $res[0]->usertype_id
                );
            $this->session->set_userdata('logged_in',$session_data); 
            redirect('Admin');
        }
        else if ($res[0]->usertype_id == 'ut2' && $res[0]->user_status == 'OK') {
            $session_data = array (
                'user_email' => $res[0]->user_email,
                'user_id' => $res[0]->user_id,
                'usertype_name' => $res[0]->usertype_name,
                'user_fname' => $res[0]->user_fname,
                'user_mname' => $res[0]->user_mname,
                'user_lname' => $res[0]->user_lname,
                'user_photo' => $res[0]->user_photo,
                'company' => $res[0]->company,
                'position' => $res[0]->usertype_id
            );
            $this->session->set_userdata('logged_in', $session_data);
             
            redirect('ManagerSM');     
        }
        else if ($res[0]->usertype_id == 'ut3' && $res[0]->user_status == 'OK') {
            $session_data = array (
                'user_email' => $res[0]->user_email,
                'user_id' => $res[0]->user_id,
                'usertype_name' => $res[0]->usertype_name,
                'user_fname' => $res[0]->user_fname,
                'user_mname' => $res[0]->user_mname,
                'user_lname' => $res[0]->user_lname,
                'user_photo' => $res[0]->user_photo,
                'company' => $res[0]->company,
                'position' => $res[0]->usertype_id
            );

            $this->session->set_userdata('logged_in', $session_data);
            redirect('ManagerM');
        }  
        else if ($res[0]->usertype_id == 'utv' && $res[0]->user_status == 'OK') {
            $session_data = array (
                'user_email' => $res->user_email,
                'user_id' => $res->user_id,
                'usertype_name' => $res->usertype_name,
                'user_fname' => $res->user_fname,
                'user_mname' => $res->user_mname,
                'user_lname' => $res->user_lname,
                'user_photo' => $res->user_photo,
                'company' => $res[0]->company,
                'position' => $res[0]->usertype_id
            );
            $this->session->set_userdata('logged_in', $res); 
            redirect('Public_prof');
        }  
        else{
            redirect(base_url());
        }
    }

    function validate_credentials() {
        $pp= $this->input->post('password');
        $p = md5($pp);
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $p
        );
        
        $res = $this->Login_model->validate($data);
        $this->redirect_profile($res);
    }

    // function validate_credentials_by_fb(){
    //     $datame = null;
    //     if ($this->user) {
    //         $data['user_profile'] = $this->facebook->api('/me?fields=id,first_name,last_name,email,link,gender,locale,picture');
    //         $data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url() . '/auth/logout'));
    //         $this->session->set_userdata('logged_in', $datame['user_profile']);
            
    //         $datame  = array(
    //             'oauth_provider'=> 'Facebook',
    //             'user_id'       =>$data['user_profile']['id'],
    //             'user_fname'    => $data['user_profile']['first_name'],
    //             'user_lname'    => $data['user_profile']['last_name'],
    //             'user_email'    => $data['user_profile']['email'],
    //             'gender'        => $data['user_profile']['gender'],
    //             'locale'        => $data['user_profile']['locale'],
    //             'user_photo'    => $data['user_profile']['picture']['data']['url'],
    //             'link'          => $data['user_profile']['link'],
    //             'user_password' => md5('12345678'),
    //             'registered_date'=>  date("Y-m-d h:i:s"),
    //             'user_status'   => 'OK',
    //             'created'      =>  date("Y-m-d h:i:s"),
    //             'modified'  =>  date("Y-m-d h:i:s"),
    //             'city_id'   => '999',
    //             'usertype_id' => 'utv'
    //         );

    //         $datame2  = array(
    //             'user_fname'    => $data['user_profile']['first_name'],
    //             'user_lname'    => $data['user_profile']['last_name'],
    //             'user_email'    => $data['user_profile']['email'],
    //             'gender'        => $data['user_profile']['gender'],
    //             'locale'        => $data['user_profile']['locale'],
    //             'user_photo'    => $data['user_profile']['picture']['data']['url'],
    //             'modified'      =>  date("Y-m-d h:i:s"),

    //         );

            
    //         $this->Login_model->insertDatang(array('user_id' => $data['user_profile']['id']), $datame,$datame2);
    //         $data = array(
    //             'username' => $data['user_profile']['email']
    //         );

    //         $res = $this->Login_model->validate2($data);
    //         $this->redirect_profile($res);
    //     }
    //     else{
    //         $data['login_url_fb'] = $this->facebook->getLoginUrl();
    //         $this->load->view("public/header.php" );  
    //         $this->load->view("public/login_form.php", $data);
    //         $this->load->view("public/footer.php");
    //     }
    // }
    
    function logout() {
        
     $this->load->driver('cache');
     $sess_array = array(
        'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->session->sess_destroy();
        $this->cache->clean();
       
        $user =null;
        session_destroy();
        ob_clean();
        redirect(base_url());

    }

    public function validate_credentials_by_gmail() {

      
        $objOAuthService = new Google_Service_Oauth2($client);

        // Add Access Token to Session
        if (isset($_GET['code'])) {
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }

        // Set Access Token to make Request
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
        $client->setAccessToken($_SESSION['access_token']);
        }

        // Get User Data from Google and store them in $data
        if ($client->getAccessToken()) {
        $userData = $objOAuthService->userinfo->get();
        $data['user_profile'] = $userData;
        $_SESSION['access_token'] = $client->getAccessToken();
        } else {
        $authUrl = $client->createAuthUrl();
        $data['authUrl'] = $authUrl;
        }
        // Load view and send values stored in $data
        $this->load->view('public/profile.php', $data);
    }

        // Unset session and logout
    public function logout2() {
        unset($_SESSION['access_token']);
        redirect(base_url());
    }
}
 