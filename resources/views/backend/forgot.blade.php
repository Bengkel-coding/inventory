@extends('backend.layouts.login')
@section('content')
            <div class="wg-content">
                <div class="wording">
                    {!! Form::open() !!}
                        <div class="fl label"></div>
                        <div class="fl input">
                            {!! Form::text('email' , null ,  ['placeholder' => 'Email'] ) !!}
                            <div style = 'margin-top:10px;color:red;'> {{ @$errors->first('email') }} </div>
                            <p>&nbsp;</p>
                        </div>
                        
                        
                        <div class="clear break15"></div>
                        
                       
                       <div style = 'margin-top:20px;'>
                            <div class="fl">
                                <a class="forgot-password" style="color:#1076bc;font:11px/32px verdana;" href = '{{ url("login") }}'>Back To Login Area</a>
                                <input type="submit" class="" value="Submit" style = 'margin-left:20px;'/>
                            </div>
                            
                            <div class="clear break1"></div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
@endsection
@section('script')
@include('backend.common.sweet_flashes')
@endsection
