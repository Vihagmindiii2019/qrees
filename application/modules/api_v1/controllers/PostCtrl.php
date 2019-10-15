<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PostCtrl extends Common_Service_Controller{

	function __construct()
	{
		parent::__construct();
        $this->load->model('Posts_model');
	}

	function createNewPost_post(){

		$this->check_service_auth();
		$user_id   = $this->authData->userId;
		$mediaType = $this->input->post('mediaType');

		$this->form_validation->set_rules('title', 'Post Title', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('description', 'Description', 'required|max_length[255]');
		$this->form_validation->set_rules('mediaType','Media Type','trim|required');
		
		if($this->form_validation->run() == false){
			$response=array('status'=>FAIL, 'message'=>strip_tags(validation_errors()));
 			$this->response($response);
		}

		// File Validation
		if(empty($_FILES['media']['name'])){

            $response = array('status' => FAIL, 'message' => get_response_message(131));
            $this->response($response);
        }
        else{ // video thumb need to uploading video time

            if($mediaType==2 && empty($_FILES['video_thumb']['name'])){
                $response = array('status' => FAIL, 'message' => get_response_message(132));
                $this->response($response);
            }
        }    

        $userPostMediaUpload = array();
        switch ($mediaType) {
            case 1: // for photo
                
                $this->load->model('image_model');
                $folder     = 'media_photo';
                $media = $this->image_model->upload_image('media',$folder);
                if(is_array($media) && !empty($media['error'])){
                    $response = array('status' => FAIL, 'message' =>strip_tags($media['error']));
                    $this->response($response);
                }
                $userPostMediaUpload['mediaName'] = $media['image_name'];
                $userPostMediaUpload['mediaType'] = 1;

                $mediaData['mediaType'] = 1;
                $mediaData['path']      = base_url().PHOTO_PATH.$media['image_name'];

                break;
            case 2: // for video
                
                if(!empty($_FILES['media']['name'])){

                    $this->load->model('video_model');            
                    $folder = 'media_video';
                    $media = $this->video_model->upload_video('media',$folder);
                    //check for upload error
                    if(is_array($media) && array_key_exists("error",$media)){
                        $response = array('status' => FAIL, 'message' => strip_tags($media['error']));
                        $this->response($response);
                    }
                }

                if(!empty($_FILES['video_thumb']['name'])){

                    $this->load->model('image_model');
                    $folder     = 'video_thumb';
                    $video_thumb = $this->image_model->upload_image('video_thumb',$folder);
                    if(is_array($video_thumb) && !empty($video_thumb['error'])){
                        $response = array('status' => FAIL, 'message' =>strip_tags($video_thumb['error']));
                        $this->response($response);
                    }
                }
                $userPostMediaUpload['mediaName']      = $media;
                $userPostMediaUpload['videoThumbnail'] = $video_thumb['image_name'];
                $userPostMediaUpload['mediaType']      = 2;

                $mediaData['mediaType'] = 2;
                $mediaData['path']      = base_url().VIDEO_PATH.$media;
                $mediaData['thumb'] = base_url().VIDEO_THUMB_PATH.$video_thumb['image_name'];

                break;
            case 3: // for audio
                
                if(!empty($_FILES['media']['name'])){

                    $this->load->model('audio_model');            
                    $folder = 'media_audio';
                    $media = $this->audio_model->upload_audio('media',$folder);
                    //check for upload error
                    if(is_array($media) && array_key_exists("error",$media)){
                        $response = array('status' => FAIL, 'message' => strip_tags($media['error']));
                        $this->response($response);
                    }
                }

                $userPostMediaUpload['mediaName'] = $media;
                $userPostMediaUpload['mediaType'] = 3;

                $mediaData['mediaType'] = 3;
                $mediaData['path']      = base_url().AUDIO_PATH.$media;

                break;                    
        }

        $userPostMediaUpload['title']       = $this->post('title');
        $userPostMediaUpload['description'] = $this->post('description');
        $userPostMediaUpload['userId']      = $user_id;

        if($userPostMediaUpload){
            $id = $this->common_model->insertData(USER_POST,$userPostMediaUpload);

            if($id){
                $response = array('status' => SUCCESS, 'message' => get_response_message(133),'mediaData'=>$mediaData); 
                $this->response($response); 
            }else{
                $response = array('status' => FAIL, 'message' => get_response_message(107));
                $this->response($response);
            }
        }
    }//end function

    function getAllPostfeeds_get(){

    	$this->check_service_auth();
    	$user_id = $this->authData->userId;

    	$postData = $this->Posts_model->get_all_post();

    	if(!$postData){
            //set failure msg
            $response = array('status' => FAIL,'message' => get_response_message(106), 'userDetail' => '');
            $this->response($response);
        }
        //set success msg
        $response = array('status' => SUCCESS,'message' => get_response_message(112), 'data'=> $postData);
        $this->response($response);
    }

    function updatePostLikes_post(){

    	$this->check_service_auth();
    	$user_id = $this->authData->userId;

    	$this->form_validation->set_rules('postId','Post Id ','trim|required');

    	if($this->form_validation->run() == false){
    		$response = array('status' => FAIL,'message' => strip_tags(validation_errors()));
    		$this->response($response);
    	}

    	$data['userId'] = $user_id;
    	$data['postId'] = $this->post('postId');
    	$where = array('postId'=>$data['postId'], 'userId' => $user_id);

        // check post exist or not 
    	$exist = $this->common_model->getsingle(USER_POST, $where, 'totalUserLikes');
    	//pr($exist);
		if(!$exist){ // post not exist...
			$response = array('status' => FAIL,'message' => get_response_message(136));
    		$this->response($response);
		}

        // check post liked  or not..
		$check = $this->common_model->is_data_exists(LIKES, $where);
		if($check){ // if post likes then status change post-unlike...
            $like_id = $this->common_model->deleteData(LIKES, $where);
            $likes['totalUserLikes'] = $exist->totalUserLikes - 1;
		}
        else{ // if post not likes then status change post-like...
    	   $like_id = $this->common_model->insertData(LIKES, $data);
    	   $likes['totalUserLikes'] = $exist->totalUserLikes + 1;
        }

    	if($like_id){
            //update post total likes count..
    		$update = $this->common_model->updateFields(USER_POST, $likes, array('postId'=>$data['postId']));
    		if($update){
    			$response = array('status' => SUCCESS,'message' => get_response_message(123), 'data'=> $likes);
        	$this->response($response);
    		}
    	}
    }


    function createPostComment_post(){

    	$this->check_service_auth();
    	$user_id = $this->authData->userId;

    	$this->form_validation->set_rules('postId','Post Id ','trim|required');
    	$this->form_validation->set_rules('commentMsg','Comment Message ','trim|required');

    	if($this->form_validation->run() == false){
    		$response = array('status' => FAIL,'message' => strip_tags(validation_errors()));
    		$this->response($response);
    	}

    	$data['userId'] = $user_id;
    	$data['postId'] = $this->post('postId');
    	$data['commentMsg'] = $this->post('commentMsg');
    	$where = array('postId'=>$data['postId']);

        //post exist or not...
    	$exist = $this->common_model->getsingle(USER_POST, $where, 'totalUserComments');
		if(!$exist){ // post not exist..
			$response = array('status' => FAIL,'message' => get_response_message(136));
    		$this->response($response);
		}

        // insert new comment....
    	$cmt_id = $this->common_model->insertData(COMMENTS, $data);

    	if($cmt_id){
            //update total count of comment in post
    		$updateData['totalUserComments'] = $exist->totalUserComments + 1;
    		$update = $this->common_model->updateFields(USER_POST, $updateData, $where);
    		if($update){
                //get comment data...
                $commentdata = $this->Posts_model->getCommentDetail($cmt_id);
                $commentdata = $updateData['totalUserComments'];
    			$response = array('status' => SUCCESS,'message' => get_response_message(122), 'data'=> $commentdata);
        	   $this->response($response);
    		}
    	}
    }

    function countPostView_post(){

    	$this->check_service_auth();
    	$user_id = $this->authData->userId;

    	$this->form_validation->set_rules('postId','Post Id ','trim|required');

    	if($this->form_validation->run() == false){
    		$response = array('status' => FAIL,'message' => strip_tags(validation_errors()));
    		$this->response($response);
    	}

    	$data['userId'] = $user_id;
    	$data['postId'] = $this->post('postId');
    	$where = array('postId'=>$data['postId']);

        //check post exist or not
    	$exist = $this->common_model->getsingle(USER_POST, $where, 'totalUserViews');
		if(!$exist){// post not eixst...
			$response = array('status' => FAIL,'message' => get_response_message(136));
    		$this->response($response);
		}
        //add user post views..
    	$insert = $this->common_model->insertData(VIEWS, $data);

    	if($insert){
            // update post totalview count...
    		$views['totalUserViews'] = $exist->totalUserViews + 1;
    		$update = $this->common_model->updateFields(USER_POST, $views, $where);
    		if($update){
    	        $response = array('status' => SUCCESS,'message' => get_response_message(122), 'data'=> $views);
        	    $this->response($response);
    		}
    	}
    }

    function updateUserPost_post(){

    	$this->check_service_auth();
    	$user_id = $this->authData->userId;

        $this->form_validation->set_rules('title','Post Title ','trim|required');
        $this->form_validation->set_rules('postId','Post Id ','trim|required');
        $this->form_validation->set_rules('description','Description ','trim|required');

        if($this->form_validation->run() == false){
            $response = array('status' => FAIL,'message' => strip_tags(validation_errors()));
            $this->response($response);
        }

        $updateData['title'] = $this->post('title');
        $updateData['description'] = $this->post('description');
        $post_id = $this->post('postId');
        $where  = array('postId' => $post_id);

        //check post id exist or not
        $exist = $this->common_model->is_id_exist(USER_POST, 'postId', $post_id);
        if(!$exist){
            $response = array('status' => FAIL,'message' => get_response_message(136));
            $this->response($response);
        }

        //update post detail..
        $update = $this->common_model->updateFields(USER_POST, $updateData, $where);

        // get user post's...
        $this->load->model('user_model');
        $postData = $this->user_model->getUserPost($user_id);
    
        $response = array('status' => SUCCESS,'message' => get_response_message(123), 'data'=> $postData);
        $this->response($response);
            
        
    }

    function deleteUserPost_post(){

    	$this->check_service_auth();
    	$user_id = $this->authData->userId;

    	$this->form_validation->set_rules('postId','Post Id ','trim|required');

    	if($this->form_validation->run() == false){
    		$response = array('status' => FAIL,'message' => strip_tags(validation_errors()));
    		$this->response($response);
    	}

    	$post_id = $this->post('postId');
    	$where  = array('postId' => $post_id, 'userId' => $user_id);

        // check post id exist or not
        $exist = $this->common_model->is_id_exist(USER_POST, 'postId', $post_id);
        if(!$exist){// not exist...
            $response = array('status' => FAIL,'message' => get_response_message(136));
            $this->response($response);
        }

        $file_name = $exist->mediaName;
        $file_type = $exist->mediaType;

    	//delete post and related all likes, comment ,views ,share detail..
    	$delete = $this->common_model->deleteData(USER_POST, $where);
    	if(!$delete){
            $response = array('status' => FAIL,'message' => get_response_message(107));
            $this->response($response);
        }

        switch ($file_type){
                case 1:
                    $this->load->model('image_model');
                    $path     = PHOTO_PATH;
                    $this->image_model->delete_image($path,$file_name);
                    break;

                case 2:
                    $this->load->model('video_model');
                    $path     = VIDEO_PATH;
                    $this->video_model->delete_video($path,$file_name);
                    break;

                case 3:
                    $this->load->model('audio_model');
                    $path     = AUDIO_PATH;
                    $this->audio_model->delete_audio($path,$file_name);
                    break;
            }

        $response = array('status' => SUCCESS,'message' => get_response_message(124));
        $this->response($response);

    }

    function updateUserPostComment_post(){

    	$this->check_service_auth();
    	$user_id = $this->authData->userId;

        $this->form_validation->set_rules('commentId','Comment Id ','trim|required');
        $this->form_validation->set_rules('postId','Post Id ','trim|required');
        $this->form_validation->set_rules('commentMsg','Comment Message ','trim|required');

        if($this->form_validation->run() == false){
            $response = array('status' => FAIL,'message' => strip_tags(validation_errors()));
            $this->response($response);
        }

        $updateData['commentMsg'] = $this->post('commentMsg');
        $cmt_id   = $this->post('commentId');
        $post_id  = $this->post('postId');

        // check post id exist or not
        $exist = $this->common_model->is_id_exist(USER_POST, 'postId', $post_id);
        if(!$exist){// not exist...
            $response = array('status' => FAIL,'message' => get_response_message(136));
            $this->response($response);
        }

        // update comment detail...
        $update = $this->common_model->updateFields(COMMENTS, $updateData, array('commentId'=>$cmt_id));

        //get comment detail...
        $commentdata = $this->Posts_model->getCommentDetail($cmt_id);
        $response = array('status' => SUCCESS,'message' => get_response_message(123), 'data'=> $commentdata);
        $this->response($response);


    }

    function deleteUserPostComment_post(){

    	$this->check_service_auth();
        $user_id = $this->authData->userId;

        $this->form_validation->set_rules('commentId','Comment Id ','trim|required');
        $this->form_validation->set_rules('postId','Comment Id ','trim|required');

        if($this->form_validation->run() == false){
            $response = array('status' => FAIL,'message' => strip_tags(validation_errors()));
            $this->response($response);
        }

        $cmt_id = $this->post('commentId');
        $post_id  = $this->post('postId');
        $where  = array('commentId' => $cmt_id, 'userId' => $user_id);

        //check post exist or not..
        $postExist = $this->common_model->getsingle(USER_POST, array('postId' => $post_id), 'totalUserComments');
        if(!$postExist){ // not exist...
            $response = array('status' => FAIL,'message' => get_response_message(136));
            $this->response($response);
        }

        //delete post comment
        $delete = $this->common_model->deleteData(COMMENTS, $where);
        if(!$delete){
            $response = array('status' => FAIL,'message' => get_response_message(107));
            $this->response($response);
        }

        // update totalUserComments in post table 
        $comments['totalUserComments'] = $postExist->totalUserComments - 1;
        $update = $this->common_model->updateFields(USER_POST, $comments, array('postId'=>$post_id));

        $response = array('status' => SUCCESS,'message' => get_response_message(124), 'data'=> $comments);
         $this->response($response);
        
    }
	

}
