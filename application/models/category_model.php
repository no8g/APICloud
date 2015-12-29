<?php
	
 /**
 * CATEGORY Model
 * A class provided some methods to CURD data in talbe community
 * Created on 2015/11/28
 * @author zhangrq5 
 * @version 1.0
 */

class Category_Model extends CI_Model {

	/**
 	 * 表名
 	 * @var string
 	 */
 	const TABLE_NAME = 'category';

 	/**
 	 * 表字段名称
 	 */
 	const ID = 'id';
 	const NAME = 'name';
 	const DESCRIPTION = 'description';
 	const LEVEL = 'level';
 	const PARENT_ID = 'parent_id';
	const STATE = 'state';
	const UPDATE_TIME = 'update_time';
	const RANK = 'rank';

 	function __construct()
 	{
 		parent::__construct();
 	}

	function get_categories(){
		$this->db->where(self::STATE, 1);
		$this->db->from(self::TABLE_NAME);
		$this->db->
		$res = $this->db->get();
		if($res->num_rows() > 0)
			return $res->result();
		else
			return false;
	}

	function get_name_by_id($cid =0){
		if ($cid == 0){
			return "无";
		}else{
			$this->db->select(self::NAME);
			$this->db->where(self::STATE, 1);
			$this->db->where(self::ID, $cid);
			$this->db->from(self::TABLE_NAME);
			$res = $this->db->get();
			if($res->num_rows() > 0)
				return $res->row()->name;
			else
				return false;
		}
	}
	function get_categories_by_pid($parent_id  = 0){
		if (!is_numeric($parent_id)){
			return false;
		}else{
			$this->db->where(self::PARENT_ID, $parent_id);
			$this->db->where(self::STATE, 1);
			$this->db->from(self::TABLE_NAME);
			$this->db->order_by(self::RANK, 'DESC');
			$this->db->order_by(self::UPDATE_TIME, 'DESC');
			$res = $this->db->get();
			if($res->num_rows() > 0)
	 			return $res->result();
	 		else
	 			return false;
		}
	}
	function insert_entry($entry){
		$this->db->insert(self::TABLE_NAME, $entry);
		if($this->db->affected_rows() > 0) {
			log_message('debug', $this->db->last_query().'; id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
			return $this->db->insert_id();
		}
		else {
			log_message('debug', $this->db->last_query());
			return false;
		}
	}
	function update_entry($entry, $id){
		$this->db->where(self::ID, $id);
		$this->db->update(self::TABLE_NAME, $entry);
		if($this->db->affected_rows() > 0) {
			log_message('debug', $this->db->last_query().'; id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
			return $this->db->affected_rows();
		}
		else {
			log_message('debug', $this->db->last_query());
			return false;
		}
	}
	function update_state_by_id ($id, $state = 0){
		if($id == 0)
			return false;
		$this->db->where(self::ID, $id);
		$this->db->update(self::TABLE_NAME, array(self::STATE => $state));
		if($this->db->affected_rows() > 0) {
			log_message('debug', $this->db->last_query().'; id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
			return $this->db->affected_rows();
		}
		else {
			log_message('debug', $this->db->last_query());
			return false;
		}
	}
	function get_parents_by_id($id){
		if($id == null){
			return false;
		}
		$row = self::get_row_v2($id);
		$level = $row['level'];
		$array = array();
		array_push($array, $row);
		$pid = $row['parent_id'];
		for ($i=1; $i<$level; $i++){
			$row = $this->get_row_v2($pid);
			array_push($array, $row);
			$pid = $row['parent_id'];
		}
		return $array;
	}
	function get_level_by_id($id){
		if ($id ===0){
			return 0;
		}

		$this->db->select(self::LEVEL);
		$this->db->from(self::TABLE_NAME);
		$this->db->where(self::STATE, 1);
		$this->db->where(self::ID, $id);
		$res = $this->db->get();
		if($res->num_rows() > 0 ) {
			$row = $res->row();
			return $row->level;
		}else{
			return false;
		}
	}
	function get_row($id){
		if ($id ==null){
			return false;
		}
		$this->db->where(self::ID, $id);
		$this->db->where(self::STATE, 1);
		$this->db->from(self::TABLE_NAME);
		$res = $this->db->get();
		if($res->num_rows() >0) {
			return $res->result_array();
		}else{
			return false;
		}
	}

	function get_row_v2($id){
		if ($id ==null){
			return false;
		}
		$this->db->where(self::ID, $id);
		$this->db->where(self::STATE, 1);
		$this->db->from(self::TABLE_NAME);
		$res = $this->db->get();
		if($res->num_rows() >0) {
			return $res->result_array()[0];
		}else{
			return false;
		}		
	}

	/**
	 * @param $id
	 * @return object
	 * @use: show_cate_update
	 */
	function get_category_object($id){
		if ($id ==null){
			return false;
		}
		$this->db->where(self::ID, $id);
		$this->db->where(self::STATE, 1);
		$this->db->from(self::TABLE_NAME);
		$res = $this->db->get();
		if($res->num_rows() > 0) {
			return $res->row();
		}else{
			return false;
		}
	}

	function update_rank_by_id($id, $rank){
		if($id == 0){
			return false;			
		}
		if($rank == 0){
			return false;
		}
		$this->db->where(self::ID, $id);
		$this->db->update(self::TABLE_NAME, array(self::RANK => $rank));
		if($this->db->affected_rows() > 0) {
			log_message('debug', $this->db->last_query().'; id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
			return $this->db->affected_rows();
		}
		else{
			log_message('debug', $this->db->last_query());
			return false;
		}
	}
 	function update_ranks($categories){
 		$rank = count($categories);
 		$this->db->trans_start();
 		foreach ($categories as $i) {
 			$update_id = $this->update_rank_by_id($i, $rank);
 			$rank--;
 		}
 		$this->db->trans_commit();
 		return true;
 	}
	function check_category_id($id){
		if ($id == 0){
			 return true;
		}
		$this->db->where(self::ID, $id);
		$this->db->where(self::STATE, 1);
		$this->db->from(self::TABLE_NAME);
		$res = $this->db->get();
		if($res->num_rows() > 0)
			return true;
		else
			return false;
	}
}