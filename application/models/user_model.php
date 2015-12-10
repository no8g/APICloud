<?php
	
 /**
 * USER Model
 * A class provided some methods to CURD data in talbe community
 * Created on 2015/11/28
 * @author zhangrq5 
 * @version 1.0
 */

class User_Model extends CI_Model {

	/**
 	 * 表名
 	 * @var string
 	 */
 	const TABLE_NAME = 'user';

 	/**
 	 * 表字段名称
 	 */
 	const ID = 'id';
 	const NAME = 'name';
	const PASSWORD = 'password';
	const STATE = 'state';
	const LAST_LOGIN = 'last_login';
	const CUSTOM_ID = 'custom_id';


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
	function update_custom_id($custom_id, $id){
		if ($id == 0){
			return false;
		}
		$this->db->where(self::ID, $id);
		$this->db->update(self::TABLE_NAME, array(self::CUSTOM_ID => $custom_id));
		if($this->db->affected_rows() > 0) {
			log_message('debug', $this->db->last_query().'; id: '.$this->db->insert_id().'; affected_rows: '.$this->db->affected_rows());
			return $this->db->affected_rows();
		}
		else {
			log_message('debug', $this->db->last_query());
			return false;
		}
	}
	function check_login($name, $password){
		$this->db->where(self::NAME, $name);
		$this->db->where(self::PASSWORD, $password);
		$this->db->where(self::STATE, 1);
		$this->db->from(self::TABLE_NAME);
		$res = $this->db->get();
		if($res->num_rows()>0) {
			return $res->row();
		}else{
			return false;
		}
	}



}