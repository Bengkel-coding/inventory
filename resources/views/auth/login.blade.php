@extends('app')
@push('style-css')

  <!-- Custom styling -->
  <style>
    .page-signin-header {
      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
    }

    .page-signin-header .btn {
      position: absolute;
      top: 12px;
      right: 15px;
    }

    html[dir="rtl"] .page-signin-header .btn {
      right: auto;
      left: 15px;
    }

    .page-signin-container {
      width: auto;
      margin: 30px 10px;
    }

    .page-signin-container form {
      border: 0;
      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
    }

    @media (min-width: 544px) {
      .page-signin-container {
        width: 350px;
        margin: 60px auto;
      }
    }

    .page-signin-social-btn {
      width: 40px;
      padding: 0;
      line-height: 40px;
      text-align: center;
      border: none !important;
    }

    #page-signin-forgot-form { display: none; }
  </style>
  <!-- Custom styling -->
  <style>
     body
     {
        background:url('{{ asset(null) }}frontend/assets/images/bg.png') no-repeat center center fixed;
        -webkit-background-size: 100%; 
        -moz-background-size: 100%; 
        -o-background-size: 100%; 
        background-size: 100%; 
      -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
    }
    .page-signin-header {
      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
    }

    .page-signin-header .btn {
      position: absolute;
      top: 12px;
      right: 15px;
    }

    html[dir="rtl"] .page-signin-header .btn {
      right: auto;
      left: 15px;
    }

    .page-signin-container {
      width: auto;
      margin: 30px 10px;
    }

    .page-signin-container form {
      border: 0;
      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
    }

    @media (min-width: 544px) {
      .page-signin-container {
        width: 350px;
        margin: 60px auto;
      }
    }

    .page-signin-social-btn {
      width: 40px;
      padding: 0;
      line-height: 40px;
      text-align: center;
      border: none !important;
    }

    #page-signin-forgot-form { display: none; }
  </style>
@endpush
@section('content')
<div class="page-signin-header p-a-2 text-sm-center bg-white"><img src="{{ asset(null) }}frontend/assets/images/logo.png" height="50px"/>
  </div>

  <!-- Sign In form -->

  <div class="page-signin-container" id="page-signin-form">
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20 text-white">Sign In to your Account</h2>

	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
    <form  method="POST" action="{{ url('/auth/login') }}" class="panel p-a-4">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
      <fieldset class=" form-group form-group-lg">
        <!-- <input type="text" class="form-control" placeholder="Username or Email"> -->
		<input type="email" class="form-control" placeholder="Username or Email" name="email" value="{{ old('email') }}">
      </fieldset>

      <fieldset class=" form-group form-group-lg">
        <!-- <input type="password" class="form-control" placeholder="Password"> -->
		<input type="password" class="form-control" placeholder="Password" name="password">
      </fieldset>

      <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Sign In</button>
    </form>

   
  </div>

  <!-- / Sign In form -->

@endsection
