<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {


	function user_signup($data){
		
        $data['authToken'] = $this->generate_token();
		$result = $this->common_model->insertData(USER,$data);
		 
		$user_data  = $this->get_user_by_id($result); //echo 12; pr($user_data);
        return array('status'=>'RS','user_data'=>$user_data);
	}

	function user_login($data){
		  // check email exist or not
        $exist = $this->common_model->getsingle(USER,array('email'=>$data['email']));

        if(!$exist){
        	return array('status'=>'IE'); //IE invalid email or  not exist
        }

        //password verify
        if(!password_verify($data['password'],$exist->password)){ 
        	return array('status'=>'IP'); //IP invalid passwords not exist
        }

        $update_data['authToken']   = $this->generate_token();
        $update_data['deviceToken'] = $data['deviceToken'];
        $update_data['deviceType']  = $data['deviceType'];
        //update divice token and auth token
        $update = $this->common_model->updateFields(USER,$update_data,array('userId'=>$exist->userId)); 
        $user_data  = $this->get_user_by_id($exist->userId); //echo 12; pr($user_data);
        return array('status'=>'SL','user_data'=>$user_data);
	}

	function generate_token(){
        $this->load->helper('string');
        $new_token = random_string('alnum', 32);  //Generate random string for user auth token
        return $new_token;
    }

    function get_user_by_id($where){
    	$query=$this->db->select('userId,userName,email,profileImage,authToken,status')->where('userId',$where)->get(USER);
 		 //lq();
    	if($query->num_rows())
            {
               return $query->row();
            }
    }
    
    function isValidToken($authToken){
    	$this->db->select('*');
		$this->db->where('authToken',$authToken);
		if($sql = $this->db->get('users'))
		{
			if($sql->num_rows() > 0)
			{
				return $sql->row();
			}
		}
		return false;
    }


    function forgotPassword($email)
    {
        $sql = $this->db->select('id,userName as name,email,password')->where(array('email'=>$email))->get('users');
        if($sql->num_rows())
        {
            $this->load->library('encrypt');
            $result = $sql->row();
            $useremail= $result->email;
            $password="Your Password is :-".$this->encrypt->decode( $result->password) ;
            $data['name'] = $result->name;
            $data['password'] = $password;
            $message  = $this->load->view('emails/forgot_password',$data,TRUE);
            //print_r($message); die;
            $subject = " Forgot Password";
            //$forgot = send_email($useremail,$message,$subject); 
            return $this->emailSent($useremail,$message,$subject);
        }
        else
        {
            return false;
        }
    } //End funtion

    function emailSent($useremail,$message,$subject)
    {
        $this->load->library('email');

        $config = array();
        $config['useragent']  = "CodeIgniter";
        $config['mailpath']  = "/usr/sbin/sendmail"; 
        $config['protocol'] = "sendmail";
        $config['smtp_host']= "mindiii.com";
        $config['smtp_port'] = "25";
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->from('noreply@mindiii.com', 'LightGeneration');
        $this->email->to($useremail);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send())
        {  
            return  array('emailType'=>'ES','email'=>'Your password has been successfully sent to your email address!!' ); //ES emailSend
        }
        else
        { 
            return  array('emailType'=>'NS','email'=> 'Email is not Exist ') ; //NS NotSend
        }
    }//End function



}
