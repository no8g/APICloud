<div class="content">
    <div class="header">

      <ul class="breadcrumb">
        <li>
          <a href="index.php">主页</a>
        </li>
<!--        <li class="active">控制台</li>-->
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
        <a href="#page-stats" class="panel-heading" data-toggle="collapse">最近一周修改</a>
        <div id="page-stats" class="panel-collapse panel-body collapse in">
          <div class="row">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>接口名</th>
                    <th>路由名</th>
                    <th>所属类别</th>
                    <th>最后修改人</th>
                    <th>修改时间</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if ($new_api_es != null){
                    foreach($new_api_es as $i) {
                  ?>
                    <tr>
                      <td><a href="index.php?c=api&m=show_api_es&cid=<?=$i->category_id?>#info_api_<?=$i->number?>"><?php echo $i->name;?></td>
                      <td><?php echo $i->url_name;?></td>
                      <td><?php echo $i->category_name;?></td>
                      <td><?php echo $i->user_name;?></td>
                      <td><?php echo $i->update_time;?></td>

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


      <div class="row">
        <div class="col-sm-6 col-md-6">
          <div class="panel panel-default" style="height:250px;">
            <a href="#widget2container" class="panel-heading" data-toggle="collapse">帮助</a>
            <div id="widget2container" class="panel-body collapse in">
              <p>
                欢迎使用接口管理工具 v1.1版
              </p>
              <p>
                如果您在使用中遇到了问题，或发现的BUG，请及时联系。
              </p>
              <p>
                联系邮箱：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;zhangrq5@126.com
              </p>
              <p>
                <a class="btn btn-primary" href="https://github.com/zhangrq5/apiTool">更多信息 »</a>
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-6">
          <div class="panel panel-default" style="height:250px;">
            <a href="#widget1container" class="panel-heading" data-toggle="collapse">系统介绍</a>
            <div id="widget1container" class="panel-body collapse in">


              <p>
                什么是接口文档管理工具?
              </p>
              <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;是一个在线API文档系统；其致力于快速解决团队内部接口文档的编写、维护、存档，和减少团队协作开发的沟通成本。
              </p>
            </div>
          </div>
        </div>
      </div>