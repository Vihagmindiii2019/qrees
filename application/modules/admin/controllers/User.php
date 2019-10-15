<?php

class User extends Common_Back_Controller {
  	public function __construct(){
      	parent::__construct();
		$this->admin_user_session_key = ADMIN_USER_SESS_KEY; //user session key
       	$this->check_admin_user_session();
		$this->load->model('user_model');
  
  	}

  	function index(){
  		$data['title'] = 'User List';
  		$this->load->admin_render('users/user_list',$data);
  	}//END OF INDEX FUNCTION

  	function user_list_ajax(){
  		//$this->check_admin_ajax_auth();
	    $no = $_POST['start'];
	    //$this->user_model->set_data(array('parent_category_id'=>0));
	    $list = $this->user_model->get_list();
	        $data = array();
	        foreach ($list as $userData) {
			if(!empty($userData->profileImage && (empty($userData->is_profile_url)))){ 
				$file = CDN_USER_THUMB_IMG.$userData->profileImage;
				$fileName = CDN_USER_THUMB_IMG.$userData->profileImage;
			}elseif(!empty($userData->is_profile_url)){
				$fileName = $userData->profileImage;
			}else{
				$fileName = USER_DEFAULT_AVATAR;
			}
	        $action ='';
	        $no++;
	        $row = array();
	        $row[] = display_placeholder_text($no); 
	        $row[] = "<img  style='width:40px; height:40px;' src='".$fileName."'class='img-circle' alt='User Image'>&nbsp; "."<span title='".$userData->userName."'>".display_placeholder_text($userData->userName)."</span>"; 
	        //$row[] = display_placeholder_text($userData->full_name); 
	        $row[] = display_placeholder_text($userData->email); 
	        //$row[] = display_placeholder_text($userData->status); 
	       $statuChange = "statuChangeUser('admin/user','$userData->userId');";
	        if($userData->status == 1) { $row[] =  '<p style="cursor: pointer;"  class="text-success">Active</p>'; } else { $row[] =  '<p style="cursor: pointer;"  class="text-danger">Inactive</p>'; } 
	        	$userId = encoding($userData->userId);
	        $action = '<div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                          <span class="caret"></span>
                        <div class="ripple-container"></div></button>
                        <ul class="dropdown-menu">
                          <li><a style="font-size:17px;" href="user/user_detail?id='.$userId.'"  class="on-default edit-row table_action "><i class="fa fa-eye text-success"></i> Detail</i></a></li>';
                          if($userData->status == 0) {
                         $action .= '<li><a href="javascript:void(0)" onclick="'.$statuChange.'" class="on-default edit-row table_action"><i style="font-size:17px;" class="fa fa-check text-success" aria-hidden="true"></i>&nbsp;Active</a></li>';}
                          else{
                         $action .=  '<li><a style="font-size:17px;" href="javascript:void(0)"onclick="'.$statuChange.'" class="on-default edit-row table_action danger"><i style="font-size:17px;" class="fa fa-times text-danger" aria-hidden="true"></i>&nbsp;Inactive</a></li>
                          
                        </ul>
                      </div>';	}
	        $row[] = $action;
	        $data[] = $row;

	        }

	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->user_model->count_all(),
	            "recordsFiltered" => $this->user_model->count_filtered(),
	            "data" => $data,
	            "csrf"=>get_csrf_token()['hash']
	        );
	        //output to json format
	        echo json_encode($output);
  	}//END OF USER LISTING FUNCTION

  	function statuChangeUser(){
    	//$this->check_admin_ajax_auth();
    	$id = $_GET['id'];
    	$where = array('userId'=>$id,'status'=>1);
    	$dataexist = $this->common_model->is_data_exists(USERS,$where);
    	if(!empty($dataexist)){
	    	$dataZero = array('status'=>0);
	    	$update = $this->common_model->updateFields(USERS,$dataZero,$where);
	    	$message = 'User inactivated successfully';
    	}else{
    		$wheres = array('userId'=>$id);
    		$dataOne = array('status'=>1);
	    	$update = $this->common_model->updateFields(USERS,$dataOne,$wheres);
	    	$message = 'User activated successfully';
    	}
    	if($update){
    		$data=array('status'=>1,'url'=>'','message'=>$message);
				echo json_encode($data);
    	}else{
    		$data=array('status'=>0,'message'=>'somethig went wrong');
				echo json_encode($data);
    	}
	}//END OF USER STATUS UPDATE FUNCTION

	function user_detail(){
		$id = decoding($_GET['id']);
		$data['title'] = 'User Detail';
		$data['info'] = $this->user_model->getData($id);
		$this->load->admin_render('users/user_detail',$data);
	}

}
?>