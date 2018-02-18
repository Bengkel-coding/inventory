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
                        {!! Form::text('komag' , null ,['class' => 'form-control','required']) !!}
                      </div>

                      <!-- <div class="form-group">
                        <label>Kode MRO</label>
                        {!! Form::text('code' , null ,['class' => 'form-control']) !!}
                      </div> -->
                      <div class="form-group">
                        <label>Serial Number</label>
                        {!! Form::text('serialnumber' , null ,['class' => 'form-control']) !!}
                      </div>
                      
                      <div class="form-group">
                        <label>Description Material</label>
                        {!! Form::textarea('description' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Satuan Barang </label>
                        {!! Form::select('unit' , ['buah' => 'Buah', 'liter' => 'Liter' , 'meter' => 'Meter' , 'pieces' => 'Pieces' , 'roll' => 'Roll' , 'unit' => 'Unit'] , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Tahun Perolehan</label>
                        {!! Form::text('year_acquisition' , null ,['class' => 'form-control']) !!}
                      </div>


                      <div class="form-group">
                        <label>Jumlah Material</label>
                        {!! Form::text('amount' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Harga Satuan</label>
                        {!! Form::text('unit_price' , null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Tingkat Persedian Minimal(min)</label>
                        {!! Form::text('min_stock_level' , isset($model->id) ? $model->mro->min_stock_level : null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Tingkat Persedian Maksimal(maks)</label>
                        {!! Form::text('max_stock_level' , isset($model->id) ? $model->mro->max_stock_level : null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Excess Stock</label>
                        {!! Form::text('excess_stock' , isset($model->id) ? $model->mro->excess_stock : null ,['class' => 'form-control']) !!}
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                        {!! Form::select('status' , ['ds' => 'DS', 'fm' => 'FM' , 'pds' => 'PDS' , 'sm' => 'SM'] , isset($model->id) ? $model->mro->status : null ,['class' => 'form-control']) !!}
                      </div>
                      
                      <!-- <div class="form-group">
                        <label>Keterangan</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div> -->

                      <div class="form-group">
                        <label>Lokasi </label>
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