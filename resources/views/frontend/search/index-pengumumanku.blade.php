@extends('frontend.layouts.layout')

@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li class="active">Pengumumanku</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-bullhorn"></i> Pengumumanku</div>
              </div>
              <div class="panel-body">
                      
                      <div class="row">
                        <div class="col-md-12 fadeIn animated">
                          <a href="{{url('/pengumuman/create')}}" class="btn btn-primary btn-3d"> <i class="fa fa-plus"></i> Tambah</a> {{--<a href="#" class="btn btn-danger btn-3d confirm"> <i class="fa fa-close"></i> Batal</a>--}}
                        </div>
                        <div class="col-md-12 fadeIn animated">
                          <div class="table-secondary">
                            <table class="table table-striped table-bordered" id="datatables">
                              <thead>
                                <tr>
                                  {{--<th>&nbsp;</th>--}}
                                  <th>Tanggal</th>
                                  <th>Judul</th>
                                  <th>Keterangan</th>
                                  <th>Created By</th>
                                  <th>Status</th>
                                  <th>Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                              @if($data['announcement'])
                                @foreach($data['announcement'] as $announcement)
                                  <tr class="odd gradeX" id="announce-{{$announcement->id}}">
                                    {{--<td>
                                      <div class="checkbox checkbox-danger">
                                          <input id="checkbox1" type="checkbox" name="check">
                                          <label for="checkbox1">&nbsp;</label>
                                      </div>
                                    </td>--}}
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $announcement->start_date)->format('j F Y')}}</td>
                                    <td class="center"><a href="{{url('/pengumuman/detail/'.$announcement->id)}}"> {{$announcement->name}}</a></td>
                                    <td class="center">{!! str_limit($announcement->description, $limit=50, $end='...')!!}</td>
                                    <td class="center">{{$announcement->user->name}}</td>
                                    <td class="center">@if($announcement->status == 'unpublish') Pending Approval @else {{$announcement->status}} @endif</td>
                                    <td class="center">
                                      <a href="{{url('/pengumuman/update/'.$announcement->id)}}" class="btn btn-success"><i class="fa fa-pencil"></i></a> 
                                      <a href="{{url('/pengumuman/detail/'.$announcement->id)}}" class="btn btn-warning"> <i class="fa fa-search"></i></a> 
                                      <a href="#" class="btn btn-danger confirm" announce-id="{{$announcement->id}}"><i class="fa fa-close"></i></a> 
                                    </td>
                                  </tr>
                                @endforeach
                              @endif
                                
                              </tbody>
                            </table>
                          </div>

                          </div>
                        </div>
              </div>
            </div>
    </div>

@endsection
@push('script-js')

<script type="text/javascript">  
    $(function() {
      
    $('#datatables').dataTable();    
    $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
     
    });

    $('a.confirm').on('click',function() {

        var announceId = $(this).attr('announce-id');

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
          $.ajax({
            type : 'get',
            url : basedomain +'/pengumuman/delete',
            data : {
              id : announceId,
            },
            success : function(data){
              if (data.result == true) {
                $('#announce-'+announceId).remove();
                swal("Batal Pengumuman!", "Pengumuman Anda telah dihapus!", "success");
              } else {
                swal("Maaf", "Pengumuman Anda tidak dapat dibatalkan!", "info");
              }
              
            },
          });

          // swal("Batal Pengumuman!", "Pengumuman Anda telah dibatalkan!", "success");
        });
      });
</script>
@endpush
