@extends('frontend.layouts.layout')
@section('content')
<div class="px-content">
    <div class="page-header m-b-0 p-b-0 b-b-0">
      <h1>Account <span class="text-muted font-weight-light">Settings</span></h1>

      <ul class="nav nav-tabs page-block m-t-4" id="account-tabs">
        <li class="active">
          <a href="{{url('/profile')}}">
            Profile
          </a>
        </li>
        <li>
          <a href="{{url('/profile/akun')}}">
            Akun
          </a>
        </li>
      </ul>
    </div>

    <div class="tab-content p-y-4">

      @include('frontend.common.flashes')
      <!-- Profile tab -->

      <div class="tab-pane fade in active" id="account-profile">
        <div class="row">
          {!! Form::model($model,['class' => 'col-md-8 col-lg-9','files'=> true]) !!} 
            <div class="p-x-1">
              <fieldset class="form-group form-group-lg">
                <label for="account-name">Name</label>
                <input type="text" class="form-control" name="name" id="account-name" value="{{$model->name}}">
              </fieldset>
              <fieldset class="form-group form-group-lg">
                <label for="account-name">NIP</label>
                <input type="text" class="form-control"  id="account-name" value="{{$user->profile->nip}}" readonly="readonly">
              </fieldset>
              <fieldset class="form-group form-group-lg">
                <label for="account-email">E-mail</label>
                <input type="email" class="form-control" id="account-email" value="{{$model->email}}" readonly="readonly">
              </fieldset>
              <fieldset class="form-group form-group-lg">
                <label for="account-name">Phone</label>
                <input type="text" class="form-control"  name="phone"  id="account-name" value="{{$model->profile->phone_number}}">
              </fieldset>
              <fieldset class="form-group form-group-lg">
                <label for="account-bio">Address</label>
                <textarea class="form-control" rows="3"  name="address"  id="account-bio" maxlength="200" data-counter="#account-bio + small > strong">{{$model->profile->address}}</textarea>
              </fieldset>
              <fieldset class="form-group form-group-lg">
                <label for="account-bio">Berkas CV</label>
                <label class="custom-file px-file">
                  <input type="file" name="cv_file" id="fileProfile" class="custom-file-input" >
                  <span class="custom-file-control form-control" id="textFile">Pilih Berkas...</span>
                </label>  
                @if($model->profile->cv_file)<label class="">{{ $model->profile->cv_file }}</label> 
                @endif
                <div class="m-t-2 text-muted font-size-12">PDF Max size of 300kb</div>
              </fieldset>
              <button type="submit" class="btn btn-lg btn-primary m-t-3">Update profile</button>
              <!-- <a href="#" class="pull-xs-right text-muted p-t-4">Deactivate account</a> -->
            </div>
            {!! Form::close() !!}

          <!-- Spacer -->
          <div class="m-t-4 visible-xs visible-sm"></div>

          <!-- Avatar -->
          <div class="col-md-4 col-lg-3">
            <div class="panel bg-transparent">
              <form method="post" action="{{url('/profile/image')}}"  enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="panel-body text-xs-center">
              <div id="preview" style="width:200px;" class="img-polaroid">
              
              @if(\Auth::user()->profile->photo)
                <img src="{{ asset(null) }}frontend/uploads/{{\Auth::user()->profile->photo}}" alt="" class="" style="max-width: 100%;"  id="previewimgProfile">
              @else
                <img src="{{ asset(null) }}frontend/assets/images/user-icon.png" alt="" class="" style="max-width: 100%;"  id="previewimgProfile">
              @endif
              </div>
              </div>
              <hr class="m-y-0">
              <div class="panel-body text-xs-center">

                <label class="custom-file px-file p-a-1">
                  <input type="file" name="photo" class="custom-file-input" id="imgProfile" required="required">
                  <span class="custom-file-control form-control">Pilih Foto...</span>
                </label>
                <button type="submit" class="btn btn-primary">Save</button>&nbsp;
                <div class="m-t-2 text-muted font-size-12">JPG, JPEG or PNG. Max size of 300kb</div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- / Profile tab -->

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
                  case 'jpeg':
                  case 'png':
                      var sizeFile = (this.files[0].size/1024/1024).toFixed(2);
                
                      if(sizeFile<0.3){

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

     $("#fileProfile").change(function(){
            var ext = this.value.match(/\.(.+)$/)[1];
              switch (ext) {
                  case 'pdf':
                      var sizeFile = (this.files[0].size/1024/1024).toFixed(2);
                
                      if(sizeFile<1){
                        $('#textFile').html($(this).val());
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