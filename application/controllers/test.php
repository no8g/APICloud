<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH."core/my_controller.php");


class Test extends MY_Controller{


    function __construct() {
        parent::__construct();
    }
    function get_num(){
        $number = null;
        if (!empty($_REQUEST['num'])){
            $number = $_REQUEST['num'];
        }
        $data =  $this->getNumber($number);
        echo $data;
    }
    function getNumber($number = null){
        if ($number == null){
            return "";
        }
        return hash('crc32', $number);
    }
    function get_params(){
        if (!empty($_REQUEST['uri'])){
            $uri = $_REQUEST['uri'];
        }else{
            $uri = '';
        }
        if (!empty($_REQUEST['prefix'])){
            $prefix = $_REQUEST['prefix'];
        }else{
            $prefix = 'http://test.api.popdr.gi4t.com';
        }
        if ($uri == null){
            echo json_encode(['']);
            die();
        }
        $match_rules = [
            'array' => '数组类型',
            'date' => '日期类型',
            'boolean' => '布尔类型',
            'email' => '邮件类型',
            'integer' => '整型类型',
            'string' => '字符串类型',
            'numeric' => '整数类型',
            'required' => '',
        ];
        $dr_url = $prefix."/debug/rule?uri=".$uri;
        $result = file_get_contents($dr_url, false);

        $info = json_decode($result, true);
        $param_array = [];
        if ($info['data'] !== null){
            foreach ($info['data'] as $i) {
                $param = [];
                $param['is_require'] = 'N';
                $param['rules'] = " ";
                $i = str_replace("'", "", $i);
                $kv_arr = explode('=>', $i);
                $param['name'] = $kv_arr[0];
                if ($param['name'] === 'telephone'){
                    $param['rules'] .= '电话号码格式';
                }else{
                    if (isset($kv_arr[1])){
                        $rule_arr = explode('|', $kv_arr[1]);
                    }else{
                        $rule_arr = array();
                    }
                    foreach ($rule_arr as $j){
                        // echo $j."<br>";
                        if ($j === 'required'){
                            $param['is_require'] = 'Y';
                        }
                        foreach ($match_rules as $key => $value) {
                            if ($j === $key){
                                $param['rules'] .=$value." ";
                            }
                        }
                    }
                    array_push($param_array, $param);
                }
            }
        }
        echo json_encode($param_array, true);
    }
    function get_test_result(){
        $post_data = $this->input->post();
        $url = $this->input->post('test_api_url');
        $request_type = $this->input->post('request_type');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        if ($request_type === 'POST'){
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $result = curl_exec($ch);
        curl_close($ch);
    }
    function get_post_deliver($str){
        $re = array();
        $param_arr = explode('&', $str);
        foreach($param_arr as $i){
            $temp = explode('=', $i);
            array_push($re, $temp);
        }
        return $re;
    }
    function test_time(){

    }


}