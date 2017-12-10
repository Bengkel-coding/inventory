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
                    <p>&nbsp;</p>
                    <table class="table table-striped table-bordered dataTable no-footer" id="table" role="grid" aria-describedby="datatables_info">
                        <thead>
                            <tr>
                                <th width = ''>Role</th>
                                <th width = ''>Name</th>
                                <th width = ''>Email</th>
                                <th width = ''>Action</th>
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
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ urlBackendAction("data") }}',
                columns: [
                    { data: 'role', name: 'roles.role' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'action', name: 'action' , searchable: false},
                    
                ]
            });
        });

    </script>

@endsection