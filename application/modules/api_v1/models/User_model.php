<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	function getUserInfo($user_id){
        $url_image = USER_AVATAR_PATH.'profile/thumb/';
        $url_placeholder = base_url().USER_DEFAULT_AVATAR;
        $this->db->select('userId, userName, email,authToken,status,deviceType,deviceToken,crd,upd,
            (case when( profileImage = "" OR profileImage IS NULL) 
            THEN "'.$url_placeholder.'"
            when( @http = "http" OR @https = "https") 
            THEN profileImage
            ELSE
            concat("'.$url_image.'",profileImage) 
            END ) as profileImage,            
            ');
        $this->db->from(USER);
        $this->db->where('userId', $user_id);     
        $query = $this->db->get(); 
        if(!$query){
            $this->output_db_error();
        }
        $user_info = $query->row();
        return $user_info;
   }

   function getUserPost($user_id){
   		$this->db->select('postId, title, description,crd,mediaType,mediaName');
        $this->db->from(USER_POST);
        $this->db->where('userId', $user_id);
        $this->db->order_by("upd", "DESC");   
        $query = $this->db->get(); 
        if(!$query){
            $this->output_db_error();
        }
        $post_info = $query->result();
        return $post_info;
   }


}