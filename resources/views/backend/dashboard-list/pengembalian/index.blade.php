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

                <li class="@if ($request->type == 'pending') active @endif">
                  <a href="{{urlBackend('dashboard/reversion?type=pending')}}">
                        Pengembalian Pending
                  </a>
                </li>
                <li class="@if ($request->type == 'approved') active @endif">
                  <a href="{{urlBackend('dashboard/reversion?type=approved')}}">
                        Pengembalian Approved
                  </a>
                </li>
                <li class="@if ($request->type == 'process') active @endif">
                  <a href="{{urlBackend('dashboard/reversion?type=process')}}">
                        Pengembalian Process
                  </a>
                </li>
              </ul>
            </div>
          </div>
          
            <div class="row p-a-3">
                <div class="col-md-12 fadeIn animated"> 
                  @include('backend.common.flashes')

                    <!-- <p>&nbsp;</p> -->
                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>No Pengembalian Material</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Diterima dari</th>
                                <th>No permintaan</th>
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
                ajax: '{{ urlBackendAction("data-reversion?type=$request->type") }}',
                columns: [
                    { data: 'no_return', name: 'no_return' },
                    { data: 'date_return', name: 'date_return' },
                    { data: 'received_by', name: 'received_by' },
                    { data: 'no_request', name: 'no_request' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' , searchable: false},
                ]
            });

        });

    </script>

@endpush