@extends('frontend.layouts.layout')

@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li>Pengumumanku</li>
      <li class="active">Form</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-plus"></i> Form Pengumuman</div>
              </div>
              <div class="panel-body">
              <div class="row">
              <div class="col-md-9">

                {!! Form::model($data['model'],['files' => true, 'class'=>'panel-body p-y-1']) !!} 
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Judul:</label>
                      <div class="col-sm-9">
                        {!! Form::text('name' , null ,['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Tanggal :</label>
                      <div class="col-sm-9">        
                        <div class="input-group">
                          {!! Form::text('start_date' , isset($data['start_date']) ? $data['start_date'] : null ,['class' => 'form-control tanggal', 'id'=>'datepicker']) !!}
                          <span class="input-group-btn">
                            <button type="button" class="btn"><i class="fa fa-calendar"></i></button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Keterangan :</label>
                      <div class="col-sm-9">
                        {!! Form::textarea('description' , null ,['class' => 'form-control', 'id'=>'summernote-base']) !!}
                      </div>
                    </div>
                  </div>

                  @if($data['model']->status != 'publish')
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">Status :</label>
                      <div class="col-sm-9">
                          {!! Form::select('status' , ['draft' => 'Draft' , 'unpublish' => 'Publish (Butuh Moderasi)'] , null ,['class' => 'form-control select2-example', 'data-allow-clear'=>'true', 'style'=>'width: 100%']) !!}
                        </select>
                      </div>
                    </div>
                  </div>
                  @endif
                  {!! Form::hidden('id' , null) !!}
                  
                  <div class="form-group">
                    <div class="row">
                      <label class="col-sm-3 control-label">
                        <button type="submit" class="btn btn-primary btn-3d">Save</button>
                      </label>
                      <div class="col-sm-8">                  
                          &nbsp;
                      </div>
                    </div>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
    </div>


@endsection

@push('script-js')
<script type="text/javascript">  
    $(function() {
      $('.select2-example').select2({
        placeholder: 'Select value',
      });
    });
    $(function() {
      
      $('#datepicker').datepicker({
        format:'dd/mm/yyyy'
      });

      $('#summernote-base').summernote({
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