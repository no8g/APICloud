<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH."core/my_controller.php");

class Api extends MY_Controller{
    const API_ES = 'admin/api_es';
    const API_ADD = 'admin/api_add';
    const API_UPDATE = 'admin/api_update';
    const API_SORT = 'admin/api_sort';

    function __construct() {
//        $this->need_login = false;  //先设置为false
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('subintercept');
        $this->load->model('api_model');
        $this->load->model('category_model');
    }

    /**
     * 显示接口添加页面
     *
     * @param int $cid
     * @param string $info
     * @param string $info_type
     */
    function show_api_add($cid = 0, $info = '', $info_type = ''){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }

        if($cid == 0){
            $cid = $this->input->get('cid', (int)0);
        }
        if($cid == 0){
            redirect(site_url('c=user_login&m=show_main'));
            return;
        }
        if (!$this->category_model->check_category_id($cid)){
            $this->show_main('非法访问','danger');
            return;
        }
        //获取导航栏分级
        $nav_menu = $this->category_model->get_parents_by_id($cid);
        $data['nav_menu'] = $nav_menu;
        //获取该分类下是否有其他分类，sidebar用
        $child_menu = $this->category_model->get_categories_by_pid($cid);
        //获取该分类下的api基础信息，sidebar用
        $api_names = $this->api_model->get_api_names_by_cid($cid);

        $side_data['child_menu'] = $child_menu;
        $side_data['api_names'] = $api_names;
        $side_data['cid'] = $cid;

        $category_name = $this->category_model->get_name_by_id($cid);
        if($info != '' && ($info_type == 'success' || $info_type == 'danger')) {
            $data['info'] = $info;
            $data['info_type'] = $info_type;
        }
        $data['cid'] = $cid;
        $data['category_name'] = $category_name;
        $this->load->view(self::HEAD);

        $this->load->model('custom_model');
        $admin_id = $this->session->userdata('id');
        $nav_data['customs']  = $this->custom_model->get_customs($admin_id);
        $this->load->view(self::NAVBAR, $nav_data);

        $this->load->view(self::SIDEBAR, $side_data);

        $this->load->view(self::API_ADD, $data);
    }

    /**
     * 显示接口列表页面
     * @param int $cid
     * @param string $info
     * @param string $info_type
     */
    function show_api_es($cid = 0, $info = '', $info_type = ''){
        if ($cid == 0){
            $cid = $this->input->get('cid', 0);
        }
        if ($cid == 0){
            redirect(site_url('c=user_login&m=show_main'));
            return;
        }else{
            if (!$this->category_model->check_category_id($cid)){
                $this->show_main('非法访问','danger');
                return;
            }
            if($info != '' && ($info_type == 'success' || $info_type == 'danger')) {
                $data['info'] = $info;
                $data['info_type'] = $info_type;
            }
            //获取导航栏分级
            $nav_menu = $this->category_model->get_parents_by_id($cid);
            $data['nav_menu'] = $nav_menu;
            //获取该分类下是否有其他分类，sidebar用
            $child_menu = $this->category_model->get_categories_by_pid($cid);
            //获取该分类下的api基础信息，sidebar用
            $api_names = $this->api_model->get_api_names_by_cid($cid);

            $side_data['child_menu'] = $child_menu;
            $side_data['api_names'] = $api_names;
            $side_data['cid'] = $cid;

            $this->load->view(self::HEAD);
            $this->load->view(self::NAVBAR);
            $this->load->view(self::SIDEBAR,$side_data);


            $data['api_es'] = $this->api_model->get_api_es($cid);

            $this->load->view(self::API_ES, $data);
    	}
	}

    /**
     * 显示接口排序页面
     * @param int $cid
     * @param string $info
     * @param string $info_type
     */
    function show_api_sort($cid =0, $info='', $info_type = ''){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        if($cid == null){
            $cid = $this->input->get('cid', 0);
        }
        if (!$this->category_model->check_category_id($cid) || $cid == 0){
            $this->show_main('非法访问','danger');
            return;
        }
        $this->load->model('category_model');
        //获取导航栏分级
        $nav_menu = $this->category_model->get_parents_by_id($cid);
        $data['nav_menu'] = $nav_menu;
        //获取该分类下是否有其他分类，sidebar用
        $child_menu = $this->category_model->get_categories_by_pid($cid);
        //获取该分类下的api基础信息，sidebar用
        $api_names = $this->api_model->get_api_names_by_cid($cid);

        $side_data['child_menu'] = $child_menu;
        $side_data['api_names'] = $api_names;
        $side_data['cid'] = $cid;


        $this->load->view(self::HEAD);
        $this->load->view(self::NAVBAR);
        $this->load->view(self::SIDEBAR,$side_data);

        $data['info'] = $info;
        $data['info_type'] = $info_type;
        $data['api_es'] = $this->api_model->get_api_es($cid);
        $data['cid'] = $cid;

        $this->load->view(self::API_SORT, $data);

    }

    /**
     * 显示接口更新页面
     * @param int $cid
     * @param int $aid
     * @param string $info
     * @param string $info_type
     */
    function show_api_update($cid = 0, $aid = 0, $info='',$info_type = ''){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        if($cid == null){
            $cid = $this->input->get('cid', 0);
        }
        if($aid == null){
            $aid = $this->input->get('aid', 0);
        }
        if ($aid ==0){
            $this->show_api_es($cid);
            return;
        }
        if (!($this->category_model->check_category_id($cid) && $this->api_model->check_api_id($aid))){
            $this->show_main('非法访问','danger');
            return;
        }
        else{
            //获取导航栏分级
            $nav_menu = $this->category_model->get_parents_by_id($cid);
            $data['nav_menu'] = $nav_menu;
            //获取该分类下是否有其他分类，sidebar用
            $child_menu = $this->category_model->get_categories_by_pid($cid);
            //获取该分类下的api基础信息，sidebar用
            $api_names = $this->api_model->get_api_names_by_cid($cid);

            $side_data['child_menu'] = $child_menu;
            $side_data['api_names'] = $api_names;

            $side_data['cid'] = $cid;
            if($info != '' && ($info_type == 'success' || $info_type == 'danger')) {
                $data['info'] = $info;
                $data['info_type'] = $info_type;
            }
            $data['api'] = $this->api_model->get_api_detail($aid);
            $category_name = $this->category_model->get_name_by_id($cid);
            $data['cid'] = $cid;
            $data['aid'] = $aid;
            $data['category_name'] = $category_name;

            $this->load->view(self::HEAD);

            $this->load->model('custom_model');
            $admin_id = $this->session->userdata('id');
            $nav_data['customs']  = $this->custom_model->get_customs($admin_id);
            $this->load->view(self::NAVBAR, $nav_data);

            $this->load->view(self::SIDEBAR,$side_data);

            $this->load->view(self::API_UPDATE, $data);
        }
    }

    /**
     *
     */
    function api_add(){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        $cid = $this->input->get('cid', 0);
        if (!$this->category_model->check_category_id($cid)){
            $this->show_main('非法访问','danger');
            return;
        }
        $entry = array();
        $entry['name'] = $this->input->post('name');
        $entry['url_name'] = $this->input->post('url_name');
        $entry['category_id'] = $cid;
        $entry['description'] = $this->input->post('description');
        $entry['type'] = $this->input->post('type');
        $entry['res'] = $this->input->post('res');
        $entry['parameter'] = serialize($this->input->post('p'));
        $entry['remark'] = $this->input->post('remark');


        $entry['last_user_id'] = $this->session->userdata('id');
        $entry['update_time'] = date("Y-m-d H:i:s");
        $entry['user_name'] = $this->session->userdata('name');

        $number = $this->input->post('number');
        if ($number == ''){
            $number = hash('crc32', $entry['name'].$entry['url_name'].$entry['update_time']);
        }
        $entry['number'] = $number;
        $check['number'] = $number;
        $check['state'] =1;
        if ($this->api_model->check_array($check)){
            $this->show_api_add('接口编号重复', 'danger');
            return;
        }

        $res = $this->api_model->insert_entry($entry);
        if($res != false) {
            $this->show_api_es($cid, "添加成功！", 'success');
            return;
        } else {
            $this->show_api_add($cid, "添加失败！", 'danger');
            return;
        }
    }
    function api_update(){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        $cid = $this->input->get('cid', 0);
        $aid = $this->input->post('aid', 0);
        if ($aid ==0){
            $this->show_api_es($cid, '非法访问', 'danger');
            return;
        }
        if (!($this->category_model->check_category_id($cid) && $this->api_model->check_api_id($aid))){
            $this->show_main('非法访问','danger');
            return;
        }
        $entry = array();
        $entry['name'] = $this->input->post('name');
        $entry['url_name'] = $this->input->post('url_name');
        $entry['category_id'] = $this->input->post('parent_id');
        $entry['description'] = $this->input->post('description');
        $entry['type'] = $this->input->post('type');
        $entry['res'] = $this->input->post('res');
        $entry['parameter'] = serialize($this->input->post('p'));
        $entry['remark'] = $this->input->post('remark');
        $entry['update_time'] = date("Y-m-d H:i:s");
        $number = $this->input->post('number');
        if ($number == ''){
            $number = hash('crc32', $entry['name'].$entry['url_name'].$entry['update_time']);
        }
        $entry['number'] = $number;
        $check['number'] = $number;
        $check['state'] =1;
        $check['id !='] = $aid;
        if ($this->api_model->check_array($check)){
            $this->show_api_update($cid, $aid, '接口编号重复', 'danger');
            return;
        }
        $res = $this->api_model->update_entry($entry, $aid);
        if($res != false) {
            $this->show_api_es($cid, "修改成功！", 'success');
            return;
        } else {
            $this->show_api_es($cid, "修改失败！", 'danger');
            return;
        }
    }
    function api_delete(){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        $cid = $this->input->get('cid', 0);
        $aid = $this->input->get('aid', 0);
        if (!($this->category_model->check_category_id($cid) && $this->api_model->check_api_id($aid))){
            $this->show_main('非法访问','danger');
            return;
        }
        if ($aid ==0){
            $this->show_api_es($cid, '非法访问', 'danger');
            return;
        }
        $res = $this->api_model->update_state_by_id($aid);
        if($res != false) {
            $this->show_api_es($cid, "删除成功！", 'success');
            return;
        } else {
            $this->show_api_es($cid, "删除失败！", 'danger');
            return;
        }
    }
    function api_sort(){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        $cid = $this->input->get('cid', 0);
        if (!$this->category_model->check_category_id($cid)){
            $this->show_main('非法访问','danger');
            return;
        }
        $api_es = $this->input->post('api');
        $update_id = $this->api_model->update_ranks($api_es);
        if ($update_id != true){
            $this->show_api_sort($cid, '排序失败', 'danger');
            return;
        }else{
            $this->show_api_es($cid, '排序成功','success');
            return;
        }
    }
}