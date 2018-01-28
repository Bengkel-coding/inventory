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
                      <div class="form-group">
                        <label>Kategori Material</label>
                        {!! Form::select('category' , [''=>'Pilih Kategori','tubular' => 'Tubular Good' , 'cock' => 'Cock & Value' , 'fitting' => 'Fitting & Flange' , 'instrument' => 'Instrument' , 'bahankimia' => 'Bahan Kimia / Peralatan' , 'lainlain' => 'Lain-lain'] , null ,['class' => 'form-control category']) !!}
                      </div>
                      <div class="form-group">
                        <label>Lokasi Gudang</label>
                        {!! Form::select('warehouse' , $warehouse , null ,['class' => 'form-control warehouse']) !!}
                      </div>
                      
                      
                    <!-- <a href="#" class="btn btn-info">Lihat</a> -->
                    <button type="submit" class="btn btn-info">Lihat</button>
                    <a href="javascript:void(0)" class="btn btn-danger export" data="{{ urlBackendAction('export') }}">Ekspor</a>
                    
                    <a href="javascript:void(0)" data="{{ urlBackendAction('import') }}" class="btn btn-success import">Import</a>
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
        
        $('.import').click(function(){

            var link = $(this).attr('data');
            var warehouse = $('.warehouse').val() || 0;
            if (warehouse == 0) {
                alert('Pilih Gudang Terlebih Dahulu');
                return false;  
            } 
            
            generateLink = link+'?warehouse='+warehouse;
            // alert(generateLink);return false;
            window.location.href=generateLink;
        })

        $('.export').click(function(){

            var link = $(this).attr('data');
            var warehouse = $('.warehouse').val() || 0;
            var category = $('.category').val() || 0;
            
            generateLink = link+'?warehouse='+warehouse+'&category='+category;
            // alert(generateLink);return false;
            window.location.href=generateLink;
        })

        $(document).ready(function(){
             // $('#table thead td').each( function () {
             //        var title = $(this).text();
             //        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
             //    } );
            
             
          var table =  $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! urlBackendAction($urlAjax) !!}',
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