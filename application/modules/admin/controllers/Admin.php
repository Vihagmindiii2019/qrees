<?php

class Admin extends Common_Back_Controller {
  	public function __construct(){
      	parent::__construct();
		$this->admin_user_session_key = ADMIN_USER_SESS_KEY; //user session key
       	$this->check_admin_user_session();
		$this->load->model('login_model');
  
  	}

  	function index(){
	  	$data['title'] =  'Member login';
	    $this->load->view('login', $data);
  	}//END OF INDEX FUNCTION

  	function login(){
  		$this->form_validation->set_rules('email','email or username','required');
      $this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[20]');
        // $this->form_validation->CI =& $this;
        if($this->form_validation->run() == FALSE){
            $data=array('status'=>0,'message'=>validation_errors(),'csrf'=>get_csrf_token()['hash']);
            	echo json_encode($data);
            	die();
        }
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $res = $this->login_model->login($email,$password);

        if($res['type'] == 'LS'){
            $data =array('status'=>1,'message'=>'Login successfully..','url'=>base_url().'admin/dashboard');
        }elseif($res['type'] == 'PDM'){
            $data=array('status'=>0,'message'=>'Invalid password','csrf'=>get_csrf_token()['hash']);

        }elseif($res['type'] == 'EDM'){

            $data=array('status'=>0,'message'=>'Invalid email','csrf'=>get_csrf_token()['hash']);

        }
        echo json_encode($data);
  	}//END OF LOGIN FUNCTION


  	function dashboard(){
	  	$data['title'] =  'Dashboard';
      $data['total_post'] = $this->login_model->getCount($where='',USER_POST);
      $data['total_post_views'] = $this->login_model->getCount($where='',VIEWS);
      $data['total_post_share'] = $this->login_model->getCount($where='',POST_SHARE);
      $data['total_users'] = $this->login_model->getCount($where='',USER);
      $data['total_comments'] = $this->login_model->getCount($where='',COMMENTS);
      $data['total_likes'] = $this->login_model->getCount($where='',LIKES);
      $this->load->admin_render('dashboard', $data);  
	    
  	}//END OF DASHBOARD FUNCTION

  	function logout(){
  		$this->admin_logout($is_redirect=TRUE);
  	}//END OF LOGOUT FUNCTION

    //view admin profile
    function admin_profile(){

        $data['title'] = "Admin profile";
        $where = array('adminId'=>$_SESSION[ADMIN_USER_SESS_KEY]['adminId']);
        $result = $this->common_model->getsingle(ADMIN,$where);
        $data['userData'] = $result;
        $this->load->admin_render('admin_profile', $data, '');
    }

    function admin_update(){

      $this->form_validation->set_rules('full_name','name','trim|required');
      $this->form_validation->set_rules('email','email','trim|required');
      if($this->form_validation->run($this) == FALSE){
        $messages = (validation_errors()) ? validation_errors() : '';
        $response = array('status' => 0, 'message' => $messages);
      }
      else{
        $update_data = array();
        $image = array(); 
        $where_id = $this->input->post('adminId');
        $existing_img = $this->input->post('exit_image');
        //================================================
        if(!empty($_FILES['image']['name'])){ 
            $this->load->model('image_model');   
            $upload = $_FILES['image']['name'];

            $imageName = 'image';
            $folder =  "user_avatar";
            $response = $this->image_model->upload_image($imageName,$folder);
            if(!empty($response['error'])){
                $response = array('status' =>0, 'message' =>'image should be proper in size','hash'=> get_csrf_token()['hash']);  
              echo json_encode($response); die;
            }
            //pr($response);
            $update_data['profile_image'] = $response['image_name'];
        }
        //================================================

        $set = array('full_name','email');
        foreach ($set as $key => $val) {
          $post= $this->input->post($val);
          $update_data[$val] = (isset($post) && !empty($post)) ? $post :''; 
        }
        $update_where = array('adminId'=>$where_id);
        $userId = $this->common_model->updateFields(ADMIN, $update_data, $update_where);

       
        $u_id = $_SESSION[ADMIN_USER_SESS_KEY]['adminId'];
        $user = $this->common_model->getsingle(ADMIN, array('adminId'=>$u_id));
        //update session 
        $_SESSION[ADMIN_USER_SESS_KEY]['fullName']      = $user->full_name ;
        $_SESSION[ADMIN_USER_SESS_KEY]['email']         = $user->email ;
        $_SESSION[ADMIN_USER_SESS_KEY]['profile_image'] = $user->profile_image;
        $_SESSION[ADMIN_USER_SESS_KEY]['isLogin']       = TRUE ;
       
        $response = array('status' => 1, 'message' => 'Successfully Updated', 'url' => base_url().'admin/admin_profile');         
      }
      echo json_encode($response); die;
    }

    public function change_password(){

      $this->load->library('form_validation');
      $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
      $this->form_validation->set_rules('npassword', 'new password', 'trim|required|matches[rnpassword]|min_length[6]');
      $this->form_validation->set_rules('rnpassword', 'retype new password ','trim|required|min_length[6]');

     if($this->form_validation->run($this) == FALSE){
       $messages = (validation_errors()) ? validation_errors() : '';
       $response = array('status' => 0, 'message' => $messages);
      }
      else{
        $password =$this->input->post('password');
        $npassword =$this->input->post('npassword');
        $select = "password";
        $where = array('adminId' => $_SESSION[ADMIN_USER_SESS_KEY]['adminId']); 
        $admin = $this->common_model->getsingle(ADMIN, $where,'password');
        if(password_verify($password, $admin->password)){
          $set =array('password'=> password_hash($this->input->post('npassword') , PASSWORD_DEFAULT)); 
          $update = $this->common_model->updateFields(ADMIN, $set, $where);
          if($update){
            $res = array();
            if($update){
              $response = array('status' => 1, 'message' => 'Successfully Updated', 'url' => base_url().'admin/admin_profile');
            }
            else{
              $response = array('status' => 0, 'message' => 'Failed! Please try again', 'url' => base_url().'admin/admin_profile');                
            }              
          } 
        }else{
          $response = array('status' => 0, 'message' => 'Your Current Password is Wrong !', 'url' => base_url().'admin/admin_profile');                 
        }
      }
      echo json_encode($response); die;  
    }//End Function

}
?>