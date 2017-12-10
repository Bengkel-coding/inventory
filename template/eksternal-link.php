
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
      <li class="active">Eksternal Link</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-external-link"></i> List Eksternal Link</div>
              </div>
              <div class="panel-body">
            <div class="row">
              <div class="col-md-12 fadeIn animated">
                <a href="tambah-eksternal-link.php" class="btn btn-primary btn-3d"> <i class="fa fa-plus"></i> Tambah</a> <a href="#" class="btn btn-danger btn-3d confirm"> <i class="fa fa-close"></i> Hapus</a>
              </div>
              <div class="col-md-12 fadeIn animated">
                <div class="table-secondary">
                  <table class="table table-striped table-bordered" id="datatables">
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>Title</th>
                        <th>Link</th>
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
                        <td>BSN</td>
                        <td class="center"><a href="http://www.bsn.go.id/" target="_blank"> http://www.bsn.go.id/</a></td> 
                        <td class="center">Publish</td>
                        <td class="center">
                          <a href="edit-eksternal-link.php" class="btn btn-success"><i class="fa fa-pencil"></i> / <i class="fa fa-search"></i></a> 
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

  <?php include "inc_script.php";?>

<script>

  $(document).ready(function() {
    
    $('#datatables').dataTable();    
    $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
    $('a.confirm').on('click',function() {
        swal({
          title: "Hapus Eksternal Link?",
          text: "Anda tidak akan dapat memulihkan Eksternal Link yang sudah dihapus",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes, Hapus Eksternal Link!',
          cancelButtonText: "No",
          closeOnConfirm: false
        },
        function(){
          swal("Hapus Eksternal Link!", "Eksternal Link Anda telah dihapus!", "success");
        });
      });
  });

</script>
</body>
</html>
