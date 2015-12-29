<div class="content">
    <div class="header">
      <h1 class="page-title">接口排序</h1>
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
        <li class="active">接口排序</li>
      </ul>
    </div>
  <div class="main-content">
          <?php if(isset($info)) {  ?>
      <div class="alert alert-<?php echo $info_type; ?>">
          <button type="button" class="close" data-dismiss="alert">×</button>
           <?php echo $info; ?>
      </div>
      <?php } ?>
      <div style="border:1px solid #ddd;margin-bottom:20px;">
          <div style="background:#ffffff;padding:20px;">
              <h5 class="textshadow">接口列表</h5>
              <form action="index.php?c=api&m=api_sort&cid=<?php echo $cid;?>" method="post">
                  <table class="table">
                      <thead>
                      <tr>
                          <th class="col-md-2">接口编号</th>
                          <th class="col-md-4">接口名</th>
                          <th class="col-md-4">更新时间</th>
                          <th class="col-md-2">操作</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php if($api_es != null){
                          foreach ($api_es as $i) {
                        ?>    
                            <tr>
                                <td><input name="api[]" type="hidden" value="<?php echo $i['id']?>"><?php echo $i['number']?></td>
                                <td><?php echo $i['name']?></td>
                                <td><?php echo $i['update_time']?></td>
                                <td>
                                    <span onclick="up(this)" style="color:red;cursor: pointer" class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
                                    &nbsp;
                                    <span onclick="down(this)" style="color:green;cursor: pointer" class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
                                </td>
                            </tr>                                                        
                        
                        <?php
                          }
                        }
                        ?>
                      </tbody>
                  </table>
                  <button class="btn btn-success">Submit</button>
              </form>
          </div>
      </div>
  </div>

    <script>
        //上移
        function up(obj){
            var $TR = $(obj).parents('tr');
            var prevTR = $TR.prev();
            prevTR.insertAfter($TR);
            $('tr.info').removeClass('info');
            $TR.addClass('info');
            $TR.hide();
            $TR.show(300);
        }
        //下移
        function down(obj){
            var $TR = $(obj).parents('tr');
            var nextTR = $TR.next();
            nextTR.insertBefore($TR);
            $('tr.info').removeClass('info');
            $TR.addClass('info');
            $TR.hide();
            $TR.show(300);
        }
    </script>

</div>

