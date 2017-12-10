@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <div class="row">
      <div class="col-md-7 fadeIn animated">   
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-bar-chart"></i>{{ trinata::titleActionForm() }}</span>
          </div>   
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <canvas id="chart-bars" width="400" height="250"></canvas>
                </div>
              </div>
            </div>
        </div>
      </div>

      <div class="col-md-5 fadeIn animated"> 
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-list"></i>User Activities</span>
          </div> 
          <div class="row p-a-3">
            <table class = 'table table-bordered'>
                    <tbody>
                        @foreach($last as $row)
                            
                            <tr class = "{{ $row->id % 2 == 0 ? 'success' : 'danger' }}">
                                <td>{{ $row->action }}</td>
                                <td>{{ Carbon\Carbon::parse($row->created_at)->format("d F ,Y H:i:s") }}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>

          </div>
        </div>
      </div>
    </div>

  </div>

@endsection

@push('script-js')
<script type="text/javascript">
  
    $(function() {
      var data = {
        labels: ["{!! $charts['dates'] !!}"],
        datasets: [{
          label:           'User Activities',
          data:            [{{$charts['data']}}],
          borderWidth:     1,
          backgroundColor: pxUtil.hexToRgba('#1076BC', 0.3),
          borderColor:     '#1076BC',
        }],
      };

      new Chart(document.getElementById('chart-bars').getContext("2d"), {
        type: 'bar',
        data: data,
      });
    });

</script>
@endpush