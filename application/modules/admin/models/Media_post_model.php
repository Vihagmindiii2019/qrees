<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Media_post_model extends CI_Model{

	function __construct(){
	// Call the Model constructor
	parent::__construct();
	}

	//var $table , $column_order, $column_search , $order = '';

	var $column_order = array('t1.postId','t2.userName','t2.email','t1.title','t1.mediaType','t1.description'); //set column field database for datatable orderable
	var $column_search = array('t1.title','t2.userName','t2.email'); //set column field database for datatable searchable
	var $order = array('t1.postId'=>'DESC'); // default order
	var $where = array();
	public function set_data($where=''){
	$this->where = $where;
	}

	function prepare_query(){

		$sel_fields = array_filter($this->column_order);
		$this->db->select($sel_fields);
		$this->db->from(USER_POST.' as t1');
		$this->db->join(USER.' as t2','t2.userId = t1.userId');

		if(!empty($this->where)){
			$data = $this->db->where($this->where);
		}
	}
	private function posts_get_query(){

		$this->prepare_query();
		$i = 0;
		foreach ($this->column_search as $emp){ // loop column 

		if(isset($_POST['search']['value']) && !empty($_POST['search']['value'])){
			$_POST['search']['value'] = $_POST['search']['value'];
		} else
			$_POST['search']['value'] = '';

		if($_POST['search']['value']){ // if datatable send POST for search

		if($i===0){ // first loop

			$this->db->group_start();
			$this->db->like(($emp), $_POST['search']['value']);
		}else{
			$this->db->or_like(($emp), $_POST['search']['value']);
		}

		if(count($this->column_search) - 1 == $i){
			$this->db->group_end(); //close bracket
		} //last loop

		}
		$i++;
		}

		if(isset($_POST['order'])){ // here order processing

			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	function get_list(){

		$this->posts_get_query();
		if(isset($_POST['length']) && $_POST['length'] < 1) {
			$_POST['length'] = '10';
		} else
			$_POST['length']= $_POST['length'];

		if(isset($_POST['start']) && $_POST['start'] > 1) {
			$_POST['start'] = $_POST['start'];
		}
		$this->db->limit($_POST['length'], $_POST['start']);

		$query = $this->db->get();


		return $query->result();
	}

	function count_filtered(){

	$this->posts_get_query();
	$query = $this->db->get();
	return $query->num_rows();

	}

	function count_all(){

	$this->prepare_query();
	return $this->db->count_all_results();
	}

	//function for name of category
	function getcategory($table, $where) {
        $this->db->where($where);
        $q = $this->db->get($table);
        return $q->result();
    }


}