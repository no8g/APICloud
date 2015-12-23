<div class="content">
    <div class="header">

      <ul class="breadcrumb">
        <li>
          <a href="index.php">主页</a>
        </li>
      </ul>

    </div>
    <div class="main-content">
      <?php if(isset($info)) {  ?>
        <div class="alert alert-<?php echo $info_type; ?>">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <?php echo $info; ?>
        </div>
      <?php } ?>
      <div class="panel panel-default">
        <a href="#page-stats" class="panel-heading" data-toggle="collapse">个人设置</a>
        <div id="page-stats" class="panel-collapse panel-body collapse in">
          <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>编号</th>
                    <th>设置名</th>
                    <th>域名</th>
                    <th>是否为常用</th>
                    <th>操作</th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if ($customs != null){
                    foreach($customs as $i) {
                  ?>
                    <tr>
                      <td><?php echo $i->id;?></td>
                      <td><?php echo $i->custom_name;?></td>
                      <td><?php echo $i->url_name;?></td>
                      <td>
                        <?php
                        if ($this->session->userdata('custom_id')===$i->id){
                          echo "√";
                        }else{
                        ?>
                          <a href="<?=site_url('c=custom&m=set_common_custom&custom_id='.$i->id)?>">置为常用</a>
                          <?php
                        }
                        ?>
                      </td>
                      <td>
                      <a href = "index.php?c=custom&m=show_custom_update&custom_id=<?php echo $i->id?>">更新</a>
                      <a href = "index.php?c=custom&m=custom_delete&custom_id=<?php echo $i->id?>">删除</a>
                      </td>
                    </tr>
                  <?php
                    }
                  }
                  ?>
                  </tbody>
                </table>
          </div>
        </div>
      </div>
      <div class = "form-group">
        <form action="<?php echo site_url('c=custom&m=show_custom_add');?>" method="get">
          <div style="float:right;margin-right:20px;">
            <button class="btn btn-success">新建设置</button>
            <input type="hidden" value="custom" name="c">
            <input type="hidden" value="show_custom_add" name="m">
          </div>
        </form>
      </div>
    </div>
</div>  


