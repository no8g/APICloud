<?php
	
 /**
 * API Model
 * A class provided some methods to CURD data in talbe community
 * Created on 2015/11/28
 * @author zhangrq5 
 * @version 1.0
 */

class Api_Model extends CI_Model {

	/**
 	 * 表名
 	 * @var string
 	 */
 	const TABLE_NAME = 'api';

 	/**
 	 * 表字段名称
 	 */
 	const ID = 'id';
 	const NAME = 'name';
 	const NUMBER = 'number';
 	const URL = 'url';
 	const CATEGORY_ID = 'category_id';
 	const DESCRIPTION = 'description';
 	const REMARK = 'remark';
 	const TYPE = 'type';
	const STATE = 'state';
	const PARAMETER = 'parameter';
	const UPDATE_TIME = 'update_time';
	const RANK = 'rank';
	const RES = 'res';
	const LAST_USER_ID = 'last_user_id';
	const USER_NAME = 'user_name';

 	function __construct()
 	{
 		parent::__construct();
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
	function get_api_es($category_id){
		if ($category_id == 0){
			return false;
		}
		$this->db->where(self::CATEGORY_ID, $category_id);
		$this->db->where(self::STATE, 1);
		$this->db->from(self::TABLE_NAME);
		$this->db->order_by(self::RANK, 'DESC');
		$res = $this->db->get();
		if($res->num_rows() > 0){
			return $res->result_array();
		}else{
			return false;
		}
	}

	function get_api_names_by_cid($category_id){
		if ($category_id == 0){
			return false;
		}
		$this->db->select('id, number, name');
		$this->db->where(self::CATEGORY_ID, $category_id);
		$this->db->where(self::STATE, 1);
		$this->db->from(self::TABLE_NAME);
		$this->db->order_by(self::RANK, 'DESC');
		$res = $this->db->get();
		if($res->num_rows() >=1){
			return $res->result();
		}else{
			return false;
		}
	}
	function get_api_detail($aid){
		if($aid == 0){
			return false;
		}else{
			$this->db->where(self::ID, $aid);
			$this->db->where(self::STATE, 1);
			$this->db->from(self::TABLE_NAME);
			$res = $this->db->get();
			if($res->num_rows() > 0)
				return $res->row();
			else
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
	function update_ranks($api_es){
		$rank = count($api_es);
		$this->db->trans_start();
		foreach ($api_es as $i) {
			$update_id = $this->update_rank_by_id($i, $rank);
			$rank--;
		}
		$this->db->trans_commit();
		return true;
	}

	function get_latest_update_api_es(){

/*		$sql = "select a.id as aid, a.number, a.name, a.url_name, a.category_id as category_id, c.name as category_name, a.last_user_id, a.user_name, a.update_time from api a join category c on a.category_id = c.id
				where a.update_time > '".date('Y-m-d H:m:s', strtotime('-7day'))."' and a.state = 1 order by update_time DESC";
		$query = $this->db->query($sql);
		if ($query == null){
			return false;
		}else{
			return $query->result();
		}*/
		$this->db->select('api.id as aid, api.number, api.name, api.url_name, api.category_id as category_id, category.name as category_name,
		api.last_user_id, api.user_name, api.update_time ');
		$this->db->from(self::TABLE_NAME);
		$this->db->join('category', 'category.id = api.category_id');
		$this->db->where('api.update_time >',date('Y-m-d H:m:s', strtotime('-7day')));
		$this->db->where('api.state',1);
		$this->db->order_by('api.update_time', 'DESC');
		$res = $this->db->get();
		if ($res == null){
			return false;
		}else{
			return $res->result();
		}

	}
	function check_api_id($id){
		$this->db->where(self::ID, $id);
		$this->db->where(self::STATE, 1);
		$this->db->from(self::TABLE_NAME);
		$res = $this->db->get();
		if($res->num_rows() > 0)
			return true;
		else
			return false;
	}

	function check_array($arr){
		$this->db->where($arr);
		$this->db->from(self::TABLE_NAME);
		$res = $this->db->get();
		if($res->num_rows() > 0)
			return true;
		else
			return false;
	}
}