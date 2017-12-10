@extends('frontend.layouts.layout')

@section('content')

  <div class="px-content">
    <ol class="breadcrumb page-breadcrumb">
      <li><a href="#">Dashboard</a></li>
      <li class="active">Pencarian</li>
    </ol>
            <div class="panel">
              <div class="panel-heading">
                <div class="panel-title"><i class="fa fa-bullhorn"></i> Hasil Pencarian</div>
              </div>
              <div class="panel-body">
                <div class="row">
                        
                      
                      <div class="row">
                        <div class="col-md-12">
                          @if($model)
                          @foreach($model as $val)
                          <div class="widget-support-tickets-item">
                            <a href="{{url('/event-calendar/detail/'.$val->id)}}" title="" class="widget-support-tickets-title text-underlined">
                              {{ $val->name}} {{--<span class="badge badge-danger">NEW!</span>--}}
                            </a>
                            <span class="widget-support-tickets-info">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $val->start_date)->format('j F Y')}} | By <a href="#" title="">{{ $val->user->name }}</a></span>
                            <p>
                              {!! str_limit($val->description, $limit=300, $end='...')!!} 
                            </p>
                          </div>
                          @endforeach
                          @endif
                          
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12 text-xs-center">
                          <!-- <ul class="pagination">
                            <li class="disabled">
                              <a href="#">Previous</a>
                            </li>
                            <li class="active">
                              <a href="#">1</a>
                            </li>
                            <li>
                              <a href="#">2</a>
                            </li>
                            <li>
                              <a href="#">3</a>
                            </li>
                            <li>
                              <a href="#">4</a>
                            </li>
                            <li>
                              <a href="#">5</a>
                            </li>
                            <li>
                              <a href="#">6</a>
                            </li>
                            <li>
                              <a href="#">Next</a>
                            </li>
                          </ul> -->
                          
                          {!! $model->setPath('')->appends(['q' => $request->q])->render() !!}
                        </div>
                      </div>
              </div>
            </div>
    </div>
@endsection
