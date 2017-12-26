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
                <div class="col-md-12 fadeIn animated"> 
                  @include('backend.common.flashes')
                      <div class="form-group">
                        <label>Kategori Barang</label>
                        {!! Form::select('status' , ['y' => 'ALl Kategori' , 'n' => 'kk'] , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Lokasi Gudang</label>
                        {!! Form::select('status' , ['y' => 'Bogor' , 'n' => 'Jakarta'] , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Tanggal Pemanfaatan</label>
                        {!! Form::select('status' , ['y' => 'Bogor' , 'n' => 'Jakarta'] , null ,['class' => 'form-control']) !!}
                      </div>
                      
                    <a href="#" class="btn btn-success">Lihat</a>
                    <p>&nbsp;</p>

                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td>Title</td>
                                <td><a href="{{urlBackendAction('ajukan')}}" class="btn btn-info">Ajukan</a></td>
                            </tr>
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