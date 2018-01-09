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
                    
                    <form method="get" action="">
                      <div class="form-group">
                        <label>Kategori Material</label>
                        {!! Form::select('category' , ['tubular' => 'Tubular Good' , 'cock' => 'Cock & Value' , 'fitting' => 'Fitting & Flange' , 'instrument' => 'Instrument' , 'bahankimia' => 'Bahan Kimia / Peralatan' , 'lainlain' => 'Lain-lain'] , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Lokasi Gudang</label>
                        {!! Form::select('status' , ['y' => 'Bogor' , 'n' => 'Jakarta'] , null ,['class' => 'form-control']) !!}
                      </div>
                      
                    <a href="#" class="btn btn-info">Lihat</a>
                    <!-- <button type="submit" class="btn btn-info">Lihat</button> -->
                    </form>
                    <p>&nbsp;</p>

                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>

                                <th>Kategori</th>
                                <th>Nama</th>
                                <th>Komag</th>
                                <th>Tahun Perolehan</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga Unit</th>
                                <th>Action</th>
                            </tr>
                            <!-- <tr>
                                <td>Category</td>
                                <td>Nama</td>
                                <td>Komag</td>
                                <td>Tahun Perolehan</td>
                                <td>Jumlah</td>
                                <td>Satuan</td>
                                <td>Harga Unit</td>
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
             $('#table thead td').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                } );
             
          var table =  $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'category', name: 'category' },
                    { data: 'name', name: 'name'},
                    { data: 'komag', name: 'komag' },
                    { data: 'year_acquisition', name: 'year_acquisition' },
                    { data: 'amount', name: 'amount' },
                    { data: 'unit', name: 'unit' },
                    { data: 'unit_price', name: 'unit_price' },

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