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
                        {!! Form::select('category' , ['tubular' => 'Tubular Good' , 'cock' => 'Cock & Value' , 'fitting' => 'Fitting & Flange' , 'instrument' => 'Instrument' , 'bahankimia' => 'Bahan Kimia / Peralatan' , 'lainlain' => 'Lain-lain'] , null ,['class' => 'form-control']) !!}
                      </div>


                      <div class="form-group">
                        <label>Nama Material</label>
                        {!! Form::text('name' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>KOMAG</label>
                        {!! Form::text('komag' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Kode MRO-ABT / Kode MI</label>
                        {!! Form::text('code' , null ,['class' => 'form-control']) !!}
                      </div>
                      
                      <div class="form-group">
                        <label>Description Material</label>
                        {!! Form::textarea('description' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Merk</label>
                        {!! Form::text('merk' , isset($model->id) ? $model->jaringan->merk : null ,['class' => 'form-control']) !!}
                      </div>


                      <div class="form-group">
                        <label>Spesifikasi</label>
                        {!! Form::text('specification' , isset($model->id) ? $model->jaringan->specification : null ,['class' => 'form-control']) !!}
                      </div>

                      <!-- <div class="form-group">
                        <label>Serial Number</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div> -->

                      <div class="form-group">
                        <label>Tahun Pembuatan</label>
                        {!! Form::text('year_production' , isset($model->id) ? $model->jaringan->year_production : null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Jumlah Material</label>
                        {!! Form::text('amount' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Lokasi Awal</label>
                        {!! Form::text('previous_location' , isset($model->id) ? $model->jaringan->previous_location : null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                        {!! Form::text('note' , isset($model->id) ? $model->jaringan->note : null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Lokasi Penyimpanan</label>
                        {!! Form::select('warehouse_id' , $warehouse , null ,['class' => 'form-control']) !!}
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