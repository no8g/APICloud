
<div class="content">
    <div class="header">

      <h1 class="page-title">修改密码</h1>
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo base_url(); ?>">主页</a>
        </li>
        <li class="active">修改密码</li>
      </ul>

    </div>
    <div class="main-content">

      <div class="row">
        <div class="col-md-6">
          <br>
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane active in" id="home">
              <form action="<?php echo site_url('c=admin&m=my_psd_update')?>" method="post" id="tab" class="form-horizontal">
                <?php if(isset($info)) {  ?>
                <div class="alert alert-<?php echo $info_type; ?>">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                     <?php echo $info; ?>
                </div>
                <?php } ?>
                <input type="hidden" id="aid" name="aid" value="<?php echo $this->session->userdata('adminid'); ?>" />
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">原密码:</label>
                  <div class="col-sm-8"><input name="old_password" type="password" placeholder="" class="form-control" value=""></div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label">输入新密码:</label>
                  <div class="col-sm-8"><input name="new_password" type="password" placeholder="" class="form-control" value=""></div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">再次输入新密码:</label>
                  <div class="col-sm-8"><input name="new_password1" type="password" placeholder="" class="form-control" value=""></div>
                </div>

       
                </br>
                <div class="form-group">
                  <div class="col-sm-offset-1 col-sm-8 ">
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-save"></i>
                      保存
                    </button>
                  </div>
                </div>
              </form>
            </br></br>
            </div>
          </div>
        </div>
      </div>

<script type="text/javascript">
$(document).ready(function(){
  var id = 0;
  $(".delete").click(function(){
    id = $(this).attr("value");
    $("#deleteDisc").modal('show');
  });
  $("#deleteConfirm").click(function(){
    $.get("<?php echo site_url('c=door&m=door_delete'); ?>",{did:id},
      function(data,status){
        if(status == 'success') {
          $("tr#"+id).hide();         
          alert(data);
          window.location.href="<?php echo site_url('c=door&m=show_doors'); ?>"; 
        }
        else {
          alert("服务器无回应，请刷新后重试，若多次刷新仍无回应，请联系网站管理员！");         
        }
      });
  });
});
</script>