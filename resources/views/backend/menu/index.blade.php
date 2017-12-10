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
                    <p>&nbsp;</p>

                    <table class = 'table' id = 'table'>
                        <thead>
                            <tr>
                                <th>Parent</th>
                                <th>Title</th>
                                <th>Controller</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model->whereParentId(null)->orderBy('order','asc')->get() as $row)
                                <tr>
                                    <td>This Parent</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->controller }}</td>
                                    <td>{{ $row->order }}</td>
                                    <td>{!! trinata::buttons($row->id) !!}</td>
                                </tr>

                                @foreach($row->childs as $child)

                                    <tr>
                                        <td style = 'padding-left:40px;'>{{ $row->title }}</td>
                                        <td>{{ $child->title }}</td>
                                        <td>{{ $child->controller }}</td>
                                        <td>{{ $child->order }}</td>
                                        <td>{!! trinata::buttons($child->id) !!}</td>
                                    </tr>

                                @endforeach

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
        $(document).ready(function(){
            $("#table").DataTable({
                ordering :false,
            });
        });
    </script>

@endpush