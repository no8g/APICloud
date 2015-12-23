<div class="content">
    <div class="header">
      <h1 class="page-title">新增接口</h1>
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo base_url(); ?>">主页</a>
        </li>
        <?php
        for ($i = count($nav_menu)-1;$i>=0;$i--){
        ?>
        <li>
          <a href="index.php?c=api&m=show_api_es&cid=<?=$nav_menu[$i]['id']?>"><?=$nav_menu[$i]['name']?></a>
        </li>
        <?php  
        }
        ?>
        <li class="active">新增接口</li>
      </ul>
    </div>
        <link rel="stylesheet" href="lib/jquery.fancybox.css">
    <script src="lib/jquery.fancybox.js"></script>
    <script>
        function getParams(){
            var dr_url = document.getElementById("url_name").value;
            var prefix = document.getElementById("prefix").value;
            $.ajax({
                url : "index.php?c=test&m=get_params&uri="+dr_url+"&prefix="+prefix,
                "contentType": "application/x-www-form-urlencoded; charset=utf-8",
                data: {

                },
                type: 'get',
                dataType: 'json',
                success: function(d){
                    $('#num').html("");
                    var $html = "";
                    if (d != null ){
                        $('#parameter').html("");
                        for (i=0;i< d.length;i++){
                            var $y ="";
                            var $n ="";
                            if (d[i].is_require == 'Y'){
                                $y = "selected";
                            }else {
                                $n = "selected";
                            }
                            $html = $html +
                                '<tr>' +
                                '<td class="form-group has-error" >' +
                                '<input type="text" class="form-control has-error" name="p[name][]" placeholder="参数名" required="required" value="'+d[i].name+'"></td>'+
                                '<td>' +
                                '<select class="form-control" name="p[type][]">' +
                                '<option value="Y" '+$y+'>Y</option> <option value="N" '+$n+'>N</option>' +
                                '</select >' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" class="form-control" name="p[default][]" placeholder="缺省值"></td>' +
                                '<td>' +
                                '<input type="text" class="form-control" name="p[des][]" rows="1" class="form-control" placeholder="描述">' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" class="form-control" name="p[rules][]" rows="1" class="form-control" placeholder="检验规则" value= "'+ d[i].rules +'">' +
                                '</td>' +
                                '<td>' +
                                '<button type="button" class="btn btn-danger" onclick="del(this)">删除</button>' +
                                '</td>' +
                                '</tr >';
                        }
                        $('#parameter').append($html);
                    }
                }
            });
        }
        function getNum(){
            var api_num = document.getElementById("num").value;
            $.ajax({
                url : "index.php?c=test&m=get_num",
                "contentType": "text/html; charset=utf-8",
                data: {
                    num: api_num
                },
                type: 'get',
                dataType: 'text',
                success: function (d){
                    if(d != null){
                        $('#api_number input').val(d);
                    }
                }
            });
        }
        function add(){
            var $html ='<tr>' +
                '<td class="form-group has-error" ><input type="text" class="form-control has-error" name="p[name][]" id="p[name][]" placeholder="参数名" required="required"></td>'+
                '<td>' +
                '<select class="form-control" name="p[type][]">' +
                '<option value="Y">Y</option> <option value="N">N</option>' +
                '</select >' +
                '</td>' +
                '<td>' +
                '<input type="text" class="form-control" name="p[default][]" placeholder="缺省值"></td>' +
                '<td>' +
                '<textarea name="p[des][]" rows="1" class="form-control" placeholder="描述"></textarea>' +
                '</td>' +
                '<td>' +
                '<textarea name="p[rules][]" rows="1" class="form-control" placeholder="检验规则"></textarea>' +
                '</td>' +
                '<td>' +
                '<button type="button" class="btn btn-danger" onclick="del(this)">删除</button>' +
                '</td>' +
                '</tr >';
            $('#parameter').append($html);
        }
        function del(obj){
            // $(obj).parents('tr').remove();
            var p_data = $("input").serialize();
            console.log(p_data);
        }
        function test(){
            var count = $("#param_table").find("tr").length;
            var dr_url = document.getElementById("url_name").value;
            var prefix = document.getElementById("prefix").value;
            var $html = '<form class="form-horizontal" role="form" id="test_form" method="post" onsubmit="return false"> \
                        <div class="form-group"> \
                            <label class="col-sm-2 control-label">URL</label> \
                            <div class="col-sm-9"> \
                            <input type="text" class="form-control" id="test_api_url" required="required" value="'+prefix+dr_url+'">  \
                            </div> \
                        </div> \
                    ';
            for (var i=1;i<count;i++){
                var p_name = $("#param_table").find("tr").eq(i).find("td").eq(0).find("input").eq(0).val();
                var isNeed = $('select[name="p[type][]"]').eq(i-1).val();
                var req = "";
                if (isNeed == "Y"){
                    req = ' required="required" ';
                }
                $html += '<div class="form-group"> \
                            <label class="col-sm-2 control-label">' + p_name+'</label> \
                            <div class="col-sm-9"> \
                            <input type="text" class="form-control" id="'+p_name+'" '+req+'>  \
                            </div> \
                        </div> \
                        ';

            }
            $html +='   <div class="form-group"> \
                            <div class="col-sm-offset-2 col-sm-9"> \
                                <button type="submit" class="btn btn-success" onclick="postman()">登录</button> \
                            </div> \
                        </div> \
                    </form>';             
                          
            $('#inline2').html($html);
        }
        function test_1(){
            var dr_url = document.getElementById("url_name").value;
            var prefix = document.getElementById("prefix").value;
            var $a = '<form class="form-horizontal" role="form" id="test_form" method="post" onsubmit="return false"> \
                            <input type="hidden" id="prefix" value="'+prefix+'"> \
                            <input type="hidden" id="url_name" value="'+dr_url+'"> \
                            <div class="form-group"> \
                              <label class="col-sm-2 control-label">token</label> \
                              <div class="col-sm-8"> \
                                 <input type="text" class="form-control" id="firstname">  \
                              </div> \
                            </div> \
                            <div class="form-group"> \
                              <label class="col-sm-2 control-label">姓</label> \
                              <div class="col-sm-8"> \
                                 <input type="text" class="form-control" id="lastname">  \
                              </div> \
                            </div>';
                 $a +='   <div class="form-group"> \
                                <div class="col-sm-offset-2 col-sm-10"> \
                                    <button type="submit" class="btn btn-default">登录</button> \
                                </div> \
                            </div> \
                        </form>'; 
            $('#inline2').html($a);                               
        }
        function postman(){
            $('#test_form').submit(function(){
                var str_data=$("#test_form input").map(function(){
                    return ($(this).attr("id")+'='+$(this).val());
                }).get().join("&") ;
                $.ajax({
                    url: "index.php?c=test&m=get_test_result",
                    "contentType": "application/x-www-form-urlencoded; charset=utf-8",
                    data:str_data,
                    type: 'POST',
                    dataType: 'text',
                    success: function(d){
                        if (d != null){
                            $('#test_res').html(d);
                            parent.$.fancybox.close();                            
                        }
                    },                    
                });
            });
        }
    </script>
    <script type="text/javascript">
    $(function(){
        $("#modal").fancybox({
            'minWidth': 500,
            'modal':false,           
            'overlayShow':true,
            'hideOnOverlayClick':false,
            'hideOnContentClick':false,
            'enableEscapeButton':false,
            'showCloseButton':false,
            'centerOnScroll':true,
            // 'autoScale':true
        });
    });
    </script>
  <div class="main-content">
      <?php if(isset($info)) {  ?>
          <div class="alert alert-<?php echo $info_type; ?>">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <?php echo $info; ?>
          </div>
      <?php } ?>
    <div style="border:1px solid #ddd">
      <div style="background:#f5f5f5;padding:20px;position:relative">
        <h4><span style="font-size:12px;padding-left:20px;color:#a94442">注:"此色"边框为必填项</span></h4>
        <div style="margin-left:20px;">
          <form action ="<?php echo site_url('c=api&m=api_add').'&cid='.$cid?>" method="post">
            <h5>基本信息</h5>
            <div class="form-group has-error">
              <div class="input-group" id="api_number">
                <div class="input-group-addon">
                  接口编号
                </div>
                <input type="text" class="form-control" name="number" id="num" placeholder="接口编号" required="required"  onblur="getNum()">
              </div>
            </div>
            <div class="form-group has-error">
              <div class="input-group">
                <div class="input-group-addon">接口名称</div>
                <input type="text" class="form-control" name="name" placeholder="接口名称" required="required">
              </div>
            </div>
            <div class="form-group has-error">
              <div class="input-group">
                <div class="input-group-addon" onclick="tabUrl()">请求地址</div>
                <input type="text" class="form-control" name="url_name"  id = "url_name" placeholder="请求地址" required="required">
              </div>
            </div>
            <div class="form-group has-error" >
              <div class="input-group" >
                <div class="input-group-addon" >所在目录</div>
                <select class="form-control"  name="cid" required="required" disabled>
                    <option value="<?php echo $cid;?>" selected><?php echo $category_name;?></option>'
                    <input type="hidden" value="<?php echo $cid;?>" name="parent_id">
                </select>
              </div>
            </div>
            <div class="form-group">
              <textarea name="description" class="form-control" placeholder="描述"></textarea>
            </div>
            <div class="form-group">
              <select class="form-control" name="type" required = "required">
                <option value="1">POST</option>
                <option value="2">GET</option>
              </select>
            </div>
            <div class="form-group">
              <h5><button type="button" class="btn btn-success" onclick="getParams()">获取参数</button></h5>
              <div class="form-group has-error" >
                <div class="input-group">
                  <div class="input-group-addon" onclick="getParams()">参数获取地址前缀</div>
                  <input type="text" class="form-control" name="prefix"  id = "prefix" value="<?php
                    if ($this->session->userdata('custom_id') == 0){
                        echo "http://test.api.popdr.gi4t.com";
                    }else{
                        $this->load->model('custom_model');
                        $row = $this->custom_model->get_custom_row($this->session->userdata('custom_id'));
                        echo $row->url_name;
                    }
                    ?>">
                </div>
              </div>
              <table class="table" id="param_table" >
                <thead>
                <tr>
                  <th class="col-md-2">参数名</th>
                  <th class="col-md-1">必传</th>
                  <th class="col-md-1">缺省值</th>
                  <th class="col-md-3">描述</th>
                  <th class="col-md-4">校验规则</th>
                  <th class="col-md-1">
                    <button type="button" class="btn btn-success" onclick="add()">新增</button>
                  </th>
                </tr>
                </thead>
                <tbody id="parameter">
                </tbody>
              </table>
            </div>
            <div class="form-group">
              <h5>测试结果</h5>
              <p><a id="modal" href="#inline2" onclick="test()">点击这里</a>加载一个模式窗口</p>
              <textarea name="res" id="test_res" rows="3" class="form-control" placeholder="返回结果" ></textarea>
            </div>
            <div class="form-group">
              <h5>备注</h5>
              <textarea name="remark" rows="3" class="form-control" placeholder="备注"></textarea>
            </div>
            <button class="btn btn-success">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <div style="display:none">
        <div id="inline2">
        </div>
    </div>

 
  </div>




</div>

