@extends('frontend.layouts.layout')
@section('content')
<div class="px-content">
    <div class="page-header m-b-0 p-b-0 b-b-0">
      <h1>Account <span class="text-muted font-weight-light">Settings</span></h1>

      
      <ul class="nav nav-tabs page-block m-t-4" id="account-tabs">
        <li>
          <a href="{{url('/profile')}}">
            Profile
          </a>
        </li>
        <li class="active">
          <a href="{{url('/profile/akun')}}">
            Akun
          </a>
        </li>
      </ul>
    </div>

    <div class="tab-content p-y-4">

      <!-- Password tab -->

      @include('frontend.common.flashes')
      <div class="tab-pane fade in active" id="account-password">
        {!! Form::model($model,['class' => 'p-x-1']) !!} 
          <fieldset class="form-group form-group-lg">
            <label for="account-username">Username</label>
            <input type="text" class="form-control" id="account-username" value="{{$user->username}}" readonly="readonly">
          </fieldset>
          <!-- <fieldset class="form-group form-group-lg">
            <label for="account-password">Old password</label>
            <input type="password" class="form-control" id="account-password">
          </fieldset> -->
          <fieldset class="form-group form-group-lg">
            <label for="account-new-password">New password</label>
            <input type="password" class="form-control" id="account-new-password" name="password" >
            <small class="text-muted">Minimum 1 characters</small>
          </fieldset>
          <fieldset class="form-group form-group-lg">
            <label for="account-new-password-repeat">Verify password</label>
            <input type="password" class="form-control" id="account-new-password-repeat" name="password_confirm">
          </fieldset>
          <button type="submit" class="btn btn-lg btn-primary m-t-3">Change password</button>
          {!! Form::close() !!}

      </div>

      <!-- / Password tab -->

    </div>
  </div>

@endsection

@push('script-js')
<script type="text/javascript">
  $(document).ready(function(){

    function readURLplay(input,id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+id).attr('src', e.target.result);
                    $('#'+id).attr('width', '160px');
                    $('#'+id).attr('height', '160px');
                }
                 reader.readAsDataURL(input.files[0]);
            }
        }

     $("#imgProfile").change(function(){
            var ext = this.value.match(/\.(.+)$/)[1];
              switch (ext) {
                  case 'jpg':
                  case 'png':
                  case 'gif':
                      var sizeFile = (this.files[0].size/1024/1024).toFixed(2);
                
                      if(sizeFile<1){

                        readURLplay(this,'previewimgProfile');
                      }else{
                        // alert('This file size is big: ' + (this.files[0].size/1024/1024).toFixed(2) + 'MB');
                         swal({"showConfirmButton":true,"timer":"null","allowOutsideClick":false,"text":"Error Message","title":"This file size is big: " + (this.files[0].size/1024/1024).toFixed(2) + "MB","type":"error","confirmButtonText":"Close this"});
                      
                      }
                    
                      break;
                  default:
                      // alert('This is not an allowed file type.');           
                      swal({"showConfirmButton":true,"timer":"null","allowOutsideClick":false,"text":"Error Message","title":"This is not an allowed file type.","type":"error","confirmButtonText":"Close this"});
                      this.value = '';
                      
              }
        });
  })
</script>
@endpush