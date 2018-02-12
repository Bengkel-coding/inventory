@extends('backend.layouts.layout')
@section('content')

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
                    {!! Form::text('no_return' , null ,['class' => 'form-control','required'=>'required']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pengembalian</label>
                    {!! Form::text('date_return' , null ,['class' => 'form-control datepicker','required'=>'required']) !!}
                  </div>
                  <div class="form-group">
                    <label>Diterima dari</label>
                    {!! Form::text('received_by' , null ,['class' => 'form-control','required'=>'required']) !!}
                  </div>
                  <div class="form-group">
                    <label>Nomer Permintaan Material</label>
                    {!! Form::text('no_request' , null ,['class' => 'form-control','required'=>'required']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Permintaan Material</label>
                    {!! Form::text('date_request' , null ,['class' => 'form-control datepicker','required'=>'required']) !!}
                  </div>
                 <!--  <div class="form-group">
                    <label>Nomor Pengeluaran Material</label>
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pengeluaran Material</label>
                    {!! Form::text('title' , null ,['class' => 'form-control datepicker']) !!}
                  </div> -->
                </div>
               <!--  <div class="col-md-6 fadeIn animated"> 
                  <div class="form-group">
                    <label>Dibukukan Oleh</label>
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label>Kode Perkiraan</label>
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Dibukukan</label>
                    {!! Form::text('title' , null ,['class' => 'form-control datepicker']) !!}
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    {!! Form::textarea('title' , null ,['class' => 'form-control','rows'=>15]) !!}
                  </div>
                </div> -->
            </div>
            <div class="row p-a-3">              
                <!-- <a href="{{urlBackendAction('index')}}" class="btn btn-success">Add more</a> -->
                <button type="submit" class="btn btn-info">Ajukan</button>
            </div>
            {!! Form::close() !!}
          
            <div class="row p-a-3">
                <div class="col-md-12 fadeIn animated"> 
                  @include('backend.common.flashes')
                  <p>&nbsp;</p>

                   <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Komag</th>
                                <th>Tahun Perolehan</th>
                                <th>Harga Unit</th>
                                <th>Jumlah Barang</th>
                                <th>Jumlah Dikembalikan</th>
                                <th>Satuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($cart as $item)
                            <tr>                              
                                <td>{{$item->options['category']}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->options['komag']}}</td>
                                <td>{{$item->options['year_acquisition']}}</td>
                                <td>{{$item->price}}</td>
                                <td><input type="text" class="form-control" value="{{$item->options['proposed_amount']}}" readonly="readonly"></td>
                                <td><input type="text" class="form-control" value="{{$item->qty}}" readonly="readonly"></td>
                                <td>{{$item->options['unit']}}</td>
                                <td><a href="{{urlBackendAction('deletecart/'.$item->id)}}"><i class="fa fa-close"></i></a></td>
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
             // $('#table thead td').each( function () {
             //        var title = $(this).text();
             //        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
             //    } );
             
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