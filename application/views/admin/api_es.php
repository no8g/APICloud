<link href="./lib/bootstrap-3.3.4-dist/style.css" rel="stylesheet">
<div class="content">
    <div class="header">
        <h1 class="page-title">接口列表</h1>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>">主页</a>
            </li>
            <li>
                <a href="<?php echo site_url('c=coupon&m=show_coupons'); ?>">所在目录</a>
            </li>
            <li class="active">接口列表</li>
        </ul>
    </div>
    <div class="main-content">
        <?php if(isset($info)) {  ?>
            <div class="alert alert-<?php echo $info_type; ?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?php echo $info; ?>
            </div>
        <?php } ?>
        <?php
            if($api_es != null){
                foreach($api_es as $i){
        ?>
        <div class="info_api" style="border:1px solid #ddd;margin-bottom:20px;" id="info_api_<?php echo $i['number'];?>">
            <div style="background:#f5f5f5;padding:20px;position:relative">
                <div class="textshadow" style="position: absolute;right:0;top:4px;right:8px;">
                    最后修改者: <?php echo $i['user_name']?> &nbsp;<?php echo $i['update_time']?>&nbsp;
                    <button class="btn btn-danger btn-xs " onclick="editApi('<?php echo site_url('c=api&m=api_delete').'&cid='.$cid.'&aid='.$i['id']; ?>')">delete</button>&nbsp;
                    <button class="btn btn-info btn-xs " onclick="editApi('<?php echo site_url('c=api&m=show_api_update').'&cid='.$cid.'&aid='.$i['id']; ?>')">edit</button>
                </div>
                <h4 class="textshadow"><?php echo $i['name'];?></h4>
                <p>
                    <b>编号&nbsp;&nbsp;:&nbsp;&nbsp;<span style="color:red"><?php echo $i['number'];?></span></b>
                </p>
                <div>
                    <kbd style="color:red"><?php echo $form_type=($i['type'] == 1)?'POST':'GET';?></kbd> - <kbd><?php echo $i['url_name'];?></kbd>
                </div>
            </div>
            <div class="info">
                <?php echo $i['description'];?>
            </div>
            <div style="background:#ffffff;padding:20px;">
                <h5 class="textshadow">请求参数</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="col-md-3">参数名</th>
                        <th class="col-md-1">必传</th>
                        <th class="col-md-2">缺省值</th>
                        <th class="col-md-3">描述</th>
                        <th class="col-md-4">校验规则</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i['parameter'] = unserialize($i['parameter']);
                    $count = count($i['parameter']['name']);
                    ?>
                    <?php for($j=0;$j<$count;$j++){ ?>
                        <tr>
                            <td><?php echo $i['parameter']['name'][$j]?></td>
                            <td><?php if($i['parameter']['type'][$j]=='Y'){echo '<span style="color:red">Y<span>';}else{echo '<span style="color:green">N<span>';}?></td>
                            <td><?php echo $i['parameter']['default'][$j]?></td>
                            <td><?php echo $i['parameter']['des'][$j]?></td>
                            <td><?php echo (isset($i['parameter']['rules'][$j]))?$i['parameter']['rules'][$j]:'';?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div style="background:#ffffff;padding:20px;">
                <h5 class="textshadow">返回值</h5>
                <pre><?php echo $i['res']?></pre>
            </div>
            <div style="background:#ffffff;padding:20px;">
                <h5 class="textshadow">备注</h5>
                <pre style="background:honeydew"><?php echo $i['remark']?></pre>
            </div>
        </div>
        <?php
                }
            }
        ?>
    </div>
</div>
<script>
    function editApi(url){
        window.location.href=url;
    }
</script>