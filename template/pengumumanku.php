
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
      <li class="active">Pengumumanku</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-bullhorn"></i> Pengumuman</div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <ul class="nav nav-tabs">
                    <li>
                      <a href="pengumuman-umum.php">
                        Umum
                      </a>
                    </li>
                    <li class="active">
                      <a href="pengumumanku.php">
                        Pengumumanku
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content tab-content-bordered">
                    <div class="tab-pane fade in active" id="tabs-home">
                      
                      <div class="row">
                        <div class="col-md-12 fadeIn animated">
                          <a href="tambah-pengumumanku.php" class="btn btn-primary btn-3d"> <i class="fa fa-plus"></i> Tambah</a> <a href="#" class="btn btn-danger btn-3d confirm"> <i class="fa fa-close"></i> Batal</a>
                        </div>
                        <div class="col-md-12 fadeIn animated">
                          <div class="table-secondary">
                            <table class="table table-striped table-bordered" id="datatables">
                              <thead>
                                <tr>
                                  <th>&nbsp;</th>
                                  <th>Tanggal</th>
                                  <th>Judul</th>
                                  <th>Keterangan</th>
                                  <th>Created By</th>
                                  <th>Status</th>
                                  <th>Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr class="odd gradeX">
                                  <td>
                                    <div class="checkbox checkbox-danger">
                                        <input id="checkbox1" type="checkbox" name="check">
                                        <label for="checkbox1">&nbsp;</label>
                                    </div>
                                  </td>
                                  <td>5/6/2017</td>
                                  <td class="center"><a href="edit-pengumumanku.php"> Kurma Spesial</a></td>
                                  <td class="center">Salam Koperasi</td>
                                  <td class="center">Ponimin Pusdi</td>
                                  <td class="center">Approved</td>
                                  <td class="center">
                                    <a href="edit-pengumumanku.php" class="btn btn-success"><i class="fa fa-pencil"></i> / <i class="fa fa-search"></i></a> 
                                    <a href="#" class="btn btn-danger confirm"><i class="fa fa-close"></i></a> 
                                  </td>
                                </tr>
                                
                              </tbody>
                            </table>
                          </div>

                          </div>
                        </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
    </div>


  <?php include "inc_script.php";?>

<script type="text/javascript">  
    $(function() {
      
    $('#datatables').dataTable();    
    $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
     
    });

    $('a.confirm').on('click',function() {
        swal({
          title: "Batalkan Pengumuman?",
          text: "Anda tidak akan dapat memulihkan Pengumuman yang sudah dibatalkan",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes, Batalkan Pengumuman!',
          cancelButtonText: "No",
          closeOnConfirm: false
        },
        function(){
          swal("Batal Pengumuman!", "Pengumuman Anda telah dibatalkan!", "success");
        });
      });
</script>
</body>
</html>
