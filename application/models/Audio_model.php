<?php
/**
 * Handles audio upload and resizing
 * version: 1.0 (14-03-2019)
 */
class Audio_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->helper('string');
	}

	/**
	 * Upload audio and create resized copies
	 * Modified in ver 1.0
	 */
	function upload_audio($audio, $folder, $path = FALSE){

		$this->make_dirs($folder);
		$realpath = $path ? '../uploads/' : 'uploads/';
		$allowed_types = "ogg|wav|wma|mp3|wma";
		$audio_name = random_string('alnum', 16); //generate random string for image name
		$config = array(
			'upload_path' => $realpath . $folder,
			'allowed_types' => $allowed_types,
			'max_size' => "10480", // File size 204.8 limitation, initially w'll set to 10mb (Can be changed)
			'file_name' => $audio_name,
			'overwrite' => FALSE,
			'remove_spaces' => TRUE,
			'quality' => '100%',
		);
		$this->load->library('upload'); //upload library
		$this->upload->initialize($config);
		if (!$this->upload->do_upload($audio)){
			$error = array(
				'error' => $this->upload->display_errors()
			);
			return $error; //error in upload
		}

		$audio_data = $this->upload->data(); //get uploaded data
		$this->load->library('image_lib'); //image library
		$real_path = realpath(FCPATH . $realpath . $folder);
		$resize['source_image'] = $audio_data['full_path'];
		$resize['maintain_ratio'] = FALSE;
		$resize['quality'] = '100%';
		$this->image_lib->initialize($resize);
		$this->image_lib->resize();
		$this->image_lib->clear(); //clear memory
		return $audio_data['file_name'];

	}

	/**
	 * Make upload directory
	 * Modified in ver 1.0
	 */
	function make_dirs($folder = '', $mode = DIR_WRITE_MODE, $defaultFolder = 'uploads/'){
		if (!@is_dir(FCPATH . $defaultFolder)){
			mkdir(FCPATH . $defaultFolder, $mode);
		}

		if (!empty($folder)){
			if (!@is_dir(FCPATH . $defaultFolder . '/' . $folder)){
				mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode, true);
			}
		}
	}

	// not used in new version -- kept for backward compatibility

	function makedirsBk($folder = '', $mode = DIR_WRITE_MODE, $defaultFolder = '../uploads/'){
		if (!@is_dir(FCPATH . $defaultFolder)){
			mkdir(FCPATH . $defaultFolder, $mode);
		}

		if (!empty($folder)){
			if (!@is_dir(FCPATH . $defaultFolder . '/' . $folder)){
				mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode, true);
			}
		}
	}

	// delete(unlink) video from folder/server

	function delete_audio($path, $file){
		$main = $path . $file;
		if (file_exists(FCPATH . $main)):
			unlink(FCPATH . $main);
		endif;
		return TRUE;
	}
}
