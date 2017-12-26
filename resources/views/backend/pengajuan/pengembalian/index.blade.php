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

                @if(!empty($menuPengajuan->first()->childs->first()))
                 
                @foreach($menuPengajuan->first()->childs as $child)
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
                      <div class="form-group">
                        <label>Kategori Barang</label>
                        {!! Form::select('status' , ['y' => 'ALl Kategori' , 'n' => 'kk'] , null ,['class' => 'form-control']) !!}
                      </div>
                      <div class="form-group">
                        <label>Lokasi Gudang</label>
                        {!! Form::select('status' , ['y' => 'Bogor' , 'n' => 'Jakarta'] , null ,['class' => 'form-control']) !!}
                      </div>
                      
                    <a href="#" class="btn btn-info">Lihat</a>

                    <p>&nbsp;</p>
                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>MEssage</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- ini Hanya Contoh belum Server Side-->
                        <tbody>
                            <tr>
                                <td>Title 1</td>
                                <td>Message 1</td>
                                <td>Status 1</td>
                                <td><a href="#" class="btn btn-default">View</a> </td>
                            </tr>
                            <tr>
                                <td>Title 2</td>
                                <td>Message 3</td>
                                <td>Status 2</td>
                                <td><a href="#" class="btn btn-default">View</a> </td>
                            </tr>
                            <tr>
                                <td>Title 3</td>
                                <td>Message 13</td>
                                <td>Status 3</td>
                                <td><a href="#" class="btn btn-default">View</a> </td>
                            </tr>
                            <tr>
                                <td>Title 4</td>
                                <td>Message 5</td>
                                <td>Status 61</td>
                                <td><a href="#" class="btn btn-default">View</a> </td>
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
          var table =  $('#table').DataTable();

           // var table =  $('#table').DataTable({
           //      processing: true,
           //      serverSide: true,
           //      ajax: '{{ urlBackendAction("data") }}',
           //      columns: [
           //          { data: 'title', name: 'title' },
           //          { data: 'action', name: 'action' , searchable: false},
           //      ]
           //  });

        });

    </script>

@endpush