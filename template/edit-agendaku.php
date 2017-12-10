
  <!--Head Include-->
  <?php include "inc_head.php";?>
  <?php include "inc_styles.php";?>

<link rel="stylesheet" type="text/css" href="assets/clockpicker/dist/bootstrap-clockpicker.min.css">

</head>
<body class="pace-done px-navbar-fixed">
  <!--Sidebar Include-->
  <?php include "inc_sidebar.php";?>
  
  <!--Navbar Include-->
  <?php include "inc_navbar.php";?>

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li>Agendaku</li>
      <li class="active">Edit</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-file-text-o"></i> Edit / Detail Agendaku</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-5">
                <form action="#" method="post" class="panel-body p-y-1">
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">&nbsp;</label>
                      <div class="col-sm-8">                        
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
                      <label class="col-sm-4 control-label">Nama Pejabat:</label>
                      <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" value="Y. Krityanto" readonly="readonly">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Tanggal :</label>
                      <div class="col-sm-8">        
                        <div class="input-group">
                          <input type="text" class="form-control tanggal" name="date" id="datepicker">
                          <span class="input-group-btn">
                            <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Jam Mulai :</label>
                      <div class="col-sm-8">
                        <div class="input-group clockpicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                            <input type="text" class="form-control jam-mulai" value="13:14">
                            <span class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Jam Selesai :</label>
                      <div class="col-sm-8">
                        <div class="input-group clockpicker pull-center" data-placement="bottom" data-align="top" data-autoclose="true">
                            <input type="text" class="form-control jam-selesai" value="13:15">
                            <span class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Color Label :</label>
                      <div class="col-sm-8">
                        <input type="text" id="minicolors-hue" class="form-control color-label" value="#316498">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Acara :</label>
                      <div class="col-sm-8">
                        <textarea class="form-control acara"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Tempat :</label>
                      <div class="col-sm-8">
                        <textarea class="form-control tempat"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Keterangan :</label>
                      <div class="col-sm-8">
                        <textarea class="form-control keterangan"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">
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
<script type="text/javascript" src="assets/clockpicker/dist/bootstrap-clockpicker.min.js"></script>
<script type="text/javascript">  
    $(function() {

      $('.tanggal').attr('disabled',true);
      $('.jam-mulai').attr('disabled',true);
      $('.jam-selesai').attr('disabled',true);
      $('.color-label').attr('disabled',true);
      $('.acara').attr('disabled',true);
      $('.tempat').attr('disabled',true);
      $('.keterangan').attr('disabled',true);
      $('#tombol').attr('disabled',true);


      $('.editData').change(function(){
          if($('.editData:checked').length){
            $('.tanggal').attr('disabled',false);
            $('.jam-mulai').attr('disabled',false);
            $('.jam-selesai').attr('disabled',false);
            $('.color-label').attr('disabled',false);
            $('.acara').attr('disabled',false);
            $('.tempat').attr('disabled',false);
            $('.keterangan').attr('disabled',false);
            $('#tombol').attr('disabled',false);

          }else{
            $('.tanggal').attr('disabled',true);
            $('.jam-mulai').attr('disabled',true);
            $('.jam-selesai').attr('disabled',true);
            $('.color-label').attr('disabled',true);
            $('.acara').attr('disabled',true);
            $('.tempat').attr('disabled',true);
            $('.keterangan').attr('disabled',true);
            $('#tombol').attr('disabled',true);

          }
      });
      $('.clockpicker').clockpicker()
      .find('input').change(function(){
        console.log(this.value);
      });
      $('#minicolors-hue').minicolors({
        control:  'hue',
        position: 'bottom left',
      });
      $('#datepicker').datepicker();
    });
</script>
</body>
</html>
