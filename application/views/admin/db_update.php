<!doctype html>
<html lang="en">
<head>
  <base href = "<?php echo base_url(); ?>"/>
  <meta charset="utf-8">
  <title>API接口管理工具</title>
  <link rel="icon" type="image/x-icon" href="../../../favicon.ico">
  <link href="../../../lib/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../lib/font-awesome/css/font-awesome.css">
  <script src="../../../lib/jquery-1.11.1.min.js" type="text/javascript"></script>
  <script src="../../../lib/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../../../stylesheets/theme.css">
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

</head>
<body>
  <div class="db-box">
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane active in" id="home">
            <form action="index.php?c=admin&m=connect_db" method="post" id="db_form" class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-3 control-label">主机名:</label>
                <div class="col-sm-4"><input name="host_name" type="text" class="form-control" value="<?=$hostname?>"></div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">数据库:</label>
                <div class="col-sm-4"><input name="db_name" type="text" placeholder="" class="form-control" value="<?=$db_name?>"></div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">用户名:</label>
                <div class="col-sm-4"><input name="db_user" type="text" placeholder="" class="form-control" value="<?=$db_user?>"></div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">密码:</label>
                <div class="col-sm-4"><input name="password" type="password" placeholder="" class="form-control" value=""></div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-6 col-sm-4 ">
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    连接
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
  </div>
</body>
