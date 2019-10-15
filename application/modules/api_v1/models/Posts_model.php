<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model {

	function get_all_post(){
		$this->db->select('u.userName, up.postId, up.title, up.description, up.mediaType,
		totalUserLikes, totalUserComments, totalUserViews, up.mediaName, up.crd');
		$this->db->from(USER_POST.' as up');
		$this->db->join(USER.' as u', 'u.userId = up.userId');
		
		$this->db->order_by("up.crd", "DESC");
		$query = $this->db->get()->result();

		return $query;
	}

	function getPostDetail($post_id){
		$this->db->select('u.userName, up.postId, up.title, up.description, up.mediaType,
		totalUserLikes, totalUserComments, totalUserViews, up.mediaName, up.crd');
		$this->db->from(USER_POST.' as up');
		$this->db->join(USER.' as u', 'u.userId = up.userId');

		$this->db->where('up.postId',$post_id);
		$query = $this->db->get();
		//lq();
		return $query->row();
		
	}

	function getCommentDetail($id){

		$result = $this->common_model->getsingle(COMMENTS, array('commentId' => $id));
		return $result;
	}
}