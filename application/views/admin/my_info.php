
<div class="content">
    <div class="header">

      <h1 class="page-title">我的设置</h1>
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo base_url(); ?>">主页</a>
        </li>
        <li class="active">个人设置</li>
      </ul>

    </div>
    <div class="main-content">

      <div class="row">
        <div class="col-md-6">
          <br>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane active in" id="home">
              <form id="tab" class="form-horizontal">
                  <?php if(isset($info)) {  ?>
                    <div class="alert alert-<?php echo $info_type; ?>">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                         <?php echo $info; ?>
                    </div>
                    <?php } ?>

                <div class="form-group">
                  <label for="start_time" class="col-sm-3 control-label">用户名:</label>
                  <div class="col-sm-8">
                      <p class="form-control-static"><?php echo $my->username; ?></p>
                  </div>
                </div>

                <div class="form-group">
                  <label for="start_time" class="col-sm-3 control-label">类型:</label>
                  <div class="col-sm-8">
                      <p class="form-control-static">
                        <?php 
                          if($my->type == 1)
                            echo '系统管理员';
                          else if($my->type == 2)
                            echo '小区管理员';
                          else if($my->type == 3)
                            echo '商家';
                          else if($my->type == 4)
                            echo '公司管理员';
                          else if($my->type == 5)
                            echo '运营管理员';
                         ?>
                      </p>
                  </div>
                </div>
                
                <?php if($my->type == 2 || $my->type == 4) {  ?>
                <div class="form-group">
                  <label class="col-sm-3 control-label">所在小区:</label>
                  <div class="col-sm-8">
                    <p class="form-control-static"><?php echo $this->session->userdata('com_name'); ?></p>
                  </div>
                </div>
                <?php } ?>

                <?php if($my->type == 4) {  ?>
                <div class="form-group">
                  <label class="col-sm-3 control-label">所在公司:</label>
                  <div class="col-sm-8">
                    <p class="form-control-static"><?php echo $this->session->userdata('company_id'); ?></p>
                  </div>
                </div>
                <?php } ?>
                
              </form>
            </br></br>
                <div class="form-group"> 
                    <a href="<?php echo site_url('c=admin&m=show_my_info_update'); ?>" class="btn btn-primary" style="margin-left:40px;" role="button">
                      <i class="fa fa-save"></i>
                      修改密码
                    </a>
                </div>
            </div>
          </div>

        </div>
      </div>