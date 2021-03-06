@extends('backend.layouts.layout')
@section('content')
<style type="text/css">
  .datepicker {
    z-index:9999;
  }
</style>
  <div class="px-content">
    <div class="row">
      <div class="col-md-12 fadeIn animated">   
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-list"></i>{{ trinata::titleActionForm() }}</span>
          </div>   
            {!! Form::model($model,['files' => true]) !!} 
            <div class="row p-a-3">
                <div class="col-md-6 fadeIn animated"> 
                  <div class="form-group">
                    <label>No Pengeluaran Material</label>
                    {!! Form::text('no_utilization' , null ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pengeluaran</label>
                    {!! Form::text('date_utilization' , null ,['class' => 'form-control datepicker','readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Kepada</label>
                    {!! Form::text('to' , null ,['class' => 'form-control','readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Dari</label>
                    {!! Form::text('from' , null ,['class' => 'form-control','readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Diharapkan Diterima Tanggal</label>
                    {!! Form::text('expected_receive_date' , null ,['class' => 'form-control datepicker','readonly'=>'readonly']) !!}
                  </div>
                </div>
                <div class="col-md-6 fadeIn animated"> 
                  <div class="form-group">
                    <label>Dibukukan Oleh</label>
                    {!! Form::text('booked_by' , null ,['class' => 'form-control','readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Kode Perkiraan</label>
                    {!! Form::text('estimation_code' , null ,['class' => 'form-control','readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Dibukukan</label>
                    {!! Form::text('date_booked' , null ,['class' => 'form-control datepicker','readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    {!! Form::textarea('details' , null ,['class' => 'form-control','rows'=>'5','readonly'=>'readonly']) !!}
                  </div>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="row p-a-3">


                    <p>&nbsp;</p>
                      
                    <a href="{{urlBackendAction('ajukan')}}" class="btn btn-info btn-large">Ajukan</a>
                <div class="col-md-12 fadeIn animated"> 

                  <p>&nbsp;</p>

                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Komag</th>
                                <th>Tahun Perolehan</th>
                                <th>Harga Unit</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($model->utilizationDetail()->get() as $item)
                        <?php $detail= $item->material()->first();?>
                          <tr>
                                <td>&nbsp;</td>
                                <td>{{$detail->category}}</td>
                                <td>{{$detail->name}}</td>
                                <td>{{$detail->komag}}</td>
                                <td>{{$detail->year_acquisition}}</td>
                                <td>{{$detail->unit_price}}</td>
                                <td>{{$item->proposed_amount}}</td>
                                <td>{{$detail->unit}}</td>
                            
                          </tr>

                        @endforeach
                        
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@push('script-js')
    
    <script type="text/javascript">
        
        $(document).ready(function(){

      $('.datepicker').datepicker({format : 'yyyy-mm-dd'});
             // $('#table thead td').each( function () {
             //        var title = $(this).text();
             //        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
             //    } );
             
          var table =  $('#table').DataTable();

            // Apply the search
            // table.columns().every( function () {
            //     var that = this;
         
            //     $( 'input', this.footer() ).on( 'keyup change', function () {
            //         if ( that.search() !== this.value ) {
            //             that
            //                 .search( this.value )
            //                 .draw();
            //         }
            //     } );
            // } );
        });

    </script>

@endpush