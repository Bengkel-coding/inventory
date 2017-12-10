
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
      <li class="active">Tambah</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-plus"></i> Tambah Eksternal Link</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-9">
                <form action="#" method="post" class="panel-body p-y-1">
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Title :</label>
                      <div class="col-sm-9">
                        <input type="text" name="judul" class="form-control" value="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Eksternal Link :</label>
                      <div class="col-sm-9">
                        <input type="text" name="judul" class="form-control" value="">
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">
                        <button type="submit" class="btn btn-primary btn-3d">Save</button>
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


  <?php //include "inc_footer.php";?>
  <?php include "inc_script.php";?></script>
</body>
</html>
