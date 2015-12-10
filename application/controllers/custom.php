<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH."core/my_controller.php");


class Custom extends MY_Controller{
    const CUSTOMS = 'admin/customs';
    const CUSTOM_ADD = 'admin/custom_add';
    const CUSTOM_UPDATE = 'admin/custom_update';

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('subintercept');
        $this->load->model('custom_model');
        $this->load->model('category_model');
        $this->load->model('api_model');

    }
    function show_customs($info='', $info_type=''){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面，请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }else{
            if($info != '' && ($info_type == 'success' || $info_type == 'danger')) {
                $data['info'] = $info;
                $data['info_type'] = $info_type;
            }
            $id = $this->session->userdata('id');
            $data['customs'] = $this->custom_model->get_customs($id);
            $cid = $this->input->get('cid', 0);
            if ($cid == null){
                $cid = (int)0;
            }
            $data['cid'] = $cid;
            $this->load->model('category_model');
            //获取导航栏分级
            // $nav_menu = $this->category_model->get_parents_by_id($cid);
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

            $this->load->view(self::CUSTOMS, $data);
        }
    }
    function show_custom_add($info='', $info_type=''){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面，请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }else{
            $data = array();
            if($info != '' && ($info_type == 'success' || $info_type == 'danger')) {
                $data['info'] = $info;
                $data['info_type'] = $info_type;
            }
            $cid = $this->input->get('cid', 0);
            if ($cid == null){
                $cid = (int)0;
            }
            $this->load->model('category_model');
            //获取导航栏分级
            // $nav_menu = $this->category_model->get_parents_by_id($cid);
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

            $this->load->view(self::CUSTOM_ADD, $data);
        }
    }
    function show_custom_update($custom_id =0, $info='', $info_type=''){
        if ($custom_id == null){
            $custom_id = $this->input->get('custom_id', 0);
        }
        if ($custom_id == 0){
            $this->show_main();
            return;
        }
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面，请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        $user_id = $this->session->userdata('id');
//        $this->load->model('user_model');
        if (!$this->custom_model->check_custom_id($custom_id, $user_id)){
            $this->show_main('非法访问', 'danger');
            return;
        }
        else{
            $data = array();
            if($info != '' && ($info_type == 'success' || $info_type == 'danger')) {
                $data['info'] = $info;
                $data['info_type'] = $info_type;
            }
            $data['custom_row'] = $this->custom_model->get_custom_row($custom_id);


            $cid = $this->input->get('cid', 0);
            if ($cid == null){
                $cid = (int)0;
            }
            $this->load->model('category_model');
            //获取导航栏分级
            // $nav_menu = $this->category_model->get_parents_by_id($cid);
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

            $this->load->view(self::CUSTOM_UPDATE, $data);
        }
    }
    function custom_add(){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面，请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        $entry = array();
        $entry['user_id'] = $this->session->userdata('id');
        $entry['custom_name'] = $this->input->post('custom_name');
        $entry['url_name'] = $this->input->post('url_name');


        $res = $this->custom_model->insert_entry($entry);
        if($res != false) {
            $this->show_customs("添加成功！", 'success');
            return;
        } else {
            $this->show_custom_add("添加失败！", 'danger');
            return;
        }
    }
    function custom_update(){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面，请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        $entry = array();
        $user_id = $this->session->userdata('id');
        $entry['user_id'] = $user_id;
        $custom_id = $this->input->post('custom_id');
        if (!$this->custom_model->check_custom_id($custom_id, $user_id)){
            $this->show_main('非法访问', 'danger');
            return;
        }

        $entry['custom_name'] = $this->input->post('custom_name');
        $entry['url_name'] = $this->input->post('url_name');
        $res = $this->custom_model->update_entry($entry, $custom_id);
        if($res != false) {

            $this->show_customs("修改成功！", 'success');
            return;
        } else {
            $this->show_custom_update($custom_id, "修改失败！", 'danger');
            return;
        }
    }
    function set_common_custom(){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面，请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }

        $custom_id = $this->input->get('custom_id');
        if ($custom_id == 0){
            redirect(site_url('c=user_login&m=show_main'));
        }
        $entry = array();
        $user_id = $this->session->userdata('id');
        $entry['custom_id'] = $custom_id;
        $this->load->model('user_model');
        $res = $this->user_model->update_entry($entry, $user_id);
        if($res != false) {
            $session_data['custom_id'] = $custom_id;
            $this->session->set_userdata($session_data);
            $this->show_customs("修改成功！", 'success');
            return;
        } else {
            $this->show_customs("修改失败！", 'danger');
            return;
        }

    }


}