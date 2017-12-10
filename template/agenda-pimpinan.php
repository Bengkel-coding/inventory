
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
      <li><a href="dashboard.php">Dashboard</a></li>
      <li class="active">Agenda Pimpinan</li>
    </ol>

    <div class="row">
      <div class="col-md-5">
      <div class="col-md-12 fadeIn animated">

        <!-- Support tickets -->

        <div class="panel panel-info">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-clipboard"></i>Tampilkan Agenda Pemimpin</span>
          </div>
          <form action="list-agenda-pimpinan.php" method="post" class="panel-body p-y-1">
            <div class="form-group">
              <div class="row">
                <label class="col-sm-4 control-label">Nama Pejabat:</label>
                <div class="col-sm-8">
                  <select class="form-control select2-example" style="width: 100%" data-allow-clear="true">
                    <option></option>
                    <option value="AK" selected="selected">Y. Krityanto</option>
                    <option value="HI">Ovan</option>
                    <option value="CA">Arum</option>
                    <option value="CA">Junaedi</option>
                  </select>
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
            <div class="input-daterange" id="datepicker-range">
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-4 control-label">Dari :</label>
                  <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" class="form-control" name="start">
                        <span class="input-group-btn">
                          <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                        </span>
                      </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <label class="col-sm-4 control-label">Sampai :</label>
                  <div class="col-sm-8">                  
                      <div class="input-group m-b-2">
                        <input type="text" class="form-control" name="end">
                        <span class="input-group-btn">
                          <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                        </span>
                      </div>
                  </div>
                </div>
              </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label class="col-sm-4 control-label">
                    <button type="submit" class="btn btn-primary btn-3d">Tampilkan</button>
                  </label>
                  <div class="col-sm-8">                  
                      &nbsp;
                  </div>
                </div>
              </div>
          </form>
        </div>

        <!-- / Support tickets -->

      </div>
      
      <div class="col-md-12 fadeIn animated">

        <!-- Support tickets -->

        <div class="panel panel-success">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-list"></i>Agenda List</span>
          </div>

          <div id="support-tickets" class="ps-block">

            <div class="widget-support-tickets-item">
              <div class="row">
                  <div class="col-md-5">12/08/2017 6:00 AM</div>
                  <div class="col-md-7">
                    <a href="#" title="" class="widget-support-tickets-title">
                      An Event List
                    </a>
                    <span class="widget-support-tickets-info">Lorem ipsum dot telor ceplok</span>
                  </div>
              </div>
            </div>
            <div class="widget-support-tickets-item">
              <div class="row">
                  <div class="col-md-5">22/07/2017 6:00 AM</div>
                  <div class="col-md-7">
                    <a href="#" title="" class="widget-support-tickets-title">
                      An Agenda List
                    </a>
                    <span class="widget-support-tickets-info">Lorem ipsum dot telor ceplok</span>
                  </div>
              </div>
            </div>

            <div class="widget-support-tickets-item">
              <div class="row">
                  <div class="col-md-5">12/07/2017 6:00 AM</div>
                  <div class="col-md-7">
                    <a href="#" title="" class="widget-support-tickets-title">
                      Another Event List
                    </a>
                    <span class="widget-support-tickets-info">Lorem ipsum dot telor ceplok</span>
                  </div>
              </div>
            </div>
            <div class="widget-support-tickets-item">
              <div class="row">
                  <div class="col-md-5">22/07/2017 6:00 AM</div>
                  <div class="col-md-7">
                    <a href="#" title="" class="widget-support-tickets-title">
                      An Agenda List
                    </a>
                    <span class="widget-support-tickets-info">Lorem ipsum dot telor ceplok</span>
                  </div>
              </div>
            </div>

            <div class="widget-support-tickets-item">
              <div class="row">
                  <div class="col-md-5">12/07/2017 6:00 AM</div>
                  <div class="col-md-7">
                    <a href="#" title="" class="widget-support-tickets-title">
                      Another Event List
                    </a>
                    <span class="widget-support-tickets-info">Lorem ipsum dot telor ceplok</span>
                  </div>
              </div>
            </div>
            <div class="widget-support-tickets-item">
              <div class="row">
                  <div class="col-md-5">22/07/2017 6:00 AM</div>
                  <div class="col-md-7">
                    <a href="#" title="" class="widget-support-tickets-title">
                      An Agenda List
                    </a>
                    <span class="widget-support-tickets-info">Lorem ipsum dot telor ceplok</span>
                  </div>
              </div>
            </div>

            <div class="widget-support-tickets-item">
              <div class="row">
                  <div class="col-md-5">12/07/2017 6:00 AM</div>
                  <div class="col-md-7">
                    <a href="#" title="" class="widget-support-tickets-title">
                      Another Event List
                    </a>
                    <span class="widget-support-tickets-info">Lorem ipsum dot telor ceplok</span>
                  </div>
              </div>
            </div>
          </div>

        </div>

        <!-- / Support tickets -->

      </div>
      </div>
      <div class="col-md-7 fadeIn animated">
        <div class="panel panel-success panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-calendar"></i>Agenda Calendar</span>
          </div>

          <div id='calendar' class="p-a-1"></div>
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
    
  });

    $(function() {
      $('.select2-example').select2({
        placeholder: 'Select value',
      });
    });

    $(function() {
      $('#datepicker-range').datepicker();
    });
</script>
</body>
</html>
