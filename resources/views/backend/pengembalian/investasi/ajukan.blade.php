@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <div class="row">
      <div class="col-md-12 fadeIn animated">   
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-list"></i>{{ trinata::titleActionForm() }}</span>
          </div>   
            <div class="row p-a-3">
                <div class="col-md-6 fadeIn animated"> 
                  <div class="form-group">
                    <label>No Pengembalian Material</label>
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pengembalian</label>
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label>Diterima dari</label>
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label>Nomer Permintaan Material</label>
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Permintaan Material</label>
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label>Nomor Pengeluaran Material</label>
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label>Tanggal Pengeluaran Material</label>
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                </div>
                <div class="col-md-6 fadeIn animated"> 
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
                    {!! Form::text('title' , null ,['class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    {!! Form::textarea('title' , null ,['class' => 'form-control','rows'=>15]) !!}
                  </div>
                </div>
            </div>
          
            <div class="row p-a-3">
                <div class="col-md-12 fadeIn animated"> 
                  @include('backend.common.flashes')
                  <a href="#" class="btn btn-info">Process</a>
                  <p>&nbsp;</p>

                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            <!-- <tr>
                                <td>Title</td>
                                <td>Action</td>
                            </tr> -->
                        </thead>
                        
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
             
          var table =  $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'title', name: 'title' },
                    { data: 'action', name: 'action' , searchable: false},
                ]
            });

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