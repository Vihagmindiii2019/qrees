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

	function get_all_like($post_id){
		$this->db->select('u.userName, u.profileImage');
		$this->db->from(LIKES.' as lk');
		$this->db->join(USER.' as u', 'u.userId = lk.userId');
		$this->db->where('lk.postId',$post_id);
		
		$this->db->order_by("lk.crd", "DESC");
		$query = $this->db->get()->result();

		return $query;
	}

	function get_all_comment($post_id){
		$this->db->select('u.userName, u.profileImage, ct.commentMsg, ct.crd');
		$this->db->from(COMMENTS.' as ct');
		$this->db->join(USER.' as u', 'u.userId = ct.userId');
		$this->db->where('ct.postId',$post_id);
		
		$this->db->order_by("ct.crd", "DESC");
		$query = $this->db->get()->result();

		return $query;
	}

	function get_all_views($post_id){
		$this->db->select('u.userName, u.profileImage');
		$this->db->from(VIEWS.' as vw');
		$this->db->join(USER.' as u', 'u.userId = vw.userId');
		$this->db->where('vw.postId',$post_id);
		
		$this->db->order_by("vw.crd", "DESC");
		$query = $this->db->get()->result();

		return $query;
	}
}