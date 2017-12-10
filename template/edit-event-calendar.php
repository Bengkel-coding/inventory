
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
      <li>Event Calendar</li>
      <li class="active">Edit</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-file-text-o"></i> Edit / Detail Event</div>
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
                      <label class="col-sm-3 control-label">Judul Event:</label>
                      <div class="col-sm-9">
                        <input type="text" name="judul" class="form-control judul" value="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Tanggal :</label>
                      <div class="col-sm-9">        
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
                      <label class="col-sm-3 control-label">Tempat :</label>
                      <div class="col-sm-9">
                        <textarea class="form-control tempat"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Keterangan :</label>
                      <div class="col-sm-9">
                        <textarea id="summernote-base" class="keterangan">Summernote Editor</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Status :</label>
                      <div class="col-sm-9">
                        <select class="form-control select2-example" style="width: 100%" data-allow-clear="true">
                          <option></option>
                          <option value="AK" selected="selected">Need Moderation</option>
                        </select>
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

      $('.select2-example').select2({
        placeholder: 'Select value',
      });

      $('#summernote-base').summernote({
        height: 200,
        toolbar: [
          ['parastyle', ['style']],
          ['fontstyle', ['fontname', 'fontsize']],
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['insert', ['picture', 'link', 'video', 'table', 'hr']],
          ['history', ['undo', 'redo']],
          ['misc', ['codeview', 'fullscreen']],
          ['help', ['help']]
        ],
      });

      $('.judul').attr('disabled',true);
      $('.tanggal').attr('disabled',true);
      $('.tempat').attr('disabled',true);
      $('.select2-example').attr('disabled',true);
      $('.note-editable').attr('contenteditable', false);
      $('#tombol').attr('disabled',true);


      $('.editData').change(function(){
          if($('.editData:checked').length){

            $('.judul').attr('disabled',false);
            $('.tanggal').attr('disabled',false);
            $('.tempat').attr('disabled',false);
            $('.keterangan').attr('disabled',false);
            $('.select2-example').attr('disabled',false);
            $('.note-editable').attr('contenteditable', true);
            $('#tombol').attr('disabled',false);

          }else{
            $('.judul').attr('disabled',true);
            $('.tanggal').attr('disabled',true);
            $('.tempat').attr('disabled',true);
            $('.select2-example').attr('disabled',true);
            $('.note-editable').attr('contenteditable', false);
            $('#tombol').attr('disabled',true);

          }
      });
      $('#datepicker').datepicker();
    });
</script>
</body>
</html>
