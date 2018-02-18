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
              <ul class="nav nav-tabs">

                 
                <?php 
                  $getChild=injectModel('Menu')->whereParentId($menuPengajuan->first()->id)->whereIn('id',$menuRole)->get();
                ?>
                
                @if(!empty($getChild))
                @foreach($getChild as $child)
                    <li class="{{ searchMenu($child->id,'active','','child') }}">
                      <a href="{{ urlBackend($child->slug.'/index') }}">
                        {{ $child->title}}
                      </a>
                    </li>
                @endforeach
                @endif
              </ul>
            </div>
          </div>
          
            <div class="row p-a-3">
                <div class="col-md-12 fadeIn animated"> 
                  @include('backend.common.flashes')
                      <!-- <div class="form-group">
                        <label>Kategori Material</label>
                        {!! Form::select('type' , ['mro' => 'MRO' , 'mroabt' => 'MRO-ABT' , 'investasi' => 'Investasi' , 'eksjar' => 'Eks-Jaringan' , 'tercatat' => 'Tercatat'] , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Lokasi Gudang</label>
                        {!! Form::select('status' , ['y' => 'Bogor' , 'n' => 'Jakarta'] , null ,['class' => 'form-control']) !!}
                      </div>
                      
                    <a href="#" class="btn btn-info">Lihat</a> -->

                    <p>&nbsp;</p>
                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>Tipe Material</th>
                                <th>Nama</th>
                                <th>KOMAG</th>
                                <th>Deskripsi</th>
                                <th>Gudang Asal</th>
                                <th>Gudang Mutasi</th>
                                <th>Status Pengajuan</th>
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
        
        $(document).ready(function(){
             $('#table thead td').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input type="text" placeholder="Search '+name+'" />' );
                } );
          
          // var table =  $('#table').DataTable({
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'type', name: 'type' },
                    { data: 'name', name: 'name'},
                    { data: 'komag', name: 'komag' },
                    { data: 'description', name: 'description' },
                    { data: 'warehouse_id', name: 'warehouse_id' },
                    { data: 'proposed_warehouse_id', name: 'mutations.proposed_warehouse_id' },
                    { data: 'status', name: 'mutations.status' },

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