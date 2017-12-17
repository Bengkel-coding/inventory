@extends('backend.layouts.layout')
@section('content')

  <div class="px-content">
    <div class="row">
      <div class="col-md-12 fadeIn animated">   
        <div class="panel panel-info panel-dark">
          <div class="panel-heading">
            <span class="panel-title"><i class="panel-title-icon fa fa-home"></i>{{ trinata::titleActionForm() }}</span>
          </div>   
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <img src="{{ asset(null) }}backend/assets/images/dashboard.png" width="100%">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12"><br/>
                  <span class="font-size-24">Welcome to Inventory System PGN</span>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin viverra tristique nunc vitae bibendum. Vestibulum vitae nunc sed nisi efficitur dignissim. Nulla hendrerit nisl nec lectus viverra tincidunt. 
                  </p>
                </div>
              </div>
            </div>
        </div>
      </div>

      
    </div>

  </div>

@endsection

@push('script-js')
<script type="text/javascript">
  

</script>
@endpush