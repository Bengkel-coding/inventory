@extends('backend.layouts.layout')

@section('content')

  <div class="px-content">
    <div class="row">
      <div class="col-md-12 fadeIn animated">   
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-list"></i>{{ trinata::titleActionForm() }}</span>
          </div>   
          
            <div class="row p-a-3">
                <div class="col-md-12 fadeIn animated"> 
                  <div id = 'elfinder'>

                    </div>
                </div>
            </div>
        </div>
      </div>

    </div>
  </div>
@endsection
@push('script-js')

  <script type="text/javascript" charset="utf-8">
    var validation_upload = "<?php echo sha1(date('Y-m-d').env('APP_SALT'))?>";
      $().ready(function() {
          var elf = $('#elfinder').elfinder({
              url : '{{ url("backend/elfinder/php/connector.minimal.php") }}?token='+validation_upload  ,
                         uiOptions : {
                             toolbar : [
                                    ['upload' , 'mkdir'],
                            ],
                         },
                         contextmenu : {
                           files  : ['getfile', '|'],
                           navbar : [],
                         },
                         onlyMimes : ["image","application/pdf","video/mp4"],
                         resizable : false
          }).elfinder('instance');             
      });
  </script>

@endpush