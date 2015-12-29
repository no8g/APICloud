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
  <div class="main-content col-lg-10" style="padding-top:30px">
      <div class="panel panel-default">
        <a href="#page-stats" class="panel-heading" data-toggle="collapse">更新内容</a>
        <div id="page-stats" class="panel-collapse panel-body collapse in ">
          <div class="row">
            <table class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>内容</th>
              </tr>
              </thead>
              <tbody>
              <?php
                if(isset($contents) && $contents !== null){
                  foreach($contents as $i) {
              ?>
                    <tr>
                      <td><?=$i?></td>
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
        <?php
            if(isset($contents) && $contents !== null){
        ?>
              <div style="float:right;margin-right:20px;">
                <a href="index.php?c=admin&m=update_db">
                  <button class="btn btn-success">确认更新</button>
                </a>
              </div>
        <?php
            }
        ?>



  </div>
</body>
