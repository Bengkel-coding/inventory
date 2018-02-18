@extends('backend.layouts.layout')
@section('content')

<style>
tfoot {
     display: table-header-group;
}
</style>
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
                      
                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>Penanggung Jawab</th>
                                <th>Action</th>
                            </tr>
                       
                        </thead>
                        <tfoot>
                            
                            <tr>     
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telp</th>
                                <th>Penanggung Jawab</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        
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
             $('#table tfoot th').each( function () {
                    var title = $(this).text();
                    if(title!="Action"){
                        $(this).html( '<input type="text" placeholder="'+title+'" />' );
                    }
                } );
             
          var table =  $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'name', name: 'warehouses.name' },
                    { data: 'address', name: 'warehouses.address' },
                    { data: 'phone', name: 'warehouses.phone' },
                    { data: 'officer', name: 'users.name' },
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