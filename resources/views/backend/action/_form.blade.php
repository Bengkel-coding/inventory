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

             {!! Form::model($model) !!} 

              <div class="form-group">
                <label>Title</label>
                {!! Form::text('title' , null ,['class' => 'form-control']) !!}
              </div>
              <div class="form-group">
                <label>Slug</label>
                {!! Form::text('slug' , null ,['class' => 'form-control']) !!}
              </div>

              <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
            
            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
</div>
@endsection