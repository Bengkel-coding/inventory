@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <div class="panel-title"><i class="fa fa-plus"></i> {{ trinata::titleActionForm() }}</div>
          </div>
          <div class="panel-body">
          <div class="row">
          <div class="col-md-12">
            @include('backend.common.errors')

                     {!! Form::model($model,['files' => true]) !!} 
                     
                    <a href="{{asset('contents/template-import/'.Request::segment(2).'-form.xlsx')}}" class="btn" style="float: right;" target="_blank">Download template</a>
                    <div class="col-md-7" style="clear: both;">
                    <form method="get" action="">
                      <div class="form-group">
                        <label>Lokasi Gudang</label>
                        {!! Form::select('warehouse' , $warehouse , null ,['class' => 'form-control warehouse']) !!}
                      </div>
                      
                      <div class="form-group">
                        <label>Pilih File</label>
                        {!! Form::file('file' , null ,['class' => 'form-control btn']) !!}
                      </div>

                      <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    
                    </form>
                    </div>

          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@push('script-js')
<script type="text/javascript">
    $(document).ready(function() {
        $('button[type="submit"]').click(function(){
            $('div.panel-body').attr('class','panel-body form-loading form-loading-inverted');
        })
    })
</script>
@endpush