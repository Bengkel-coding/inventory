@extends('backend.layouts.layout')
@section('content')

<div id="app_header_shadowing"></div>
<div id="app_content">
    <div id="content_header">
        <h3 class="user"> {{ trinata::titleActionForm() }}</h3>
    </div>
        <div id="content_body">
            
            <div class = 'row'>

                <div class = 'col-md-6'>

                    @include('backend.common.errors')

                     {!! Form::model($model) !!} 

                      <div class="form-group">
                        <label>Title</label>
                        {!! Form::text('title' , null ,['class' => 'form-control','readonly'=>true]) !!}
                      </div>
                      
                      <table class = 'table'>
                          <thead>
                            <tr>
                              <th>-</th>
                              <th>Action</th>
                            </tr>
                          </thead>

                          <tbody>
                          
                            @foreach($actions as $row)
                              <tr>
                                  <td><input  {{ $cek($row->id) }} type = 'checkbox' value = '{{ $row->id }}' name = 'action[]' />{{ $cek($row) }}</td>
                                  <td>{{ $row->title }}</td>
                              </tr>
                            @endforeach
                          
                          </tbody>

                      </table>

                      <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    
                    {!! Form::close() !!}

                </div>

            </div>

        </div>
    </div>
@endsection