<?php
	/**
	 * 表单验证配置文件
	 *
	 * @author fanz 2015-04-02
	 */
	$config = array(

		'cate_add' => array(
			array(
				'field' => 'name',
				'label' => '分类名',
				'rules' => 'required'
				),
			array(
				'field' => 'description',
				'label' => '描述',
				'rules' => 'required'
				),
			array(
				'field' => 'parent_id',
				'label' => '父目录id',
				'rules' => 'required|is_natural'
				),
			),
		'cate_update' => array(
			array(
				'field' => 'name',
				'label' => '分类名',
				'rules' => 'required'
			),
			array(
				'field' => 'description',
				'label' => '描述',
				'rules' => 'required'
			),
			array(
				'field' => 'level',
				'label' => '目录级别',
				'rules' => 'required|is_natural|less_than[3]|greater_than[1]'
			),
			array(
				'field' => 'parent_id',
				'label' => '父目录id',
				'rules' => 'required|is_natural'
			),
		),

		'api_add' =>array(
			array(
				'field' => 'number',
				'label' => '接口编号',
				'rules' => 'required'
			),
			array(
				'field' => 'name',
				'label' => '接口名称',
				'rules' => 'required'
			),
			array(
				'field' => 'url',
				'label' => '请求地址',
				'rules' => 'required'
			),
			array(
				'field' => 'cid',
				'label' => '所在目录id',
				'rules' => 'required|is_natural'
			),
			array(
				'field' => 'description',
				'label' => '描述',
				'rules' => 'required'
			),
			array(
				'field' => 'type',
				'label' => '请求方式',
				'rules' => 'required|is_natural'
			),
			array(
				'field' => 'parameter',
				'label' => '参数',
				'rules' => 'required'
			),
			array(
				'field' => 'res',
				'label' => '返回结果',
				'rules' => 'required'
			),
			array(
				'field' => 'remark',
				'label' => '备注',
				'rules' => 'required'
			),

		),
		'api_update' =>array(
			array(
				'field' => 'number',
				'label' => '接口编号',
				'rules' => 'required'
			),
			array(
				'field' => 'name',
				'label' => '接口名称',
				'rules' => 'required'
			),
			array(
				'field' => 'url',
				'label' => '请求地址',
				'rules' => 'required'
			),
			array(
				'field' => 'cid',
				'label' => '所在目录id',
				'rules' => 'required|is_natural'
			),
			array(
				'field' => 'description',
				'label' => '描述',
				'rules' => 'required'
			),
			array(
				'field' => 'type',
				'label' => '请求方式',
				'rules' => 'required|is_natural'
			),
			array(
				'field' => 'parameter',
				'label' => '参数',
				'rules' => 'required'
			),
			array(
				'field' => 'res',
				'label' => '返回结果',
				'rules' => 'required'
			),
			array(
				'field' => 'remark',
				'label' => '备注',
				'rules' => 'required'
			),

		),
		'login' => array(
			array(
				'field' => 'name',
				'label' => '登录名',
				'rules' => 'required'
			),
			array(
				'field' => 'password',
				'label' => '密码',
				'rules' => 'required'
			),
		),

		'default' => array()
		);

?>