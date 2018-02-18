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
                <div class="col-md-12 fadeIn animated"> 
                  @include('backend.common.flashes')

                    <p>&nbsp;</p>
                      
                    <a href="{{urlBackendAction('ajukan')}}" class="btn btn-info btn-large">Ajukan</a>
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
                            <!-- <tr>
                                <td>&nbsp;</td>
                                <td>Kategori</td>
                                <td>Nama</td>
                                <td>Komag</td>
                                <td>Tahun Perolehan</td>
                                <td>Harga Unit</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
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
             //        if(title=="Kategori" || title=="Nama" || title=="Komag"  || title=="Tahun Perolehan"  || title=="Harga Unit"){
             //          $(this).html( '<input type="text" placeholder="'+title+'" />' );
             //        }else{
             //          return "";
             //        }
             //    } );
             
          var table =  $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("datadetail") }}/{{$id}}}',
                columns: [
                    { data: 'id', name: 'id' , searchable: false , bSortable: false},
                    { data: 'category', name: 'category'  , bSortable: false},
                    { data: 'name', name: 'name' , bSortable: false},
                    { data: 'komag', name: 'komag'  , bSortable: false},
                    { data: 'year_acquisition', name: 'year_acquisition' , bSortable: false },
                    { data: 'unit_price', name: 'unit_price'  , bSortable: false},

                    { data: 'action', name: 'action' , searchable: false , bSortable: false},
                    { data: 'unit', name: 'unit'  , bSortable: false},
                ]
                
            });

        $('#table tbody').on('click','.checklist',function(){
          var idRow = $(this).attr('data-id');
          if(this.checked){

            var qty = $('input#amounts'+idRow).val();
            var amount = parseInt($('input#amount'+idRow).val());

            if(qty>amount){
              $('input#amounts'+idRow).val(amount);
              var qtyProposed = amount;
            }else{
              var qtyProposed = qty;

            }
            if(qty!=0){

              $('input#amounts'+idRow).attr('readonly','readonly');

            $('div#table_wrapper').attr('class','dataTables_wrapper form-inline dt-bootstrap no-footer form-loading form-loading-inverted');
              $.get('{{urlBackendAction("addcart")}}/'+idRow+'/'+qtyProposed, function(d){ 
                    
                  // // $('#city').html(dataHtml);
                  // if(d.status==true){
                  //   $('#row'+pinjam).remove();
                  //   $('#countJmlh').html(d.data);
                  // }

                  $('div#table_wrapper').attr('class','dataTables_wrapper form-inline dt-bootstrap no-footer');
              }); 
            }else{
              alert('Sory, value empty');
              return false;
            }     

// alert('hapus');
          }else{
// alert('tambah');
            $('input#amounts'+idRow).removeAttr('readonly');

            $('div#table_wrapper').attr('class','dataTables_wrapper form-inline dt-bootstrap no-footer form-loading form-loading-inverted');
            $.get('{{urlBackendAction("removecart")}}/'+idRow, function(d){ 
                  
                // // $('#city').html(dataHtml);
                // if(d.status==true){
                //   $('#row'+pinjam).remove();
                //   $('#countJmlh').html(d.data);
                // }

              $('div#table_wrapper').attr('class','dataTables_wrapper form-inline dt-bootstrap no-footer');
            });  

          }
        });
            //Apply the search
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