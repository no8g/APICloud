<div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">登录</p>
        <div class="panel-body">
            <form action="<?php echo site_url('c=user_login&m=login')?>" method="post">
                <div class="form-group">
                    <label>用户名</label>
                    <input name="name" type="text" class="form-control span12"></div>
                <div class="form-group">
                    <label>密码</label>
                    <input name="password" type="password" class="form-controlspan12 form-control"></div>
                
                <?php if(isset($info)) {  ?>
                    <div class="alert alert-<?php echo $info_type; ?>" style="padding-top:10px;padding-bottom:10px;">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                         <?php echo $info; ?>
                    </div>
                <?php } ?>

                <button type="submit" class="btn btn-primary pull-right">
                      <i class="fa fa-save"></i>
                      登陆
                </button>
                
                <label class="remember-me">
                    <input type="checkbox">记住我</label>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>

    <p>
        <a href="reset-password.html">忘记密码?</a>
    </p>
</div>
