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
                    <label>No Pengembalian Material</label>
                    {!! Form::text('no_return' , null ,['class' => 'form-control','required'=>'required','readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pengembalian</label>
                    {!! Form::text('date_return' , null ,['class' => 'form-control datepicker','required'=>'required','readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Diterima dari</label>
                    {!! Form::text('received_by' , null ,['class' => 'form-control','required'=>'required','readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Nomer Permintaan Material</label>
                    {!! Form::text('no_request' , null ,['class' => 'form-control','required'=>'required','readonly'=>'readonly']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Permintaan Material</label>
                    {!! Form::text('date_request' , null ,['class' => 'form-control datepicker','required'=>'required','readonly'=>'readonly']) !!}
                  </div>
                </div>
                <!-- <div class="col-md-6 fadeIn animated"> 
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
                </div> -->
            </div>
            {!! Form::close() !!}
            <div class="row p-a-3">
                <div class="col-md-12 fadeIn animated"> 

                  <p>&nbsp;</p>

                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Komag</th>
                                <th>Tahun Perolehan</th>
                                <th>Harga Unit</th>
                                <th>Jumlah Diusulkan</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($model->reversionDetail()->get() as $item)
                        <?php $detail= $item->material()->first();?>
                          @if($detail)
                          <tr>
                                <td>{{$detail->category}}</td>
                                <td>{{$detail->name}}</td>
                                <td>{{$detail->komag}}</td>
                                <td>{{$detail->year_acquisition}}</td>
                                <td>{{$detail->unit_price}}</td>
                                <td>{{$item->proposed_amount}}</td>
                                <td>{{$detail->unit}}</td>
                            
                          </tr>
                          @endif

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