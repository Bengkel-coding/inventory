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
                        {!! Form::select('category' , ['tubular' => 'Tubular Good' , 'cock' => 'Cock & Value' , 'fitting' => 'Fitting & Flange' , 'instrument' => 'Instrument' , 'bahankimia' => 'Bahan Kimia / Peralatan' , 'lainlain' => 'Lain-lain'] , null ,['class' => 'form-control', 'disabled'=>'disabled']) !!}
                      </div>

                      <div class="form-group">
                        <label>Nama Material</label>
                        {!! Form::text('name' , null ,['class' => 'form-control','readonly'=>'readonly']) !!}
                      </div>                  
                      
                      <div class="form-group">
                        <label>KOMAG</label>
                        {!! Form::text('komag' , null ,['class' => 'form-control','readonly'=>'readonly']) !!}
                      </div>
                      
                      <div class="form-group">
                        <label>Nomor Kartu</label>
                        {!! Form::text('cardnumber' , null ,['class' => 'form-control','readonly'=>'readonly']) !!}
                      </div>
                                          
                      <div class="form-group">
                        <label>Deskripsi Material</label>
                        {!! Form::textarea('description' , null ,['class' => 'form-control','rows'=>'5','readonly'=>'readonly']) !!}
                      </div>

                      <div class="form-group">
                        <label>Satuan Barang </label>
                        {!! Form::select('unit' , ['buah' => 'Buah', 'liter' => 'Liter' , 'meter' => 'Meter' , 'pieces' => 'Pieces' , 'roll' => 'Roll' , 'unit' => 'Unit'] , null ,['class' => 'form-control','disabled'=>'disabled']) !!}
                      </div>

                      <div class="form-group">
                        <label>Tahun Perolehan</label>
                         {!! Form::text('year_acquisition' , null ,['class' => 'form-control', 'readonly'=>'readonly']) !!}
                      </div>


                      <div class="form-group">
                        <label>Jumlah Material</label>
                        {!! Form::text('amount' , null ,['class' => 'form-control','readonly'=>'readonly']) !!}
                      </div>

                      <div class="form-group">
                        <label>Harga Satuan</label>
                        {!! Form::text('unit_price' , null ,['class' => 'form-control','readonly'=>'readonly']) !!}
                      </div>
                    
                      <div class="form-group">
                        <label>Gudang Asal </label>
                        {!! Form::select('warehouse_id' , $data['ware'] , null ,['class' => 'form-control', 'disabled'=>'disabled']) !!}
                      </div>

                      <div class="form-group">
                        <label>Kuantitas Mutasi</label>
                        {!! Form::text('proposed_amount' ,  null ,['class' => 'form-control', 'readonly'=>'readonly']) !!}
                      </div>

                      <div class="form-group">
                        <label>Usulan Mutasi </label>
                        {!! Form::select('proposed_warehouse_id' , $data['ware'] , null ,['class' => 'form-control', 'disabled'=>'disabled']) !!}
                      </div>
                      
                      @if($actionAllow)
                      <div class="form-group">
                        <label>Persetujuan</label>
                        {!! Form::select('status' , $status , null ,['class' => 'form-control']) !!}
                      </div>

                      {!! Form::hidden('warehouse_id' , $model->warehouse_id , null ,['class' => 'form-control']) !!}                       

                      <button type="submit" class="btn btn-primary">{{ !empty($model->id) ? 'Update' : 'Save' }}</button>
                      @endif
                    
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