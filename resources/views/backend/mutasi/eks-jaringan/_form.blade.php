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

                     @include('backend.common.flashes')
                      {!! Form::model($model, ['class'=>'panel-body p-y-1', 'files'=>true]) !!} 

                      <div class="form-group">
                        <label>Kategori Barang</label>
                        {!! Form::select('category' , ['tubular' => 'Tubular Good' , 'cock' => 'Cock & Value' , 'fitting' => 'Fitting & Flange' , 'instrument' => 'Instrument' , 'bahankimia' => 'Bahan Kimia / Peralatan' , 'lainlain' => 'Lain-lain'] , null ,['class' => 'form-control']) !!}
                        <!-- {!! Form::text('category' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!} -->
                      </div>

                      <div class="form-group">
                        <label>Nama Material</label>
                        {!! Form::text('name' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>

                      <div class="form-group">
                        <label>KOMAG</label>
                        {!! Form::text('komag' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>

                      <div class="form-group">
                        <label>Kode MRO/MI</label>
                        {!! Form::text('code' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>

                      <div class="form-group">
                        <label>Nomor Kartu</label>
                        {!! Form::text('cardnumber' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>

                      <div class="form-group">
                        <label>Description Material</label>
                        {!! Form::textarea('description' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>

                      <!-- <div class="form-group">
                        <label>Satuan Barang </label>
                        {!! Form::select('status' , ['y' => 'M' , 'n' => 'Liter'] , null ,['class' => 'form-control']) !!}
                      </div> -->

                      <div class="form-group">
                        <label>Merk</label>
                        {!! Form::text('merk' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>

                      <div class="form-group">
                        <label>Spesifikasi</label>
                        {!! Form::text('specification' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>

                      <div class="form-group">
                        <label>Lokasi Awal</label>
                        {!! Form::text('previous_location' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>

                      <div class="form-group">
                        <label>Jumlah Material</label>
                        {!! Form::text('real_amount' , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>

                      <!-- <div class="form-group">
                        <label>Harga Satuan</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div> -->

                      <!-- <div class="form-group">
                        <label>Harga Total</label>
                        {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                      </div> -->

                      <div class="form-group">
                        <label>Lokasi Penyimpanan</label>
                        {!! Form::select('warehouse_id' , $data['ware'] , null ,['class' => 'form-control', (!empty($model->id)) ? 'readonly' : '']) !!}
                      </div>

                      <div class="form-group">
                        <label>Usulan Mutasi </label>
                        {!! Form::select('proposed_warehouse_id' , $data['ware'] , null ,['class' => 'form-control', (!empty($model->id))]) !!}
                      </div>

                      <div class="form-group">
                        <label>Kuantitas Mutasi</label>
                        {!! Form::text('proposed_amount' , null ,['class' => 'form-control']) !!}
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