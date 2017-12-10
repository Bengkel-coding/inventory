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
                        <label>Role</label>
                        {!! Form::select('role_id' , $roles ,null,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Head</label>
                        {!! Form::select('head_id' , $head ,null,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Division</label>
                        {!! Form::select('division_id' , $division ,null,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Username</label>
                        {!! Form::text('username' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Name</label>
                        {!! Form::text('name' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Email</label>
                        {!! Form::text('email' , null ,['class' => 'form-control']) !!}
                      </div>

                    <div class="form-group">
                        <label>Password</label>
                        {!! Form::password('password',['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Verify Password</label>
                        {!! Form::password('verify_password',['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Jenis Member</label>
                        {!! Form::select('position',['member'=>'Member', 'eselon_1'=>'Eselon 1','eselon_2'=>'Eselon 2', 'eselon_3'=>'Eselon 3', 'eselon_4'=>'Eselon 4'], null,['class' => 'form-control']) !!}
                      </div>
                      <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    
                    {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
</div>
@endsection