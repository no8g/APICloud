<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $need_login = false;


	// components of page
	const HEAD = 'admin/head';
	const NAVBAR = 'admin/navbar';
	const SIDEBAR = 'admin/sidebar';
	const FOOTER = 'admin/footer';

	// main & login/logout
	const LOGIN = 'admin/login';
	const MAIN = 'admin/main';
	const P_DENY = 'admin/permission_deny';


	function __construct() {
		parent::__construct();
		$this->load->library('session');
		date_default_timezone_set('PRC');
//		if($this->need_login){
//			$this->show_main();
//		}
	}

	public function index()
	{
		$this->show_main();
	}

	function session_valid() {
		if (! $this->session->userdata('logged_in')) { 
			return false;
		} else 
			return true;
	}
	public function show_main($info = '', $info_type = ''){
		$this->load->view(self::HEAD);
		$this->load->view(self::NAVBAR);
		$side_data['cid'] = 0;
		$this->load->model('category_model');
		$side_data['child_menu'] = $this->category_model->get_categories_by_pid(0);
		$side_data['api_names'] = null;
		$this->load->view(self::SIDEBAR, $side_data);
		$data = array();
		if ($info != null || $info_type !=null){
			$data['info'] = $info;
			$data['info_type'] = $info_type;
		}
		$this->load->model('api_model');
		$data['new_api_es'] = $this->api_model->get_latest_update_api_es();
		$this->load->view(self::MAIN, $data);
	}


	public function show_login($info = '', $info_type = '')
	{
		if ($this->session->userdata('logged_in')){
			$url = site_url('c=user_login&m=show_main');
			redirect($url);
		}else{
			$this->load->view(self::HEAD);
			$this->load->view(self::NAVBAR);
			$side_data['cid'] = 0;
			$this->load->model('category_model');
			$side_data['child_menu'] = $this->category_model->get_categories_by_pid(0);
			$side_data['api_names'] = null;
			$this->load->view(self::SIDEBAR, $side_data);
			$data = array();
			if($info != '' && $info_type != '')
			{
				$data['info'] = $info;
				$data['info_type'] = $info_type;
			}
			$this->load->view(self::LOGIN, $data);
		}

	}
	public function show_permission_deny($info='', $info_type='')
	{
		$this->load->view(self::HEAD);
		$this->load->view(self::NAVBAR);
		$data = array();
		$this->load->view(self::SIDEBAR,array('collapse_name' => 'dashboard'));
		if($info != '' && ($info_type == 'success' || $info_type == 'danger')) {
			$data['info'] = $info;
			$data['info_type'] = $info_type;
		}
		$this->load->view(self::P_DENY, $data);
		$this->load->view(self::FOOTER);
	}






}

