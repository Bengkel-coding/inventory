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

                     {!! Form::model($model,['files' => true]) !!} 


                      <div class="form-group">
                        <label>Kategori Barang</label>
                        {!! Form::select('status' , ['tubular' => 'Tubular Good' , 'cock' => 'Cock & Value' , 'fitting' => 'Fitting & Flange' , 'instrument' => 'Instrument' , 'bahankimia' => 'Bahan Kimia / Peralatan' , 'lainlain' => 'Lain-lain'] , null ,['class' => 'form-control']) !!}
                      </div>


                      <div class="form-group">
                        <label>Nama Material</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>KOMAG</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Kode MI</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>
                      
                      <div class="form-group">
                        <label>Description Material</label>
                        {!! Form::textarea('description' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Satuan Barang </label>
                        {!! Form::select('status' , ['buah' => 'Buah', 'liter' => 'Liter' , 'meter' => 'Meter' , 'pieces' => 'Pieces' , 'roll' => 'Roll' , 'unit' => 'Unit'] , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Tahun Perolehan</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>


                      <div class="form-group">
                        <label>Jumlah Material</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Harga Satuan</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Harga Total</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Surplus Material</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                        {!! Form::select('status' , ['' => '-', 'merah' => 'Merah' , 'kuning' => 'Kuning' , 'hijau' => 'Hijau' , 'hijaumuda' => 'Hijau Muda'] , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Keterangan</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Lokasi </label>
                        {!! Form::select('status' , ['y' => 'Bogor' , 'n' => 'Jakarta'] , null ,['class' => 'form-control']) !!}
                      </div>
                      

                      <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                    
                    {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@push('script-js')
<script type="text/javascript">
  
</script>
@endpush