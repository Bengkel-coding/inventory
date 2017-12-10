
  <!--Head Include-->
  <?php include "inc_head.php";?>
  <?php include "inc_styles.php";?>

<link href='assets/fullcalender/fullcalendar.min.css' rel='stylesheet' />
<link href='assets/fullcalender/fullcalendar.print.min.css' rel='stylesheet' media='print' />
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
      <li class="active">List</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-list"></i> List Agendaku</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-5 fadeIn animated">
                <form action="#" method="post" class="panel-body form-horizontal p-y-1">
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
                      <label class="col-sm-4 control-label">Nik :</label>
                      <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" value="413431534231" readonly="readonly">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-4 control-label">Eselon :</label>
                      <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" value="II" readonly="readonly">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 fadeIn animated">
                <a href="tambah-agendaku.php" class="btn btn-primary btn-3d"> <i class="fa fa-plus"></i> Tambah</a> <a href="#" class="btn btn-danger btn-3d confirm"> <i class="fa fa-close"></i> Batal</a> <a href="#" class="btn btn-success btn-3d pull-xs-right btn-rounded"  data-toggle="modal" data-target="#modal-large"> <i class="fa fa-eye"></i> Lihat Kalender</a>
              </div>
              <div class="col-md-12 fadeIn animated">
                <div class="table-secondary">
                  <table class="table table-striped table-bordered" id="datatables">
                    <thead>
                      <tr>
                        <th>&nbsp;</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Acara</th>
                        <th>Tempat</th>
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
                        <td>8.00</td>
                        <td>13.00</td>
                        <td class="center"><a href="edit-agendaku.php"> Rapat Koordinator</a></td>
                        <td class="center">Ruang Besar</td>
                        <td class="center">-</td>
                        <td class="center">ESA</td>
                        <td class="center">Canceled</td>
                        <td class="center">
                          <a href="edit-agendaku.php" class="btn btn-success"><i class="fa fa-pencil"></i> / <i class="fa fa-search"></i></a> 
                          <a href="#" class="btn btn-danger confirm"><i class="fa fa-close"></i></a> 
                        </td>
                      </tr>
                      <tr class="even gradeC">
                        <td>
                          <div class="checkbox checkbox-danger">
                              <input id="checkbox6" type="checkbox" name="check">
                              <label for="checkbox6">&nbsp;</label>
                          </div>
                        </td>
                        <td>7/6/2017</td>
                        <td>9.00</td>
                        <td>12.00</td>
                        <td class="center"><a href="edit-agendaku.php">Rapat Internal</a></td>
                        <td class="center">Ruang Sedang</td>
                        <td class="center">-</td>
                        <td class="center">TNDE</td>
                        <td class="center">On Going</td>
                        <td class="center">
                          <a href="edit-agendaku.php" class="btn btn-success"><i class="fa fa-pencil"></i> / <i class="fa fa-search"></i></a> 
                          <a href="#" class="btn btn-danger confirm"><i class="fa fa-close"></i> </a> 
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

    <!-- Modal -->
    <div class="modal fadeIn animated" id="modal-large" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Calendar Agendaku</h4>
          </div>
          <div class="modal-body">            
            <div id='calendar'></div>
          </div>
        </div>
      </div>
    </div>

  <?php //include "inc_footer.php";?>
  <?php include "inc_script.php";?>

<script src='assets/fullcalender/lib/moment.min.js'></script>
<!-- <script src='assets/fullcalender/lib/jquery.min.js'></script> -->
<script src='assets/fullcalender/fullcalendar.min.js'></script>

<script>

  $(document).ready(function() {
    
    $('#datatables').dataTable();    
    $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
    $('#modal-large').on('shown.bs.modal', function () {
       $("#calendar").fullCalendar('render');
       // alert('data');
    });
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '2017-07-25',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2017-07-01'
        },
        {
          title: 'Long Event',
          start: '2017-07-07',
          end: '2017-07-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2017-07-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2017-07-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2017-07-11',
          end: '2017-07-13'
        },
        {
          title: 'Meeting',
          start: '2017-07-12T10:30:00',
          end: '2017-07-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2017-07-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2017-07-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2017-07-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2017-07-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2017-07-13T07:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2017-07-13T08:00:00',
          color: '#31A663'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2017-07-28'
        }
      ]
    });
    $('a.confirm').on('click',function() {
        swal({
          title: "Batalkan Agenda?",
          text: "Anda tidak akan dapat memulihkan agenda yang sudah dibatalkan",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: '#DD6B55',
          confirmButtonText: 'Yes, Batalkan Agenda!',
          cancelButtonText: "No",
          closeOnConfirm: false
        },
        function(){
          swal("Batal Agenda!", "Agenda Anda telah dibatalkan!", "success");
        });
      });
  });

</script>
</body>
</html>
