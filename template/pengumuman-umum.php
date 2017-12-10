
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
      <li class="active">Pengumuman Umum</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-bullhorn"></i> Pengumuman</div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="pengumuman-umum.php">
                        Umum
                      </a>
                    </li>
                    <li>
                      <a href="pengumumanku.php">
                        Pengumumanku
                      </a>
                    </li>
                  </ul>
                  <div class="tab-content tab-content-bordered">
                    <div class="tab-pane fade in active" id="tabs-home">
                      <div class="row">
                        <div class="col-md-3 pull-xs-right">
                          <form action="" method="GET" class="input-group">
                            <input type="text" name="s" class="form-control" placeholder="Cari Pengumuman">
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                            </span>
                          </form>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="widget-support-tickets-item">
                            <a href="view-pengumuman-umum.php" title="" class="widget-support-tickets-title text-underlined">
                              Kurma Spesial <span class="badge badge-danger">NEW!</span>
                            </a>
                            <span class="widget-support-tickets-info">20 Oktober 2017 | By <a href="#" title="">Ovan - Trinata</a></span>
                            <p>
                              Salam koperasi Standia BSN, Semoga Bapak/Ibu dan Rekan-rekan dalam menjalankan ibadah puasa kali ini diberi kesehatan, kenikmatan, kesabaran dan diberkahi oleh ALLAH SWT, 
                            </p>
                          </div>
                          <div class="widget-support-tickets-item">
                            <a href="view-pengumuman-umum.php" title="" class="widget-support-tickets-title text-underlined">
                              Berita Duka Cita <span class="badge badge-danger">NEW!</span>
                            </a>
                            <span class="widget-support-tickets-info">20 Oktober 2017 | By <a href="#" title="">Ovan - Trinata</a></span>
                            <p>
                              Telah Meninggal Dunia, Kerabat dari Seseorang yang sedang sedih saat ini...
                            </p>
                          </div>
                          <div class="widget-support-tickets-item">
                            <a href="view-pengumuman-umum.php" title="" class="widget-support-tickets-title text-underlined">
                              23 Juni 2017 Libur Bersama Pemerintah Berdasarkan PP No.. <span class="badge badge-danger">NEW!</span>
                            </a>
                            <span class="widget-support-tickets-info">20 Oktober 2017 | By <a href="#" title="">Ovan - Trinata</a></span>
                            <p>
                              Tulisan disini dalam rangka memahami dan mendiskusikan gagasan yang terdapat dalam essai pemenang BSN ESSAY Competition 2017.
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 text-xs-center">
                          <ul class="pagination">
                            <li class="disabled">
                              <a href="#">Previous</a>
                            </li>
                            <li class="active">
                              <a href="#">1</a>
                            </li>
                            <li>
                              <a href="#">2</a>
                            </li>
                            <li>
                              <a href="#">3</a>
                            </li>
                            <li>
                              <a href="#">4</a>
                            </li>
                            <li>
                              <a href="#">5</a>
                            </li>
                            <li>
                              <a href="#">6</a>
                            </li>
                            <li>
                              <a href="#">Next</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                            <a href="tambah-pengumumanku.php" class="text-underlined"><i class="fa fa-plus"></i>Buat Pengumuman Baru</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
    </div>

  <?php include "inc_script.php";?>
</body>
</html>
