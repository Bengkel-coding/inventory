@extends('frontend.layouts.layout')

@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li>Pengumuman</li>
      <li class="active">View</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-bullhorn"></i> Pengumuman Umum</div>
              </div>
              <div class="panel-body">
                      
                      <div class="row">
                        <div class="col-md-12">
                          <div class="page-header p-y-4">
                          <!-- Topic -->

                          <div class="panel">
                            <div class="page-forum-thread-title panel-title">
                              <span class="font-weight-bold font-size-24">{{ $model->name }}</span><br/>
                              <span class="widget-support-tickets-info">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $model->start_date)->format('j F Y')}} - <a href="#" title="">{{ $model->user->name}}</a> ; Approved By <a href="#" title="">{{ $model->approved->name }}</a></span>
                            </div>

                            <hr>

                            <div class="panel-body font-size-14">
                              <p>
                                {!! str_limit($model->description)!!}
                              </p>
                              
                            </div>

                          </div>

                          <!-- / Topic -->

                        
                        </div>
                      </div>
                    </div>
            </div>
    </div>

@endsection

@push('script-js')
<script type="text/javascript">  
    
    $(function() {
      $('[data-toggle="tooltip"]').tooltip();

      $('#summernote-forum-thread-reply').summernote({
        height: 200,
        toolbar: [
          ['parastyle', ['style']],
          ['fontstyle', ['fontname', 'fontsize']],
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']],
          ['insert', ['picture', 'link', 'video', 'table', 'hr']],
          ['history', ['undo', 'redo']],
          ['misc', ['codeview', 'fullscreen']],
          ['help', ['help']]
        ],
      });
    });
</script>
@endpush