@extends('backend.layouts.layout')
@section('content')

 
  <div class="px-content">
    <div class="page-header">
      <div class="row">
        <div class="col-md-4">
          <h1><i class="page-header-icon ion-ios-pie"></i>Dashboard <span class="text-muted font-weight-light">Progress</span></h1>
        </div>
      </div>
    </div>

    <div class="row">

      <!-- Stats -->

      <div class="col-md-3">
        <div class="box bg-danger darken">
          <div class="box-cell p-x-3 p-y-1">
            <div class="font-weight-semibold font-size-12">Mutasi</div>
            <div class="font-weight-bold font-size-20">919</div>
            <i class="box-bg-icon middle right font-size-52 fa fa-refresh"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="box bg-danger darken">
          <div class="box-cell p-x-3 p-y-1">
            <div class="font-weight-semibold font-size-12">Pemanfaatan</div>
            <div class="font-weight-bold font-size-20">991</div>
            <i class="box-bg-icon middle right font-size-52 fa fa-gavel"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="box bg-danger darken">
          <div class="box-cell p-x-3 p-y-1">
            <div class="font-weight-semibold font-size-12">Pengembalian</div>
            <div class="font-weight-bold font-size-20">191</div>
            <i class="box-bg-icon middle right font-size-52 fa fa-undo"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="box bg-success darken">
          <div class="box-cell p-x-3 p-y-1">
            <div class="font-weight-semibold font-size-12">Inventarisasi</div>
            <div class="font-weight-bold font-size-20">0</div>
            <i class="box-bg-icon middle right font-size-52 ion-arrow-graph-up-right"></i>
          </div>
        </div>
      </div>

      <!-- / Stats -->

    </div>

    <hr class="page-wide-block m-y-0">


    <div class="row">
      <div class="col-md-6">

        <!-- Content stats -->

        <div class="panel panel-success panel-body-colorful">
          <div class="panel-title">Mutasi</div>
          <hr class="m-a-0">

         
          <div class="panel-body p-y-0 font-size-14">
            <div class="row">
              <div class="col-md-6 m-y-3"><i class="fa fa-clock-o text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>919</strong> pending</a></div>
              <div class="col-md-6 m-y-3"><i class="fa fa-check text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>152</strong> approved</a></div>
            </div>
            <div class="row">
              <div class="col-md-6 m-b-3"><i class="fa fa-refresh text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>1,031</strong> process</a></div>
            </div>
          </div>
        </div>

        <!-- / Content stats -->

      </div>
      <div class="col-md-6">

        <!-- Discussion stats -->

        <div class="panel panel-info panel-body-colorful">
          <div class="panel-title">Pemanfataan</div>
          <hr class="m-a-0">

          <div class="panel-body p-y-0 font-size-14">
            <div class="row">
              <div class="col-md-6 m-y-3"><i class="fa fa-clock-o text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>991</strong> pending</a></div>
              <div class="col-md-6 m-y-3"><i class="fa fa-check text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>152</strong> approved</a></div>
            </div>
            <div class="row">
              <div class="col-md-6 m-b-3"><i class="fa fa-refresh text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>1,031</strong> process</a></div>
            </div>
          </div>
        </div>

        <!-- / Discussion stats -->

      </div>
    </div>

    <div class="row">
      <div class="col-md-6">

        <!-- Content stats -->

        <div class="panel panel-success panel-body-colorful">
          <div class="panel-title">Pengembalian</div>
          <hr class="m-a-0">

          <div class="panel-body p-y-0 font-size-14">
            <div class="row">
              <div class="col-md-6 m-y-3"><i class="fa fa-clock-o text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>191</strong> pending</a></div>
              <div class="col-md-6 m-y-3"><i class="fa fa-check text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>152</strong> approved</a></div>
            </div>
            <div class="row">
              <div class="col-md-6 m-b-3"><i class="fa fa-refresh text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>1,031</strong> process</a></div>
            </div>
          </div>
        </div>

        <!-- / Content stats -->

      </div>
      <div class="col-md-6">

        <!-- Discussion stats -->

        <div class="panel panel-info panel-body-colorful">
          <div class="panel-title">Inventarisasi</div>
          <hr class="m-a-0">

          <div class="panel-body p-y-0 font-size-14">
            <div class="row">
              <div class="col-md-6 m-y-3"><i class="fa fa-clock-o text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>0</strong> pending</a></div>
              <div class="col-md-6 m-y-3"><i class="fa fa-check text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>152</strong> approved</a></div>
            </div>
            <div class="row">
              <div class="col-md-6 m-b-3"><i class="fa fa-refresh text-muted"></i>&nbsp;&nbsp;<a href="#"><strong>1,031</strong> process</a></div>
            </div>
          </div>
        </div>

        <!-- / Discussion stats -->

      </div>
    </div>

  

  </div>

@endsection

@push('script-js')
<script type="text/javascript">
  

</script>
@endpush