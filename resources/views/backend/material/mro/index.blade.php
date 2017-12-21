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
                    {!! trinata::buttonCreate() !!}
                    <form method="get" action="">
                      <!-- <div class="form-group">
                        <label>Kategori Barang</label>
                        {!! Form::select('status' , ['y' => 'ALl Kategori' , 'n' => 'kk'] , null ,['class' => 'form-control']) !!}
                      </div> -->
                      <div class="form-group">
                        <label>Lokasi Gudang</label>
                        {!! Form::select('warehouse' , $warehouse , null ,['class' => 'form-control warehouse']) !!}
                      </div>
                      
                      
                    <a href="#" class="btn btn-info">Lihat</a>
                    <a href="#" class="btn btn-danger">Ekspor</a>
                    
                    <a href="javascript:void(0)" data="{{ urlBackendAction('import') }}" class="btn btn-success import">Import</a>
                    </form>
                    <p>&nbsp;</p>

                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>Nama Material</th>
                                <th>KOMAG</th>
                                <th>Deskripsi Material</th>
                                <th>Jumlah Material</th>
                                <!-- <th>Lokasi</th> -->
                                <th>Action</th>
                            </tr>
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
        
        $('.import').click(function(){
            var link = $(this).attr('data');
            var warehouse = $('.warehouse').val();
            generateLink = link+'?warehouse='+warehouse;
            // alert(generateLink);return false;
            window.location.href=generateLink;
        })

        $(document).ready(function(){
             $('#table thead td').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                } );
             
          var table =  $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'komag', name: 'komag' },
                    { data: 'description', name: 'description' },
                    { data: 'amount', name: 'amount' },
                    // { data: 'warehouse_id', name: 'warehouse_id' },
                    { data: 'action', name: 'action' , searchable: false},
                ]
            });

            // Apply the search
            table.columns().every( function () {
                var that = this;
         
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        });

    </script>

@endpush