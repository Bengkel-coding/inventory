@extends('frontend.layouts.layout')
@push('style-css')
<link href='{{ asset(null) }}frontend/assets/fullcalender/fullcalendar.min.css' rel='stylesheet' />
<link href='{{ asset(null) }}frontend/assets/fullcalender/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<style type="text/css">
  h1 {
  font-family: "Avant Garde", Avantgarde, "Century Gothic", CenturyGothic, "AppleGothic", sans-serif;
  font-size: 22px;
  text-align: center;
  text-transform: uppercase;
  text-rendering: optimizeLegibility;
}
h1.elegantshadow {
   color: #59488D;
    letter-spacing: .15em;
    text-shadow: 
      1px -1px 0 #767676, 
      -1px 2px 1px #737272, 
      -2px 4px 1px #d8d6d5, 
      -3px 6px 1px #dbdad9, 
      -4px 8px 1px #dfdddc 
}
div.titleBsn{
    margin: -57px -20px 13px;
    border-bottom: 1px solid #ddd;
    border-radius: 0;

}
</style>
@endpush
@section('content')

  <div class="px-content">
    <div class="titleBsn">
      <h1 class="elegantshadow">Selamat Datang di Intranet BSN</h1>
    </div>

    <div class="row">
      <div class="col-md-5 fadeIn animated">   
        <div class="panel panel-primary panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-calendar"></i>Agendaku</span>
          </div>   
          <div id="support-tickets" class="ps-block">
          @if($data['agendaku'])
            @foreach($data['agendaku'] as $agendaku)
            <div class="widget-support-tickets-item">
              <div class="row">
                  <div class="col-md-5">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $agendaku->start_date)->format('j F Y')}} {{$agendaku->start_time}}</div>
                  <div class="col-md-7">
                    <a href="{{url('/agendaku/view/'.$agendaku->id)}}" title="" class="widget-support-tickets-title">
                      {{$agendaku->name}}
                    </a>
                    <span class="widget-support-tickets-info">{!! str_limit($agendaku->description, $limit=30, $end='...')!!}</span>
                  </div>
              </div>
            </div>
            @endforeach
          @endif
            
          </div>

          <a href="{{url('/agendaku')}}"" class="widget-more-link">SEE MORE</a>
        </div>
      </div>

      <div class="col-md-7 fadeIn animated"> 
        <div class="panel panel-primary panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-clipboard"></i>Agenda Pimpinan</span>
          </div> 
          
          <div id="support-tickets" class="ps-block">
          @if($data['agendapimpinan'])
            @foreach($data['agendapimpinan'] as $agendapimpinan)
            <div class="widget-support-tickets-item">
              <div class="row">
                  <div class="col-md-5">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $agendapimpinan->start_date)->format('j F Y')}} {{$agendapimpinan->start_time}}</div>
                  <div class="col-md-7">
                    <a href="{{url('/agenda-pimpinan/view/'.$agendapimpinan->id.'?profile='.$agendapimpinan->user_id)}}" title="" class="widget-support-tickets-title">
                      {{$agendapimpinan->name}}
                    </a>
                    <span class="widget-support-tickets-info">{!! str_limit($agendapimpinan->description, $limit=30, $end='...')!!}</span>
                  </div>
              </div>
            </div>
            @endforeach
          @endif
            
          </div>
          <a href="{{url('/agenda-pimpinan')}}"" class="widget-more-link">SEE MORE</a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-5">
      <div class="col-md-12 fadeIn animated">

        <!-- Support tickets -->

        <div class="panel panel-success">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i>Pengumuman Terbaru</span>
          </div>

          <div id="support-tickets" class="ps-block">
          @if($data['pengumuman'])
            @foreach($data['pengumuman'] as $pengumuman)
            <div class="widget-support-tickets-item">
              <a href="{{ url('pengumuman/detail/'.$pengumuman->id)}}" title="" class="widget-support-tickets-title">
                {!! str_limit($pengumuman->name, $limit=50, $end='...')!!} 
              </a>
              <span class="widget-support-tickets-info">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pengumuman->start_date)->format('j F Y')}}, By <a href="#" title="">{{ $pengumuman->user->name}}</a></span>
            </div>
            @endforeach
          @endif
            
          </div>

          <a href="{{url('/pengumuman')}}" class="widget-more-link">SEE MORE</a>
        </div>

        <!-- / Support tickets -->

      </div>
      <div class="col-md-12 fadeIn animated">

        <!-- Recent comments / threads -->

        <div class="panel panel-warning">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-comments text-danger"></i>Agenda BSN</span>
            <ul class="nav nav-tabs nav-xs">
              <li class="active"><a href="#umum" data-toggle="tab">Event Umum</a></li>
              <li><a href="#bsn" data-toggle="tab">Eventku</a></li>
            </ul>
          </div>

          <div class="tab-content p-a-0">
            <div id="umum" class="ps-block tab-pane fade in active">
            @if($data['event']['umum'])
              @foreach($data['event']['umum'] as $event)
              <div class="widget-support-tickets-item">
                <a href="{{ url('event-calendar/detail/'.$event->id)}}" title="" class="widget-support-tickets-title">
                  {!! str_limit($event->name, $limit=50, $end='...')!!} 
                </a>
                <span class="widget-support-tickets-info">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('j F Y')}} | By : <a href="#" title="">{{ $event->user->name}}</a></span>
              </div>
              @endforeach
            @endif
              
              <a href="{{url('/event-calendar')}}" class="widget-more-link">SEE MORE</a>
            </div>
            <div id="bsn" class="ps-block tab-pane fade">
            @if($data['event']['pribadi'])
              @foreach($data['event']['pribadi'] as $event)
                
              <div class="widget-support-tickets-item">
                <a href="{{ url('event-calendar/view/'.$event->id)}}" title="" class="widget-support-tickets-title">
                  {!! str_limit($event->name, $limit=50, $end='...')!!} 
                </a>
                <span class="widget-support-tickets-info">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('j F Y')}} | By : <a href="#" title="">{{ $event->user->name}}</a></span>
              </div>
              @endforeach
            @endif
                <a href="{{url('/event-calendar/eventku')}}" class="widget-more-link">SEE MORE</a>
            </div>
          </div>
        </div>

        <!-- / Recent comments / threads -->

      </div>
      </div>
      <div class="col-md-7 fadeIn animated">
        <div class="panel panel-success panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-calendar"></i>Jadwal Kegiatan Bulan ini</span>
          </div>

          <div id='calendar' class="p-a-1"></div>
          <a href="#" class="widget-more-link">SEE MORE</a>
        </div>

      </div>
    </div>
  </div>

  @if(count($log['event']) > 0 )
  <!-- Modal -->
  <div class="modal fade" id="modal-welcome" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title" id="myModalLabel">Event Hari ini</h4>
        </div>
        <div class="modal-body">
          @foreach($log['event'] as $event)
          <h3> <a href="{{ url('event-calendar/detail/'.$event->id)}}"> {{ $event->name }}</a></h3>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @endif

  @if(count($log['agenda']) > 0 )
  <!-- Modal -->
  <div class="modal fade" id="modal-agendaku" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title" id="myModalLabel">Agendaku Hari ini</h4>
        </div>
        <div class="modal-body">
          @foreach($log['agenda'] as $agenda)
          <h3> <a href="{{ url('agendaku/view/'.$agenda->id)}}"> {{ $agenda->name }}</a></h3>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @endif

  
  <!-- Modal -->
  <div class="modal fade" id="modal-calendar" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title" id="myModalLabel">Detail</h4>
        </div>
        <div class="modal-body">
          <h4 class="m-t-0" id="title">Text in a modal</h4>
          <p>Tanggal : <span id="tanggal"></span></p>
          <p>Mulai : <span id="mulai"></span></p>
          <p>Selesai : <span id="selesai"></span></p>
          <p>Tempat : <span id="tempat"></span></p>
          <p>Keterangan : <span id="ket"></span></p>
        </div>
      </div>
    </div>
  </div>
  

@endsection

@push('script-js')
<script src='{{ asset(null) }}frontend/assets/fullcalender/lib/moment.min.js'></script>
<script src='{{ asset(null) }}frontend/assets/fullcalender/fullcalendar.min.js'></script>

<script>


  $(document).ready(function() {

    $("#modal-welcome").modal("show");
    $("#modal-agendaku").modal("show");

  });

  $(document).ready(function() {
    
      $('#owl-carousel-basic').owlCarousel({
        items:      1,
        loop:   true,
        margin: 10,
        nav:    true,
        rtl: $('html').attr('dir') === 'rtl',
      });

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: "{{$data['date_default']}}",
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: {!! $calendar !!},
      eventClick:  function(event, jsEvent, view) {
          //set the values and open the modal
           $('h4#title').html(event.title);
           $('span#tanggal').html(event.tanggal);
           $('span#mulai').html(event.mulai);
           $('span#selesai').html(event.selesai);
           $('span#tempat').html(event.tempat);
           $('span#ket').html(event.ket);
           $("#modal-calendar").modal("show");
      }
    });
    
  });



</script>
@endpush