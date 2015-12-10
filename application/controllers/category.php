<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH."core/my_controller.php");

class Category extends MY_Controller{
    const CATEGORIES = 'admin/categories';
    const CATE_ADD = 'admin/cate_add';
    const CATE_UPDATE = 'admin/cate_update';
    const CATE_SORT = 'admin/cate_sort';

    function __construct() {
        $this->need_login = false;
        parent::__construct();
        $this->load->helper('subintercept');
        $this->load->library('session');
        $this->load->model('category_model');
        $this->load->model('api_model');
    }

    function show_cate_add($cid = 0, $info = '', $info_type = ''){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        if($cid == null){
            $cid = $this->input->get('cid', 0);
        }
        $this->load->model('api_model');
        //获取导航栏分级
        // $nav_menu = $this->category_model->get_parents_by_id($cid);
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
        $data['name'] = $this->category_model->get_name_by_id($cid);
        $data['cid'] = $cid;

        $this->load->view(self::HEAD);
        $this->load->view(self::NAVBAR);

        $this->load->view(self::SIDEBAR, $side_data);

        $this->load->view(self::CATE_ADD, $data);
    }
    function show_cate_update($cid = 0, $id = 0, $info='',$info_type = ''){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        if($cid == null){
            $cid = $this->input->get('cid', 0);
        }
        if($id == null){
            $id = $this->input->get('id', 0);
        }

        //获取导航栏分级
        // $nav_menu = $this->category_model->get_parents_by_id($cid);
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
        $data['name'] = $this->category_model->get_name_by_id($cid);
        $data['cid'] = $cid;
        $data['cate_row'] = $this->category_model->get_category_object($id);

        $this->load->view(self::HEAD);
        $this->load->view(self::NAVBAR);

        $this->load->view(self::SIDEBAR,$side_data);

        $this->load->view(self::CATE_UPDATE, $data);

    }
    function show_cate_sort($cid =0, $info='', $info_type = ''){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        if($cid == null){
            $cid = $this->input->get('cid', 0);
        }
        $this->load->model('api_model');
        //获取导航栏分级
        // $nav_menu = $this->category_model->get_parents_by_id($cid);
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
        $data['info'] = $info;
        $data['info_type'] = $info_type;
        $data['children'] = $this->category_model->get_categories_by_pid($cid);

        $this->load->view(self::HEAD);
        $this->load->view(self::NAVBAR);
        $this->load->view(self::SIDEBAR, $side_data);
        $this->load->view(self::CATE_SORT, $data);
    }

    function cate_add(){
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
        // 表单验证，验证规则见 application/config/form_validation.php
        if ($this->form_validation->run('cate_add') == FALSE)
        {
            $this->show_cate_add($cid, validation_errors(), 'danger');
            return;
        }
        $entry = array();
        $entry['name'] = $this->input->post('name');
        $entry['description'] = $this->input->post('description');
        $entry['parent_id'] = $this->input->post('parent_id');

        //获取目录等级
        $entry['level'] = $this->category_model->get_level_by_id($cid) + 1;
        $insert_id =$this->category_model->insert_entry($entry);
        if ($insert_id !=false){
            redirect(site_url("c=api&m=show_api_es&cid=".$cid));
            return;
        }else{
            $this->show_cate_add($cid, '添加失败', 'danger');
            return;
        }
    }
    function cate_update(){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        $cid = $this->input->get('cid', 0);
        $id = $this->input->get('id', 0);

        // 表单验证，验证规则见 application/config/form_validation.php

        $entry = array();
        $entry['name'] = $this->input->post('name');
        $entry['description'] = $this->input->post('description');
        $parent_id = $this->input->post('parent_id');
        $entry['parent_id'] = $parent_id;
        $entry['level'] = $this->category_model->get_level_by_id($parent_id) + 1;
        $update_id = $this->category_model->update_entry($entry, $id);
        if ($update_id !=false){
            $this->show_cate_sort($cid, "更新成功！", 'success');
            return;
        }else{
            $this->show_cate_update($cid, '更新失败', 'danger');
            return;
        }
    }
    function cate_sort(){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        $cid = $this->input->get('cid', 0);

        $categories = $this->input->post('cate');
        $update_id = $this->category_model->update_ranks($categories);
        if ($update_id != true){
            $this->show_cate_sort($cid, '排序失败', $info_type = 'danger');
            return;
        }else{
            redirect(site_url("c=api&m=show_api_es&cid=".$cid));            
            return;
        }
    }
    function cate_delete(){
        if (!$this->session_valid()){
            $info = "您没有权限访问该页面,请登录";
            $info_type = 'danger';
            $this->show_login($info, $info_type);
            return;
        }
        $cid = $this->input->get('cid', 0);
        $id = $this->input->get('id', 0);
        if ($id == 0){
            $this->show_main('删除失败', 'danger');
            return;
        }
        if (!$this->category_model->check_category_id($id)){
            $this->show_main('非法访问','danger');
            return;
        }
        else{
            $update_id = $this->category_model->update_state_by_id($id, 0);
            if($update_id == false){
                $this->show_main('删除失败', 'danger');
                return;
            }else{
                redirect(site_url('c=api&m=show_api_es&cid='.$cid));
                return;
            }
        }
    }
}