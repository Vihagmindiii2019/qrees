<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends Common_Service_Controller{

	function signup_post(){
		$this->form_validation->set_rules('userName', 'UserName', 'trim|required|min_length[5]|alpha_numeric_spaces');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/]');

		// if form validation rule fail set  msg for response
		if($this->form_validation->run()==false){
			$response = array('status'=>FAIL, 'message'=>strip_tags(validation_errors()));
			$this->response($response);
		}

        $data['userName']    = $this->input->post('userName');
        $data['email']       = $this->input->post('email');
        $data['password']    = $this->hash($this->post('password'));
        $data['deviceToken'] = $this->post('deviceToken');
        $data['deviceType']  = $this->post('deviceType');

        $exist = $this->Common_model->getsingle(USER, array('email'=>$data['email']));
        if($exist){ // Email Already exist
           $response=array('status'=>FAIL, 'message'=>get_response_message(110));
            $this->response($response); 
        }

		// Code for Profile image insert
        if(!empty($_FILES['profileImage']['name'])){ 
            $image_name  = 'profileImage';
            $folder = 'user_avatar';
            $image = $this->Image_model->upload_image($image_name, $folder);         

            if(array_key_exists("error",$image) && !empty($image['error'])){
                $response = array('status' => 0, 'message' =>$image['error']); 
                $this->response($response);   
            }      
            $data['profileImage'] =  $image['image_name'];                 
        }//end image insert
		
		//Create new user
		$user_data = $this->service_model->user_signup($data);

		switch ($user_data['status']) {
         	case 'EAE': //email already exist
         		$response=array('status'=>FAIL, 'message'=>get_response_message(110));
         		$this->response($response);
         		break;

         	case 'RS': //registered successfully 
         		$response=array('status'=>SUCCESS, 'message'=>get_response_message(105), 'data'=>$user_data['user_data']);
         		$this->response($response);
         		break;

         	default: //something went wrong
         		$response=array('status'=>FAIL, 'message'=>get_response_message(107));
         		$this->response($response);
         		break;
        }

	}

	function hash($password){
       $hash = password_hash($password,PASSWORD_DEFAULT);
       return $hash;
    }

	function login_post(){
		$this->form_validation->set_rules('email', 'Email Id', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/]');

		// if form validation rule fail set  msg for response
		if($this->form_validation->run()=== false){
			$response=array('status'=>FAIL, 'message'=>strip_tags(validation_errors()));
			$this->response($response);
		}
		$data['email']       = $this->post('email');
		$data['password']    = $this->post('password');
		$data['deviceToken'] = $this->post('device_token');
		$data['deviceType']  = $this->post('device_type');
        
		 //check user detail 
        $user_data  = $this->service_model->user_login($data);
        //echo "string"; pr($user_data);
        switch ($user_data['status']) {
         	case 'IE': //invalid email
         		$response=array('status'=>FAIL, 'message'=>get_response_message(153));
         		$this->response($response);
         		break;

         	case 'IP': //invalid password
         		$response=array('status'=>FAIL, 'message'=>get_response_message(154));
         		$this->response($response);
         		break;

         	case 'SL': //login success
         		$response=array('status'=>SUCCESS, 'message'=>get_response_message(155), 'data'=>$user_data['user_data']);
         		$this->response($response);
         		break;

         	default: //something went wrong
         		$response=array('status'=>FAIL, 'message'=>get_response_message(107));
         		$this->response($response);
         		break;
        } 
        
	}


    // forgot password
    function forgotPassword_post(){
        
        $this->load->library('smtp_email'); //load smtp library
        //set form validation 
        $this->form_validation->set_rules('email','Email','required|valid_email');
        //from validation fail set msg
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
            $this->response($response);
        }
        // get user details 
        $result = $this->Common_model->getsingle(USER, array('email'=> sanitize_input_text($this->post('email'))));  
        if(!$result){//check email exist or not
            $response = array('status'=>FAIL,'message'=> get_response_message(115));
            $this->response($response);  
        }
        if(!empty($result->social_id)){
            $response = array('status'=>FAIL,'message'=> get_response_message(118));
            $this->response($response);  
        }
        //set data for mail user 
        $to= $result->email;
        //generate new password
        $random = substr(md5(mt_rand()), 0, 10);
        //hash password
        $new_password = password_hash($random, PASSWORD_DEFAULT);
        //update password in table
        $updateData = $this->Common_model->updateFields(USER, array('password'=>$new_password, 'upd' =>datetime()), array('userId'=>$result->userId));
        
        //set data for mail user 
        $data['name'] = $result->userName;
        $data['password'] = $random;
        $subject = "Qrees- Reset Password";
        $message = $this->load->view('email/reset_password',$data,TRUE);
        //send mail
        $check   =  $this->smtp_email->send_mail($to,$subject,$message);

        if($check !== TRUE){
            //set responce for user
            $response = array('status'=> SUCCESS,'message'=>"Error in sending email",'smtp_error' => $check);
            $this->response($response);
        }
        //set responce for user
        $response = array('status'=> SUCCESS,'message'=>"Your password has been sent to your email");
        $this->response($response);
    } //End Fn


    //user log out
    function logout_get(){

        $this->check_service_auth();
        //get user id from auth data
        $userId  = $this->authData->userId;
        //empty device token on when user logged out
        $logout = $this->Common_model->updateFields(USER, array('deviceToken' =>'','authToken'=>''),array('userId'=>$userId ));
        //set msg for success
        $response = array('status'=>SUCCESS,'message'=>get_response_message(125));
        $this->response($response);
    }

}
