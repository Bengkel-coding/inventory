@extends('backend.layouts.layout')
@section('content')
<style type="text/css">
    .datepicker{
        z-index: 99999;
    }
</style>

  <div class="px-content">
    <div class="row">
      <div class="col-md-12 fadeIn animated">   
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-list"></i>{{ trinata::titleActionForm() }}</span>
          </div>   
          
          <div class="panel-body">
            <div class="row p-a-3">
                <div class="col-md-12 fadeIn animated"> 
                  @include('backend.common.flashes')
                    <form method="get" action="download">
                      <div class="form-group">
                        <label>Type Material</label>
                        {!! Form::select('category' , [
                                                        'mro' => 'MRO' , 
                                                        'mro-abt' => 'MRO ABT' , 
                                                        'investasi' => 'Investasi' , 
                                                        'eksjar' => 'Eks Jaringan' , 
                                                        'tercatat' => 'Tercatat'
                                                        ] 
                                                        , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Periode</label>
                          {!! Form::text('periode' ,  null ,['class' => 'form-control datepicker']) !!}
                      </div>
                      
                      
                    <!-- <a href="#" class="btn btn-info">Lihat</a> -->
                    <button type="submit" class="btn btn-info">Export</button>
                      
                </div>
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
      
      $('.datepicker').datepicker({
        format: "mm-yyyy",
        startMode: "months", 
        minViewMode: "months",
        changeMonth: true,
        changeYear: true,
        minDate: '0d',
        maxDate: '1y'
      });

        $('button[type="submit"]').click(function(){
            $('div.panel-body').attr('class','panel-body form-loading form-loading-inverted');
        })
  });

</script>

@endpush