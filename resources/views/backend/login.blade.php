@extends('backend.layouts.login')
@push('style-css')

  <!-- Custom styling -->
  <style>
    .page-signin-modal {
      position: relative;
      top: auto;
      right: auto;
      bottom: auto;
      left: auto;
      z-index: 1;
      display: block;
    }

    .page-signin-form-group { position: relative; }

    .page-signin-icon {
      position: absolute;
      line-height: 21px;
      width: 36px;
      border-color: rgba(0, 0, 0, .14);
      border-right-width: 1px;
      border-right-style: solid;
      left: 1px;
      top: 9px;
      text-align: center;
      font-size: 15px;
    }

    html[dir="rtl"] .page-signin-icon {
      border-right: 0;
      border-left-width: 1px;
      border-left-style: solid;
      left: auto;
      right: 1px;
    }

    html:not([dir="rtl"]) .page-signin-icon + .page-signin-form-control { padding-left: 50px; }
    html[dir="rtl"] .page-signin-icon + .page-signin-form-control { padding-right: 50px; }

    #page-signin-forgot-form {
      display: none;
    }

    /* Margins */

    .page-signin-modal > .modal-dialog { margin: 30px 10px; }

    @media (min-width: 544px) {
      .page-signin-modal > .modal-dialog { margin: 60px auto; }
    }
  </style>
@endpush
@section('content') 
           <div class="page-signin-modal modal">
    <div class="modal-dialog">
      <div class="modal-content" style="margin-top: 150px">
        <div class="box m-a-0">
          <div class="box-row">

            <div class="box-cell col-md-5 bg-primary p-a-4">
              <div class="text-xs-center text-md-left">
                <img src="{{ asset(null) }}backend/assets/images/logo.png" height="50px"/>
                <br/>
                <br/>
                <span class="font-size-20 line-height-1">Cpanel Admin</span>
                <div class="font-size-15 m-t-1 line-height-1">Simple. Flexible. Powerful.</div>
                <div class="font-size-11 m-t-1 line-height-2">Copyright &copy; 2017 <a href="http://trinatateknologi.com/">Trinata Teknologi</a>. All Rights Reserved</div>
              </div>
            </div>

            <div class="box-cell col-md-7">
              <!-- Sign In form -->
              {!! Form::open(['id'=>'page-signin-form','class'=> 'p-a-4']) !!}
                <h4 class="m-t-0 m-b-4 text-xs-center font-weight-semibold">Sign In to your Account</h4>

                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="ion-person"></i></div>
                  {!! Form::text('username' , null ,  ['placeholder' => 'Username','class' => 'page-signin-form-control form-control'] ) !!}
                </fieldset>

                <fieldset class="page-signin-form-group form-group form-group-lg">
                  <div class="page-signin-icon text-muted"><i class="ion-asterisk"></i></div>
                  {!! Form::password('password' ,  ['placeholder' => 'Password','class' => 'page-signin-form-control form-control'] ) !!}
                </fieldset>

                <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Sign In</button>
                {!! Form::close() !!}
              <!-- / Sign In form -->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="px-responsive-bg"><div class="px-responsive-bg-overlay" style="background: rgb(0, 0, 0); opacity: 0.2;"></div><img alt="" src="{{ asset(null) }}backend/assets/demo/bgs/2.jpg" style="width: 100%; height: 900px; top: -183px; left: 0px;"></div>
@endsection
@push('script-js')
    
    @if(@$errors->any() || Session::has('message'))

       <script type="text/javascript">
            swal({
              type : "error",
              title: "Error",
              text: "User not Found!",
              html: true
            });
        </script>

    @endif

@endpush