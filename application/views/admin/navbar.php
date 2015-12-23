<body class="theme-blue">

  <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
            color: #fff;
        }
    </style>
  <script type="text/javascript">
        $(function() {
            var uls = $('.sidebar-nav > ul > *').clone();
            uls.addClass('visible-xs');
            $('#main-menu').append(uls.clone());
        });
    </script>

  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.php">
        <span class="navbar-brand">
<!--            <span class="glyphicon glyphicon-random" aria-hidden="true" style="width:30px;">-->
<!--            </span>-->
            API-Cloud
        </span>
      </a>
    </div>

      <?php
        if ($this->session->userdata('name') == null){
      ?>
        <div class="btn-group" style="float: right; margin-top: 8px">
        <button type="button" class="btn btn-default" onclick = "redirect('index.php?c=user_login&m=show_login')">Login</button></div>
       <?php
        }else {
            ?>
            <div class="btn-group" style="float: right; margin-top: 8px">
                <button type="button" id= "configButton" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <?php echo $this->session->userdata('name'); ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <?php
                    if (isset($customs)) {
                        foreach ($customs as $i) {
                            ?>
                            <li id="list_<?=$i->id?>" name = "<?=$i->custom_name?>" title= "<?=$i->url_name?>" onclick = "changePrefix(<?=$i->id?>)"><a><?=$i->custom_name?></a></li>
            <?php
                        }
                    }
            ?>
                    <li><a href="<?= site_url('c=custom&m=show_customs') ?>">Alter</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= site_url('c=user_login&m=logout') ?>">LogOut</a></li>
                </ul>
            </div>
            <?php
        }
      ?>
  </div>
</div>
  <script type="text/javascript">
      function redirect(url){
          window.location.href=url;
      }
      function changePrefix(id){
          var liId = "list_"+id;
          var prefix = document.getElementById(liId).title;
          var button_name = document.getElementById(liId).getAttribute('name');
          document.getElementById("prefix").value = prefix;
          document.getElementById("configButton").innerHTML = button_name + ' <span class="caret"></span>';
      }
  </script>

</body>