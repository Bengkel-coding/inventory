
  <!--Head Include-->
  <?php include "inc_head.php";?>
  <?php include "inc_styles.php";?>

</head>
<body class="pace-done px-navbar-fixed">
  <!--Sidebar Include-->
  <?php include "inc_sidebar.php";?>
  
  <!--Navbar Include-->
  <?php include "inc_navbar.php";?>

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li>Eksternal Link</li>
      <li class="active">Edit</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-file-text-o"></i> Edit / Detail Eksternal Link</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-9">

                <form action="#" method="post" class="panel-body p-y-1">

                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">&nbsp;</label>
                      <div class="col-sm-9">                        
                        <label for="switcher-rounded" class="switcher switcher-rounded">Edit Data
                          <input type="checkbox" id="switcher-rounded" class="editData">
                          <div class="switcher-indicator">
                            <div class="switcher-yes">YES</div>
                            <div class="switcher-no">NO</div>
                          </div>
                        </label>               
                      </div>    
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Title :</label>
                      <div class="col-sm-9">
                        <input type="text" name="title" class="form-control title" value="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Eksternal Link :</label>
                      <div class="col-sm-9">
                        <input type="text" name="link" class="form-control link" value="">
                      </div>
                    </div>
                  </div>                  
                  
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">
                        <button type="submit" class="btn btn-primary btn-3d" id="tombol">Save</button>
                      </label>
                      <div class="col-sm-8">                  
                          &nbsp;
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
    </div>

  <?php include "inc_script.php";?>
<script type="text/javascript">  
    $(function() {


      $('.title').attr('disabled',true);
      $('.link').attr('disabled',true);
      $('#tombol').attr('disabled',true);

      $('.editData').change(function(){
          if($('.editData:checked').length){

            $('.title').attr('disabled',false);
            $('.link').attr('disabled',false);
            $('#tombol').attr('disabled',false);

          }else{
            $('.title').attr('disabled',true);
            $('.link').attr('disabled',true);
            $('#tombol').attr('disabled',true);

          }
      });
    });
</script>
</body>
</html>
