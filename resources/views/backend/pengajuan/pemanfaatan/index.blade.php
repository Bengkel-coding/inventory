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
                        <label>Kategori Barang</label>
                        {!! Form::select('status' , ['y' => 'ALl Kategori' , 'n' => 'kk'] , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Lokasi Gudang</label>
                        {!! Form::select('status' , ['y' => 'Bogor' , 'n' => 'Jakarta'] , null ,['class' => 'form-control']) !!}
                      </div> 
                      
                    <a href="#" class="btn btn-info">Lihat</a>
-->
                    <p>&nbsp;</p>
                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>No Pengeluaran Material</th>
                                <th>Tanggal Pengeluaran</th>
                                <th>Kepada</th>
                                <th>Dari</th>
                                <th>Status Pengajuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- ini Hanya Contoh belum Server Side-->
                        
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
          // var table =  $('#table').DataTable();

           var table =  $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'no_utilization', name: 'no_utilization' },
                    { data: 'date_utilization', name: 'date_utilization' },
                    { data: 'to', name: 'to' },
                    { data: 'from', name: 'from' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' , searchable: false},
                ]
            });

        });

    </script>

@endpush