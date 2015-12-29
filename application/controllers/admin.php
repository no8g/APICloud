<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH."core/my_controller.php");

class Admin extends MY_Controller {

	const DB_UPDATE = 'admin/db_update';
	const UPDATE_CONTENTS = 'admin/update_contents';
	const HEAD = 'admin/head';
	const FOOTER = 'admin/footer';

	protected $db_resource;
	protected $contents;

	function __construct() {
//		$this->need_login = true;
		parent::__construct();
	}

	public function show_db_connect(){
		if (!$this->session_valid()){
			$info = "您没有权限访问该页面，请登录";
			$info_type = 'danger';
			$this->show_login($info, $info_type);
			return;
		}
		if(isset($_SESSION['is_super'])){
			if ($_SESSION['is_super'] === 0){
				$info = "非法访问";
				$info_type = 'danger';
				$this->show_main($info, $info_type);
				return;
			}
		}
		$data['hostname'] = $this->db->hostname;
		$data['db_user'] = $this->db->username;
		$data['db_name'] = $this->db->database;
		$this->load->view(self::DB_UPDATE, $data);

	}

	public function connect_db(){
		if (!$this->session_valid()){
			$info = "您没有权限访问该页面，请登录";
			$info_type = 'danger';
			$this->show_login($info, $info_type);
			return;
		}
		if(isset($user_session['is_super'])){
			if ($user_session['is_super'] === 0){
				$info = "非法访问";
				$info_type = 'danger';
				$this->show_main($info, $info_type);
				return;
			}
		}
		$hostname = $this->input->post('host_name');
		$db_name = $this->input->post('db_name');
		$db_user = $this->input->post('db_user');
		$password = $this->input->post('password');
		$dsn = 'mysql:host='.$hostname.';dbname='.$db_name;
		$this->db_resource = new PDO($dsn, $db_user, $password);
		if ($this->db_resource == false){
			$this->show_db_connect();
			return;
		}else{
			$this->show_update_contents();
			return;
		}

	}

	public function show_update_contents(){
		if (!$this->session_valid()){
			$info = "您没有权限访问该页面，请登录";
			$info_type = 'danger';
			$this->show_login($info, $info_type);
			return;
		}
		if(isset($_SESSION['is_super'])){
			if ($_SESSION['is_super'] === 0){
				$info = "非法访问";
				$info_type = 'danger';
				$this->show_main($info, $info_type);
				return;
			}
		}
		$this->contents = array(
			'ALTER TABLE `user` ADD COLUMN `is_super`  tinyint(3) NULL DEFAULT 1 AFTER `custom_id`',
		);
		$data['contents'] = $contents;
		$this->load->view(self::UPDATE_CONTENTS, $data);
	}

	public function update_db(){
		if (!$this->session_valid()){
			$info = "您没有权限访问该页面，请登录";
			$info_type = 'danger';
			$this->show_login($info, $info_type);
			return;
		}
		if(isset($_SESSION['is_super'])){
			if ($_SESSION['is_super'] === 0){
				$info = "非法访问";
				$info_type = 'danger';
				$this->show_main($info, $info_type);
				return;
			}
		}
		$this->myforge = $this->load->dbforge($this->db_resource, TRUE);
		$fields = array(
			'is_super' => array(
				'type' => 'tinyint(3)',
				'default' => '1',
				'after' => 'custom_id',
			),
		);
		$tag = $this->dbforge->add_column('user', $fields);
		if (!$tag){
			$this->show_main('更新数据库失败','danger');
		}else{
			$this->contents = null;
			$this->show_main('更新数据库成功', 'success');
			return;
		}
	}
}

?>