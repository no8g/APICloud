<div class="sidebar-nav" style="position:fixed;height:100%;">
  <div id="sidebar" style="position:relative;background:#f5f5f5;padding:10px;height:100%;border-right:#ddd 1px solid;overflow-y:auto;">
    <div class="form-group">
      <input type="text" class="form-control" id="search_api" placeholder="search here" onkeyup="">
    </div>
    <div class = "form-group">
      <form action="<?php echo site_url('c=category&m=show_cate_add');?>" method="get">
        <div style="float:right;margin-right:20px;">
          <button class="btn btn-success">新建分类</button>
          <input type="hidden" value="category" name="c">
          <input type="hidden" value="show_cate_add" name="m">
          <input type="hidden" value="<?php echo $cid?>" name="cid">
        </div>
      </form>
      <?php
        if ($cid !=0) {
          ?>
          <form action="<?php echo site_url('c=api&m=show_api_add'); ?>" method="get">
            <div style="float:right;margin-right:20px;">
              <input type="hidden" value="api" name="c">
              <input type="hidden" value="show_api_add" name="m">
              <input type="hidden" value="<?php echo $cid ?>" name="cid">
              <button class="btn btn-success">新建接口</button>
            </div>
          </form>
          <?php
        }
      ?>
      <form action="<?php echo site_url('c=category&m=show_cate_sort');?>" method="get">
        <div style="float:right;margin-right:20px;">
          <input type="hidden" value="category" name="c">
          <input type="hidden" value="show_cate_sort" name="m">
          <input type="hidden" value="<?php echo $cid?>" name="cid">
          <button class="btn btn-success">目录排序</button>
        </div>
      </form>
    </div>
    <br>
    <br>
    <div class="list">
      <?php if ($child_menu == null && $api_names == null){
          echo '<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>此分类下暂无分类与接口！';
      }
      ?>
      <ul class="list-unstyled" style="padding:8px">
        <?php
        if ($child_menu != null) {
          foreach ($child_menu as $i) {
            ?>
            <li class="menu" id="info_<?php echo $i->id ?>">
              <a href="index.php?c=api&m=show_api_es&cid=<?php echo $i->id ?>"><?php echo $i->name ?></a>
              <br>
              &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $i->description ?><input type="hidden" name="aid" value="2"> <br>

              <div style="float:right;margin-right:16px;">
                &nbsp;
                <button class="btn btn-danger btn-xs" onclick="redirect('index.php?c=category&m=cate_delete&cid=<?=$cid?>&id=<?=$i->id?>')">delete</button>
                &nbsp;
                <button class="btn btn-info btn-xs" onclick="redirect('index.php?c=category&m=show_cate_update&cid=<?=$cid?>&id=<?=$i->id?>')">edit</button>
              </div>
              <br>
              <hr>
            </li>
            <?php
          }
        }
        ?>
      </ul>
    </div>
    <div class="list">
      <ul class="list-unstyled" style="padding:1px">
        <?php if ($api_names != null) { ?>
          <?php foreach ($api_names as $i) {
            ?>
            <li class="menu" id="api_<?php echo $i->number; ?>" style="padding:8px">
              <a href="index.php?c=api&m=show_api_es&cid=<?php echo $cid;?>#info_api_<?=$i->number?>">
                <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
                <?php echo $i->name; ?></a>
            </li>
            <?php
          }
        }
        ?>
      </ul>
    </div>
    <div class = "form-group">
      <form action="<?php echo site_url('c=api&m=show_api_sort');?>" method="get">
        <div style="float:right;margin-right:20px;">
          <button class="btn btn-success">接口排序</button>
          <input type="hidden" value="api" name="c">
          <input type="hidden" value="show_api_sort" name="m">
          <input type="hidden" value="<?php echo $cid?>" name="cid">
        </div>
      </form>
    </div>

  </div>

</div>


<script type="text/javascript">
   function redirect(url){
     window.location.href=url;
   }
</script>