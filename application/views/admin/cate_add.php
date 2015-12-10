<div class="content">
    <div class="header">
      <h1 class="page-title">新增分类</h1>
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo base_url(); ?>">主页</a>
        </li>
        <li>
          <a href="<?php echo site_url('c=coupon&m=show_coupons'); ?>">所在目录</a>
        </li>
        <li class="active">新增分类</li>
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
          <h4>添加分类</h4>
          <div>
              <form action="index.php?c=category&m=cate_add&cid=<?php echo $cid;?>" method="post">
                  <div class="form-group">
                      <input type="text" class="form-control" name="name" placeholder="分类名" required="required">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" name="description" placeholder="描述" required="required">
                  </div>
                  <div class="form-group">
                      <p>父目录：
                      </p>
                      <select name="parent_id" id="parent_id" class="form-control" required="required" disabled="">
                          <option value="<?php echo $cid?>" selected=""><?php echo $name?></option>
                          <input type="hidden" value="<?php echo $cid?>" name="parent_id">
                      </select>
                  </div>
                  <button class="btn btn-success">Submit</button>
              </form>
          </div>
      </div>
    <!--添加接口 end-->
  </div>



</div>

