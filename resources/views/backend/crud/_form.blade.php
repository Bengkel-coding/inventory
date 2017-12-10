@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <div class="panel-title"><i class="fa fa-plus"></i> {{ trinata::titleActionForm() }}</div>
          </div>
          <div class="panel-body">
          <div class="row">
          <div class="col-md-7">
            @include('backend.common.errors')

                     {!! Form::model($model,['files' => true]) !!} 

                      <div class="form-group">
                        <label>Title</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>
                      
                      <div class="form-group">
                        <label>Description</label>
                        {!! Form::textarea('description' , null ,['class' => 'form-control','id'=>'description']) !!}
                      </div>

                      <div class="form-group">
                        <label>File</label>
                        {!! Form::file('image' , null ,['class' => 'form-control']) !!}
                      </div>

                      @if(!empty($model->image))

                        <div class="form-group">
                          <label>Old Image</label><br/>
                          <img src = '{{ asset("contents/".$model->image) }}' width = '200' height = '100'/>
                        </div>

                      @endif

                      <div class="form-group">
                        <label>Status</label>
                        {!! Form::select('status' , ['y' => 'Publish' , 'n' => 'Un Publish'] , null ,['class' => 'form-control']) !!}
                      </div>

                      <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    
                    {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@push('script-js')
<script type="text/javascript">
  
  window.onload = function()
  {
      CKEDITOR.replace( 'description',{
      filebrowserBrowseUrl: '{{ urlBackend("image/lib")}}'});
  }
</script>
@endpush