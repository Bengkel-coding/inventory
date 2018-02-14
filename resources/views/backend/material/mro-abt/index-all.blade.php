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
                    <form method="get" action="">
                      <div class="form-group">
                        <label>Kategori Material</label>
                        {!! Form::select('category' , ['tubular' => 'Tubular Good' , 'cock' => 'Cock & Value' , 'fitting' => 'Fitting & Flange' , 'instrument' => 'Instrument' , 'bahankimia' => 'Bahan Kimia / Peralatan' , 'lainlain' => 'Lain-lain'] , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Lokasi Gudang</label>
                        {!! Form::select('warehouse' , $warehouse , null ,['class' => 'form-control warehouse']) !!}
                      </div>
                      
                      
                    <!-- <a href="#" class="btn btn-info">Lihat</a> -->
                    <button type="submit" class="btn btn-info">Lihat</button>
                    <a href="#" class="btn btn-danger">Ekspor</a>
                    
                    <a href="javascript:void(0)" data="{{ urlBackendAction('import') }}" class="btn btn-success import">Import</a>
                    </form>
                    <p>&nbsp;</p>

                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>

                                <th>Nama</th>
                                <th>Komag</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                                <th>Harga Unit</th>
                                <th>Gudang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>

                                <th>Nama</th>
                                <th>Komag</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                                <th>Harga Unit</th>
                                <th>Gudang</th>
                                <th>Action</th>
                            </tr>                            
                        </tfoot>
                        <tbody>
                        @foreach($model as $item)
                            <tr>
                                <th>{{$item->name}}</th>
                                <th>{{$item->komag}}</th>
                                <th>{{$item->description}}</th>
                                <th>{{$item->amount}}</th>
                                <th>{{$item->unit_price}}</th>
                                <th>{{$item->warehouse}}</th>
                                <th>
                                <?php

                                    $status = $item->status == 'y' ? true : false;
                                    echo trinata::buttons($item->id , [] , $status);
                                ?>
                                </th>                               
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

        $(document).ready(function(){
             $('#table tfoot th').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                } );
            
             
          var table =  $('#table').DataTable();

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