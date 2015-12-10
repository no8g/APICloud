<div class="content">
    <div class="header">
      <h1 class="page-title">新增个人设置</h1>
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo base_url(); ?>">主页</a>
        </li>
        <li class="active">新增设置</li>
      </ul>
    </div>
  <div class="main-content">
      <?php if(isset($info)) {  ?>
          <div class="alert alert-<?php echo $info_type; ?>">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <?php echo $info; ?>
          </div>
      <?php } ?>

      <div style="background:#f5f5f5;padding:20px;position:relative">
          <h4>添加设置</h4>
          <div>
              <form action="index.php?c=custom&m=custom_add" method="post">
                  <div class="form-group">
                      <input type="text" class="form-control" name="custom_name" placeholder="设置名" required="required">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" name="url_name" placeholder="域名" required="required">
                  </div>
                  <button class="btn btn-success">Submit</button>
              </form>
          </div>
      </div>
    <!--添加接口 end-->
  </div>



</div>

