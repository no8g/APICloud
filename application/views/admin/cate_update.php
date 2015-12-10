<div class="content">
    <div class="header">
      <h1 class="page-title">更新分类</h1>
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo base_url(); ?>">主页</a>
        </li>

        <li class="active">更新分类</li>
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
          <h4>更新分类</h4>
          <div>
              <form action="index.php?c=category&m=cate_update&cid=<?=$cid?>&id=<?=$cate_row->id?>" method="post">
                  <div class="form-group">
                      <input type="text" class="form-control" name="name" value ="<?=$cate_row->name?>" required="required">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" name="description" value ="<?=$cate_row->description?>" required="required">
                  </div>
                  <div class="form-group">
                      <p>父目录：
                      </p>
                      <select name="parent_id" id="parent_id" class="form-control" required="required" disabled="">
                          <option value="<?php echo $cid?>" selected=""><?php echo $name?></option>
                          <input type="hidden" value="<?php echo $cid?>" name="parent_id">
                      </select>

                  </div>
                  <button class="btn btn-success" name="op" value="add">Submit</button>
              </form>
          </div>
      </div>
  </div>
</div>

