<?php

class Custom_Model extends CI_Model{
    /**
     * 表名
     * @var string
     */
    const TABLE_NAME = 'custom';

    /**
     * 表字段
     */
    const ID = 'id';
    const USER_ID = 'user_id';
    const NAME = 'custom_name';
    const URL = 'url_name';
    const STATE = 'state';
    const UPDATE_TIME = 'update_time';
    const RANK = 'rank';

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
    function get_custom_names($user_id){
        if ($user_id == 0){
            return false;
        }
        $this->db->select('id, custom_name');
        $this->db->where(self::USER_ID, $user_id);
        $this->db->where(self::STATE, 1);
        $this->db->order_by(self::RANK, 'DESC');
        $res = $this->db->get();
        if($res->num_rows() >=1 )
            return $res->result_array();
        else
            return false;
    }
    function get_customs($user_id){
        if ($user_id == 0){
            return false;
        }
        $this->db->where(self::USER_ID, $user_id);
        $this->db->where(self::STATE, 1);
        $this->db->from(self::TABLE_NAME);
        $res = $this->db->get();
        if($res->num_rows() >=1 )
            return $res->result();
        else
            return false;
    }
    function get_custom_row($id){
        if ($id == 0){
            return false;
        }
        $this->db->where(self::ID, $id);
        $this->db->where(self::STATE, 1);
        $this->db->from(self::TABLE_NAME);
        $res = $this->db->get();
        if($res->num_rows() >=1 )
            return $res->row();
        else
            return false;
    }
    function check_custom_id($id, $user_id){
        $this->db->where(self::ID, $id);
        $this->db->where(self::USER_ID, $user_id);
        $this->db->where(self::STATE, 1);
        $this->db->from(self::TABLE_NAME);
        $res = $this->db->get();
        if($res->num_rows() == 1 )
            return true;
        else
            return false;
    }

}
