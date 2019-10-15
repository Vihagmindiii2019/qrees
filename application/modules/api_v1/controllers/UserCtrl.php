<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserCtrl extends Common_Service_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('User_model');
	}
	
    function getUserProfile_get(){

        $this->check_service_auth();
        $user_id = $this->authData->userId;
        $data['user_info'] = $this->User_model->getUserInfo($user_id );
        //pr($data['user_info']);
        if(!$data['user_info']){
            //set failure msg
            $response = array('status' => FAIL,'message' => get_response_message(106), 'userDetail' => '');
            $this->response($response);
        }

        $data['user_posts'] = $this->User_model->getUserPost($user_id);
        //pr($data);
        /*if(!$data['user_posts']){
            //set failure msg
            $response = array('status' => FAIL,'message' => get_response_message(106), 'userDetail' => '');
            $this->response($response);
        }*/
        
        //set success msg
        $response = array('status' => SUCCESS,'message' => get_response_message(112), 'data'=> $data);
        $this->response($response);
    }

    function updateUserProfile_post(){

    	$this->check_service_auth();
    	$user_id = $this->authData->userId;
        $existing_img = $this->input->post('exit_image');
        
    	$this->form_validation->set_rules('userName', 'UserName', 'trim|required|min_length[5]|alpha_numeric_spaces');

		// if form validation rule fail set  msg for response
		if($this->form_validation->run()==false){
			$response = array('status'=>FAIL, 'message'=>strip_tags(validation_errors()));
			$this->response($response);
		}

		// Code for Profile image update
        if(!empty($_FILES['profileImage']['name'])){ 
            $image_name  = 'profileImage';
            $folder = 'user_avatar';
            $image = $this->Image_model->upload_image($image_name, $folder);

            if(array_key_exists("error",$image) && !empty($image['error'])){
                $response = array('status' => 0, 'message' =>$image['error']); 
                $this->response($response);   
            }          
            if(array_key_exists("image_name",$image)){

                $user_image = $image['image_name'];
                if(!empty($user_image)){
                    $updatedata['profileImage'] = $user_image;
                    $this->Image_model->delete_image(USER_AVATAR_PATH,$existing_img);
                }
            }      
        }//end image insert

        $updatedata['userName']    = $this->post('userName');
		$where    = array('userId'=>$user_id);

		//Update user profile
		$result = $this->common_model->updateFields(USER, $updatedata, $where);
            //check profile update
            if($result == false){
                //if not set msg
                $response = array('status'=>FAIL,'message'=>'Your Profile not updated.');
                $this->response($response);
            }
            //set msg for success
            $response = array('status'=>SUCCESS,'message'=>'Your profile has been updated successfully.');
            $this->response($response);
    }

     //change user password
    function changePassword_post(){

        $this->check_service_auth();
        //set validation rule
        $this->form_validation->set_rules('oldPassword', 'current password', 'required');
        $this->form_validation->set_rules('newPassword', 'new password', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('cPassword', 'Confirm Password', 'trim|required|matches[newPassword]');
        //set response msg  for form validation
        if($this->form_validation->run() == FALSE){
            $response = array('status' => FAIL, 'message' => strip_tags(validation_errors()));
            $this->response($response);
        }
        //get user id from auth data
        $user_id  = $this->authData->userId;
        $where    = array('userId'=>$user_id);
        //check for social registered user try to update password
        $error = $this->common_model->getsingle(USER,array('userId'=> $user_id));
        if(!empty($error->social_id)){
            $response = array('status' => FAIL, 'message' => "This account is associated with Facebook or Google , so you can't be update password.");
            $this->response($response);
        }
        //get data
        $oldPassword = $this->post('oldPassword');
        $newPassword = $this->post('newPassword');
        $newPasswordHash = password_hash($this->post('newPassword') , PASSWORD_DEFAULT);
        //get user data from table
        $userData = $this->common_model->getsingle(USER,$where,'password');
        //password verify
        if(password_verify($oldPassword, $userData->password)){
            //check curent and new password are same
            if(password_verify($newPassword, $userData->password)){
                //set msg for new password are same 
                $response = array('status'=>FAIL,'message'=>'Current password and New Password are same');
                $this->response($response);
            }
            //set data for update 
            $updatedata = array('password'=>$newPasswordHash);
            //update password
            $result = $this->common_model->updateFields(USER, $updatedata, $where);
            //check password update
            if($result == false){
                //if not set msg
                $response = array('status'=>FAIL,'message'=>'Your password not updated.');
                $this->response($response);
            }
            //set msg for success
            $response = array('status'=>SUCCESS,'message'=>'Your password has been updated successfully.');
            $this->response($response);
        }else{
            //set msg for password not match with current password
            $response = array('status'=>FAIL,'message'=>'Your password does not matched with old password.');
            $this->response($response);
        }
    }


}


